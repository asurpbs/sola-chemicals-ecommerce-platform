<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

  class User {
    private $user_id;
    private $first_name;
    private $last_name;
    private $image;
    private $gender;
    private $birth_date;
    private $password;
    private $email;
    private $address1;
    private $address2;
    private $telephone1;
    private $telephone2;
    private $city_id;
    private $postal_code;

  /**
       * Note - you must include the database connectivity file in your page and pass the $conn  
       *  You can create a instance of user by 2 ways.
       *  1) first argument of the constructor is null and rest are filled - to create a new user
       *      eg - new User($conn, null, "Mithila", "Prabashwara", "dsdsdfd.jpg", 1, "2001-10-07", "password", "email", "address1", "address2", "postal_code", "city_id")
       *  2) first argument is filled and rest are null - to retrive data from database and create a new user 
       *      when the user already logged to the system.
       *      eg - new User($conn, 1, null, null, *******)
       * 
       * input the file path by fileUpload()
       * 
       * @param int|null $user_id User ID
       * @param string|null $first_name First name
       * @param string|null $last_name Last name
       * @param string|null $image Image
       * @param int|null $gender Gender
       * @param string|null $birth_date Birth date
       * @param string|null $password Password
       * @param string|null $email Email
       * @param string|null $address1 Address line 1
       * @param string|null $address2 Address line 2
       * @param string|null $postal_code Postal code
       * @param int|null $city_id City ID
       * @param string|null $telephone1 Telephone 1
       * @param string|null $telephone2 Telephone 2
       */
      
    public function __construct($user_id = null, $first_name = null, $last_name =  null, $image = null, $gender = null, $birth_date = null, $password = null, $email = null, $address1 = null, $address2 = null, $postal_code = null, $city_id = null, $telephone1 = null, $telephone2 = null) {
        global $conn;  
        if ($user_id === null) {
            $this->first_name = ucwords(trim($first_name));
            $this->last_name = ucwords(trim($last_name));
            $this->image = $image;
            $this->gender = $gender;
            $this->birth_date = $birth_date;
            $this->password = password_hash(trim($password), PASSWORD_BCRYPT);
            $this->email = strtolower(trim($email));
            $this->address1 = $address1;
            $this->address2 = $address2;
            $this->postal_code = $postal_code;
            $this->city_id = $city_id;
            $this->telephone1 = $telephone1;
            $this->telephone2 = $telephone2;

            // Insert user data
            $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, image, gender, birth_date, password, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->first_name);
            $stmt->bindValue(2, $this->last_name);
            $stmt->bindValue(3, $this->image);
            $stmt->bindValue(4, $this->gender);
            $stmt->bindValue(5, $this->birth_date);
            $stmt->bindValue(6, $this->password);
            $stmt->bindValue(7, $this->email);
            $stmt->execute();
            $this->user_id = $conn->lastInsertId();
            $stmt = null;

            // Insert address data
            $stmt = $conn->prepare("INSERT INTO user_address (user_id, address1, address2, postal_code, city_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->user_id);
            $stmt->bindValue(2, $this->address1);
            $stmt->bindValue(3, $this->address2);
            $stmt->bindValue(4, $this->postal_code);
            $stmt->bindValue(5, $this->city_id);
            $stmt->execute();
            $stmt = null;

            // Insert telephone data
            $stmt = $conn->prepare("INSERT INTO user_telephone (user_id, telephone1, telephone2) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $this->user_id);
            $stmt->bindValue(2, $this->telephone1);
            $stmt->bindValue(3, $this->telephone2);
            $stmt->execute();
            $stmt = null;

            require_once "../utils/image.php";
            fileUpload("user");
        } else {
            // Set user_id as instance's user id
            $this->user_id = $user_id;

            // Retrieve user data
            $stmt = $conn->prepare("SELECT first_name, last_name, image, gender, birth_date, email FROM user WHERE id = ?");
            $stmt->bindValue(1, $this->user_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->first_name);
            $stmt->bindColumn(2, $this->last_name);
            $stmt->bindColumn(3, $this->image);
            $stmt->bindColumn(4, $this->gender);
            $stmt->bindColumn(5, $this->birth_date);
            $stmt->bindColumn(6, $this->email);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;

            // Retrieve address data
            $stmt = $conn->prepare("SELECT address1, address2, postal_code, city_id FROM user_address WHERE user_id = ?");
            $stmt->bindValue(1, $this->user_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->address1);
            $stmt->bindColumn(2, $this->address2);
            $stmt->bindColumn(3, $this->postal_code);
            $stmt->bindColumn(4, $this->city_id);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;

            // Retrieve telephone data
            $stmt = $conn->prepare("SELECT telephone1, telephone2 FROM user_telephone WHERE user_id = ?");
            $stmt->bindValue(1, $this->user_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->telephone1);
            $stmt->bindColumn(2, $this->telephone2);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    public function updateFirstName($first_name) {
        global $conn;
        $this->first_name = ucwords(trim($first_name));
        $stmt = $conn->prepare("UPDATE user SET first_name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->first_name);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateLastName($last_name) {
        global $conn;
        $this->last_name = ucwords(trim($last_name));
        $stmt = $conn->prepare("UPDATE user SET last_name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->last_name);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateAddress1($address1) {
        global $conn;
        $this->address1 = $address1;
        $stmt = $conn->prepare("UPDATE user_address SET address1 = ? WHERE user_id = ?");
        $stmt->bindValue(1, $this->address1);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateAddress2($address2) {
        global $conn;
        $this->address2 = $address2;
        $stmt = $conn->prepare("UPDATE user_address SET address2 = ? WHERE user_id = ?");
        $stmt->bindValue(1, $this->address2);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateTelephone1($telephone1) {
        global $conn;
        $this->telephone1 = $telephone1;
        $stmt = $conn->prepare("UPDATE user_telephone SET telephone1 = ? WHERE user_id = ?");
        $stmt->bindValue(1, $this->telephone1);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateTelephone2($telephone2) {
        global $conn;
        $this->telephone2 = $telephone2;
        $stmt = $conn->prepare("UPDATE user_telephone SET telephone2 = ? WHERE user_id = ?");
        $stmt->bindValue(1, $this->telephone2);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updatePostalCode($postal_code) {
        global $conn;
        $this->postal_code = $postal_code;
        $stmt = $conn->prepare("UPDATE user_address SET postal_code = ? WHERE user_id = ?");
        $stmt->bindValue(1, $this->postal_code);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateCityId($city_id) {
        global $conn;
        $this->city_id = $city_id;
        $stmt = $conn->prepare("UPDATE user_address SET city_id = ? WHERE user_id = ?");
        $stmt->bindValue(1, $this->city_id);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateEmail($email) {
        global $conn;
        $this->email = strtolower(trim($email));
        $stmt = $conn->prepare("UPDATE user SET email = ? WHERE id = ?");
        $stmt->bindValue(1, $this->email);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updatePassword($password) {
        global $conn;
        $this->password = password_hash(trim($password), PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
        $stmt->bindValue(1, $this->password);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateImage($image) {
        global $conn;
        require_once "../utils/image.php";
        // delete existing image if it's not null.png
        $currentImagePath = fileGet("user", $this->image);
        if (basename($currentImagePath) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'].$currentImagePath);
        }
        // update the name of image in this class
        $this->image = fileUpload($image);
        $stmt = $conn->prepare("UPDATE user SET image = ? WHERE id = ?");
        $stmt->bindValue(1, $this->image);
        $stmt->bindValue(2, $this->user_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * retrive all orders done by the instance of class as an array
     */
    public function getOrderIds() {
        global $conn;
        $orderIds = [];
        $stmt = $conn->prepare("SELECT id FROM `order` WHERE user_id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderIds[] = $row['id'];
        }
        $stmt = null;
        return $orderIds;
    }

    public function deleteUser() {
        global $conn;
        require_once "../utils/image.php";

        // Set foreign key references to null
        $stmt = $conn->prepare("UPDATE cart SET user_id = NULL WHERE user_id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE feedback SET user_id = NULL WHERE user_id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE `order` SET user_id = NULL WHERE user_id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        $stmt = null;

        // Delete telephone data
        $stmt = $conn->prepare("DELETE FROM user_telephone WHERE user_id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        $stmt = null;

        // Delete address data
        $stmt = $conn->prepare("DELETE FROM user_address WHERE user_id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        $stmt = null;
        
        // Delete user data
        $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
        $stmt->bindValue(1, $this->user_id);
        $stmt->execute();
        $stmt = null;

        // Delete image file if it's not null.png
        $currentImagePath = fileGet("user", $this->image);
        if (basename($currentImagePath) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'].$currentImagePath);
        }

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getBirthDate() {
        return $this->birth_date;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress1() {
        return $this->address1;
    }

    public function getAddress2() {
        return $this->address2;
    }

    public function getTelephone1() {
        return $this->telephone1;
    }

    public function getTelephone2() {
        return $this->telephone2;
    }

    public function getCityId() {
        return $this->city_id;
    }

    public function getPostalCode() {
        return $this->postal_code;
    }

    public function getUserId() {
        return $this->user_id;
    }
  }
?>