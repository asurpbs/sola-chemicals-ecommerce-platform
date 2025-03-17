<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
require_once "../utils/image.php";

class Banner {
    private $banner_id;
    private $admin_id;
    private $image;
    private $description;
    private $status;

    /**
     * Constructor to create a new banner or retrieve an existing banner.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of banner by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new banner
     *      eg - new Banner(null, 1, "image.png", "description", 1)
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new banner 
     *      when the banner already exists.
     *      eg - new Banner(1)
     * 
     * @param int|null $banner_id Banner ID
     * @param int|null $admin_id Admin ID
     * @param string|null $image Image
     * @param string|null $description Description
     * @param int|null $status Status
     */
    public function __construct($banner_id = null, $admin_id = null, $image = null, $description = null, $status = null) {
        global $conn;
        if ($banner_id === null) {
            $this->admin_id = $admin_id;
            $this->image = fileUpload("banner");
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
            $this->image = fileGet("banner", $this->image);
        }
    }

    /**
     * Update the image of the banner. Use it in forms.
     */
    public function updateImage() {
        global $conn;
        // Delete image file if it's not null.png
        fileDelete($this->image);
        // update the name of image in this class
        $this->image = fileUpload('banner');
        $stmt = $conn->prepare("UPDATE banner SET image = ? WHERE id = ?");
        $stmt->bindValue(1, $this->image);
        $stmt->bindValue(2, $this->banner_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the description of the banner.
     * 
     * @param string $description Description
     */
    public function updateDescription($description) {
        global $conn;
        $this->description = $description;
        $stmt = $conn->prepare("UPDATE banner SET description = ? WHERE id = ?");
        $stmt->bindValue(1, $this->description);
        $stmt->bindValue(2, $this->banner_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the status of the banner.
     * 
     * @param int $status Status
     */
    public function updateStatus($status) {
        global $conn;
        $this->status = $status;
        $stmt = $conn->prepare("UPDATE banner SET status = ? WHERE id = ?");
        $stmt->bindValue(1, $this->status);
        $stmt->bindValue(2, $this->banner_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Delete the banner and all related data.
     */
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

    /**
     * Get the admin ID of the banner.
     * 
     * @return int Admin ID
     */
    public function getAdminId() {
        return $this->admin_id;
    }

    /**
     * Get the image of the banner.
     * 
     * @return string Image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Get the description of the banner.
     * 
     * @return string Description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Get the status of the banner.
     * 
     * @return int Status
     */
    public function getStatus() {
        return $this->status;
    }
}
?>
