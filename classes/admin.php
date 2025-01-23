<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

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
     * input the file path by fileUpload()
     */
    public function __construct($admin_id = null, $first_name = null, $last_name = null, $image = null, $gender = null, $email = null, $password = null, $tele_number = null, $role = null) {
        global $conn;
        if ($admin_id === null) {
            $this->first_name = ucwords(trim($first_name));
            $this->last_name = ucwords(trim($last_name));
            $this->image = $image;
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

        } else {
            $this->admin_id = $admin_id;

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
        }
    }

    public function updateFirstName($first_name) {
        global $conn;
        $this->first_name = ucwords(trim($first_name));
        $stmt = $conn->prepare("UPDATE admin SET first_name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->first_name);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateLastName($last_name) {
        global $conn;
        $this->last_name = ucwords(trim($last_name));
        $stmt = $conn->prepare("UPDATE admin SET last_name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->last_name);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateEmail($email) {
        global $conn;
        $this->email = strtolower(trim($email));
        $stmt = $conn->prepare("UPDATE admin SET email = ? WHERE id = ?");
        $stmt->bindValue(1, $this->email);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updatePassword($password) {
        global $conn;
        $this->password = password_hash(trim($password), PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
        $stmt->bindValue(1, $this->password);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateTeleNumber($tele_number) {
        global $conn;
        $this->tele_number = $tele_number;
        $stmt = $conn->prepare("UPDATE admin SET tele_number = ? WHERE id = ?");
        $stmt->bindValue(1, $this->tele_number);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateRole($role) {
        global $conn;
        $this->role = $role;
        $stmt = $conn->prepare("UPDATE admin SET role = ? WHERE id = ?");
        $stmt->bindValue(1, $this->role);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateImage($image) {
        global $conn;
        require_once "../utils/image.php";
        // delete existing image if it's not null.png
        $currentImagePath = fileGet("admin", $this->image);
        if (basename($currentImagePath) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'].$currentImagePath);
        }
        // update the name of image in this class
        $this->image = fileUpload($image);
        $stmt = $conn->prepare("UPDATE admin SET image = ? WHERE id = ?");
        $stmt->bindValue(1, $this->image);
        $stmt->bindValue(2, $this->admin_id);
        $stmt->execute();
        $stmt = null;
    }

    public function deleteAdmin() {
        global $conn;
        require_once "../utils/image.php";

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

        // Delete image file if it's not null.png
        $currentImagePath = fileGet("admin", $this->image);
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

    public function getEmail() {
        return $this->email;
    }

    public function getTeleNumber() {
        return $this->tele_number;
    }

    public function getRole() {
        return $this->role;
    }

    public function getAdminId() {
        return $this->admin_id;
    }
}
?>
