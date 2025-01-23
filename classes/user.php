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
            $stmt->bind_param("sssbsss", $this->first_name, $this->last_name, $this->image, $this->gender, $this->birth_date, $this->password, $this->email);
            $stmt->execute();
            $this->user_id = $stmt->insert_id;
            $stmt->close();

            // Insert address data
            $stmt = $conn->prepare("INSERT INTO user_address (user_id, address1, address2, postal_code, city_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isssi", $this->user_id, $this->address1, $this->address2, $this->postal_code, $this->city_id);
            $stmt->execute();
            $stmt->close();

            // Insert telephone data
            $stmt = $conn->prepare("INSERT INTO user_telephone (user_id, telephone1, telephone2) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $this->user_id, $this->telephone1, $this->telephone2);
            $stmt->execute();
            $stmt->close();

            include "../utils/image.php";
            fileUpload("user");
        } else {
            // Set user_id as instance's user id
            $this->user_id = $user_id;

            // Retrieve user data
            $stmt = $conn->prepare("SELECT first_name, last_name, image, email FROM user WHERE id = ?");
            $stmt->bind_param("i", $this->user_id);
            $stmt->execute();
            $stmt->bind_result($this->first_name, $this->last_name, $this->image, $this->email);
            $stmt->fetch();
            $stmt->close();

            // Retrieve address data
            $stmt = $conn->prepare("SELECT address1, address2, postal_code, city_id FROM user_address WHERE user_id = ?");
            $stmt->bind_param("i", $this->user_id);
            $stmt->execute();
            $stmt->bind_result($this->address1, $this->address2, $this->postal_code, $this->city_id);
            $stmt->fetch();
            $stmt->close();

            // Retrieve telephone data
            $stmt = $conn->prepare("SELECT telephone1, telephone2 FROM user_telephone WHERE user_id = ?");
            $stmt->bind_param("i", $this->user_id);
            $stmt->execute();
            $stmt->bind_result($this->telephone1, $this->telephone2);
            $stmt->fetch();
            $stmt->close();
        }
    }

    public function updateFirstName($first_name) {
        global $conn;
        $this->first_name = ucwords(trim($first_name));
        $stmt = $conn->prepare("UPDATE user SET first_name = ? WHERE id = ?");
        $stmt->bind_param("si", $this->first_name, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateLastName($last_name) {
        global $conn;
        $this->last_name = ucwords(trim($last_name));
        $stmt = $conn->prepare("UPDATE user SET last_name = ? WHERE id = ?");
        $stmt->bind_param("si", $this->last_name, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateAddress1($address1) {
        global $conn;
        $this->address1 = $address1;
        $stmt = $conn->prepare("UPDATE user_address SET address1 = ? WHERE user_id = ?");
        $stmt->bind_param("si", $this->address1, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateAddress2($address2) {
        global $conn;
        $this->address2 = $address2;
        $stmt = $conn->prepare("UPDATE user_address SET address2 = ? WHERE user_id = ?");
        $stmt->bind_param("si", $this->address2, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateTelephone1($telephone1) {
        global $conn;
        $this->telephone1 = $telephone1;
        $stmt = $conn->prepare("UPDATE user_telephone SET telephone1 = ? WHERE user_id = ?");
        $stmt->bind_param("si", $this->telephone1, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateTelephone2($telephone2) {
        global $conn;
        $this->telephone2 = $telephone2;
        $stmt = $conn->prepare("UPDATE user_telephone SET telephone2 = ? WHERE user_id = ?");
        $stmt->bind_param("si", $this->telephone2, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updatePostalCode($postal_code) {
        global $conn;
        $this->postal_code = $postal_code;
        $stmt = $conn->prepare("UPDATE user_address SET postal_code = ? WHERE user_id = ?");
        $stmt->bind_param("si", $this->postal_code, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateCityId($city_id) {
        global $conn;
        $this->city_id = $city_id;
        $stmt = $conn->prepare("UPDATE user_address SET city_id = ? WHERE user_id = ?");
        $stmt->bind_param("ii", $this->city_id, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateEmail($email) {
        global $conn;
        $this->email = strtolower(trim($email));
        $stmt = $conn->prepare("UPDATE user SET email = ? WHERE id = ?");
        $stmt->bind_param("si", $this->email, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updatePassword($password) {
        global $conn;
        $this->password = password_hash(trim($password), PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $this->password, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function updateImage($image) {
        global $conn;
        include "../utils/image.php";
        // delete existing image
        unlink(fileGet("user", $this->image));
        // update the name of image in this class
        $this->image = fileUpload($image);;
        $stmt = $conn->prepare("UPDATE user SET image = ? WHERE id = ?");
        $stmt->bind_param("si", $this->image, $this->user_id);
        $stmt->execute();
        $stmt->close();
    }
  }
?>