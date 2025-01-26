<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
require_once "../utils/image.php";

class Admin {
    private $admin_id;
    private $first_name;
    private $last_name;
    private $image;
    private $gender;
    private $email;
    private $password;
    private $tele_number;
    private $role;

    /**
     * Constructor to create a new admin or retrieve an existing admin.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of admin by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new admin
     *      eg - new Admin(null, "John", "Doe", $_FILES['image'], 1, "john.doe@example.com", "password", "0771234567", "Admin")
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new admin 
     *      when the admin already logged to the system.
     *      eg - new Admin(1)
     * 
     * @param int|null $admin_id Admin ID
     * @param string|null $first_name First name
     * @param string|null $last_name Last name
     * @param string|null $image Image file
     * @param int|null $gender Gender
     * @param string|null $email Email
     * @param string|null $password Password
     * @param string|null $tele_number Telephone number
     * @param string|null $role Role
     */
    public function __construct($admin_id = null, $first_name = null, $last_name = null, $image = null, $gender = null, $email = null, $password = null, $tele_number = null, $role = null) {
        global $conn;
        if ($admin_id === null) {
            $this->first_name = ucwords(trim($first_name));
            $this->last_name = ucwords(trim($last_name));
            $this->image = fileUpload("admin");
            $this->gender = $gender;
            $this->email = strtolower(trim($email));
            $this->password = password_hash(trim($password), PASSWORD_BCRYPT);
            $this->tele_number = $tele_number;
            $this->role = $role;

            // Insert admin data
            $stmt = $conn->prepare("INSERT INTO admin (first_name, last_name, image, gender, email, password, tele_number, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->first_name);
            $stmt->bindValue(2, $this->last_name);
            $stmt->bindValue(3, $this->image);
            $stmt->bindValue(4, $this->gender);
            $stmt->bindValue(5, $this->email);
            $stmt->bindValue(6, $this->password);
            $stmt->bindValue(7, $this->tele_number);
            $stmt->bindValue(8, $this->role);
            $stmt->execute();
            $this->admin_id = $conn->lastInsertId();
            $stmt = null;

            // Update last visited date
            $stmt = $conn->prepare("UPDATE admin SET last_visited = current_timestamp() WHERE id = ?");
            $stmt->bindValue(1, $this->admin_id);
            $stmt->execute();
            $stmt = null;

        } else {
            $this->admin_id = $admin_id;

            // Update last visited date
            $stmt = $conn->prepare("UPDATE admin SET last_visited = current_timestamp() WHERE id = ?");
            $stmt->bindValue(1, $this->admin_id);
            $stmt->execute();
            $stmt = null;

            // Retrieve admin data
            $stmt = $conn->prepare("SELECT first_name, last_name, image, gender, email, password, tele_number, role FROM admin WHERE id = ?");
            $stmt->bindValue(1, $this->admin_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->first_name);
            $stmt->bindColumn(2, $this->last_name);
            $stmt->bindColumn(3, $this->image);
            $stmt->bindColumn(4, $this->gender);
            $stmt->bindColumn(5, $this->email);
            $stmt->bindColumn(6, $this->password);
            $stmt->bindColumn(7, $this->tele_number);
            $stmt->bindColumn(8, $this->role);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
            $this->image = fileGet("admin", $this->image);
        }
    }

    /**
     * Update the first name of the admin.
     * 
     * @param string $first_name First name
     */
    public function updateFirstName($first_name) {
        global $conn;
        $this->first_name = ucwords(trim($first_name));
        $stmt = $conn->prepare("UPDATE admin SET first_name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->first_name);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the last name of the admin.
     * 
     * @param string $last_name Last name
     */
    public function updateLastName($last_name) {
        global $conn;
        $this->last_name = ucwords(trim($last_name));
        $stmt = $conn->prepare("UPDATE admin SET last_name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->last_name);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the email of the admin.
     * 
     * @param string $email Email
     */
    public function updateEmail($email) {
        global $conn;
        $this->email = strtolower(trim($email));
        $stmt = $conn->prepare("UPDATE admin SET email = ? WHERE id = ?");
        $stmt->bindValue(1, $this->email);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the password of the admin.
     * 
     * @param string $password Password
     */
    public function updatePassword($password) {
        global $conn;
        $this->password = password_hash(trim($password), PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $stmt->bindValue(1, $this->password);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the telephone number of the admin.
     * 
     * @param string $tele_number Telephone number
     */
    public function updateTeleNumber($tele_number) {
        global $conn;
        $this->tele_number = $tele_number;
        $stmt = $conn->prepare("UPDATE admin SET tele_number = ? WHERE id = ?");
        $stmt->bindValue(1, $this->tele_number);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the role of the admin.
     * 
     * @param string $role Role
     */
    public function updateRole($role) {
        global $conn;
        $this->role = $role;
        $stmt = $conn->prepare("UPDATE admin SET role = ? WHERE id = ?");
        $stmt->bindValue(1, $this->role);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the image of the admin. Use it in forms.
     * 
     * @param string $image is input name that is in <input name = "image" type = "file">
     *               In this, updateImage(image);
     */
    public function updateImage($image) {
        global $conn;
        // Delete image file if it's not null.png
        fileDelete($this->image);
        // update the name of image in this class
        $this->image = fileUpload($image);
        $stmt = $conn->prepare("UPDATE admin SET image = ? WHERE id = ?");
        $stmt->bindValue(1, $this->image);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Delete the admin and all related data.
     */
    public function deleteAdmin() {
        global $conn;

        // Delete image file if it's not null.png
        fileDelete($this->image);

        // Set foreign key references to null
        $stmt = $conn->prepare("UPDATE banner SET admin_id = NULL WHERE admin_id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE branch SET admin_id = NULL WHERE admin_id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE company_contact_info SET admin_id = NULL WHERE admin_id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE faq SET admin_id = NULL WHERE admin_id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE news_and_events SET admin_id = NULL WHERE admin_id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE notification SET admin_id = NULL WHERE admin_id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt = null;

        // Delete admin data
        $stmt = $conn->prepare("DELETE FROM admin WHERE id = ?");
        $stmt->bindValue(1, $this->admin_id);
        $stmt->execute();
        $stmt = null;

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * Get the first name of the admin.
     * 
     * @return string First name
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * Get the last name of the admin.
     * 
     * @return string Last name
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * Get the image of the admin.
     * 
     * @return string Image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Get the gender of the admin.
     * 
     * @return int Gender
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Get the email of the admin.
     * 
     * @return string Email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Get the telephone number of the admin.
     * 
     * @return string Telephone number
     */
    public function getTeleNumber() {
        return $this->tele_number;
    }

    /**
     * Get the role of the admin.
     * 
     * @return string Role
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Get the admin ID.
     * 
     * @return int Admin ID
     */
    public function getAdminId() {
        return $this->admin_id;
    }

    /**
     * Get the total number of admins.
     * 
     * @return int Total admins
     */
    public function getTotalUsers() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM admin");
        $stmt->execute();
        $stmt->bindColumn(1, $totalUsers);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $totalUsers;
    }

    /**
     * use to delete the instance of admin
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>
