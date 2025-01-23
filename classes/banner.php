<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Banner {
    private $banner_id;
    private $admin_id;
    private $image;
    private $description;
    private $status;

    public function __construct($banner_id = null, $admin_id = null, $image = null, $description = null, $status = null) {
        global $conn;
        if ($banner_id === null) {
            $this->admin_id = $admin_id;
            $this->image = $image;
            $this->description = $description;
            $this->status = $status;

            // Insert banner data
            $stmt = $conn->prepare("INSERT INTO banner (admin_id, image, description, status) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $this->admin_id);
            $stmt->bindValue(2, $this->image);
            $stmt->bindValue(3, $this->description);
            $stmt->bindValue(4, $this->status);
            $stmt->execute();
            $this->banner_id = $conn->lastInsertId();
            $stmt = null;
        } else {
            $this->banner_id = $banner_id;

            // Retrieve banner data
            $stmt = $conn->prepare("SELECT admin_id, image, description, status FROM banner WHERE id = ?");
            $stmt->bindValue(1, $this->banner_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->admin_id);
            $stmt->bindColumn(2, $this->image);
            $stmt->bindColumn(3, $this->description);
            $stmt->bindColumn(4, $this->status);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    public function updateImage($image) {
        global $conn;
        require_once "../utils/image.php";
        // delete existing image if it's not null.png
        $currentImagePath = fileGet("banner", $this->image);
        if (basename($currentImagePath) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'].$currentImagePath);
        }
        // update the name of image in this class
        $this->image = fileUpload($image);
        $stmt = $conn->prepare("UPDATE banner SET image = ? WHERE id = ?");
        $stmt->bindValue(1, $this->image);
        $stmt->bindValue(2, $this->banner_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateDescription($description) {
        global $conn;
        $this->description = $description;
        $stmt = $conn->prepare("UPDATE banner SET description = ? WHERE id = ?");
        $stmt->bindValue(1, $this->description);
        $stmt->bindValue(2, $this->banner_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateStatus($status) {
        global $conn;
        $this->status = $status;
        $stmt = $conn->prepare("UPDATE banner SET status = ? WHERE id = ?");
        $stmt->bindValue(1, $this->status);
        $stmt->bindValue(2, $this->banner_id);
        $stmt->execute();
        $stmt = null;
    }

    public function deleteBanner() {
        global $conn;
        require_once "../utils/image.php";

        // Delete banner data
        $stmt = $conn->prepare("DELETE FROM banner WHERE id = ?");
        $stmt->bindValue(1, $this->banner_id);
        $stmt->execute();
        $stmt = null;

        // Delete image file if it's not null.png
        $currentImagePath = fileGet("banner", $this->image);
        if (basename($currentImagePath) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'].$currentImagePath);
        }

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function getAdminId() {
        return $this->admin_id;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }
  }
?>
