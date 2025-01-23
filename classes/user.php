<?php

class User {
    private $first_name;
    private $last_name;
    private $image;
    private $gender;
    private $birth_date;
    private $password;
    private $email;

    /**
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create a instance of user by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new user
     *      eg - new User($conn, null, "Mithila", "Prabashwara", *******)
     *  2) first argument is filled and rest are null - to retrive data from database and create a new user 
     *      when the user already logged to the system.
     *      eg - new User($conn, 1, null, null, *******)
     */
    public function __construct($conn, $user_id = null, $first_name = null, $last_name =  null, $image = null, $gender = null, $birth_date = null, $password = null, $email = null) {
        if ($user_id === null) {
          $this->first_name = ucwords(trim($first_name));
          $this->last_name = ucwords(trim($last_name));
          $this->image = $image;
          $this->gender = $gender;
          $this->birth_date = $birth_date;
          $this->password = password_hash(trim($password), PASSWORD_BCRYPT);
          $this->email = strtolower(trim($email));
          $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, image, gender, birth_date, password, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
          // s- for string and b - fro binary
          $stmt->bind_param("sssbsss", $this->first_name, $this->last_name, $this->image, $this->gender, $this->birth_date, $this->password, $this->email);
          include "../utils/image.php";
          fileUpload("user");
          $stmt->close();
          $conn->close();
        } else {
            $stmt = $conn->prepare("SELECT first_name, last_name, image, email FROM user WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($this->first_name, $this->last_name, $this->image, $this->email);
            $stmt->fetch();
            $stmt->close();
            $conn->close();
        }
    }

    function get_name() {
        return $this->first_name . ' ' . $this->last_name;
    }
}
?>