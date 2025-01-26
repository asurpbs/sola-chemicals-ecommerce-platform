<?php

    /**
     * Upload a image of a object to the disk storage
     *
     * @param string $object -> user / admin / item / banner : the tablename that you want to retrive image
     * @return string the image file name with extension
     */
    function fileUpload($object) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get file details
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $maxFileSize = 5 * 1024 * 1024; // 5MB
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            // Valid the file extension and size
            if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . strtolower($object) . '/'; // Upload directory
                // check if the uploadDir , does exsit or not 
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $newFileName = uniqid() . '.' . $fileExtension; // Generate a unique file name
                $uploadFilePath = $uploadDir . $newFileName; // full path of the img
                // Move the uploaded file from cache in browser to the uploadDir in the serevr
                move_uploaded_file($fileTmpPath, $uploadFilePath);
                return $newFileName;
            } else {
                echo "Invalid file extension or file size exceeds the limit.";
            }
        }
        return null;
    }

    /**
     * Retrieves the image file path.
     *
     * @param string $image - file name wit hextension 
     * @param string $object - object type ( suer/ admin/ banner/ item)
     * @return string the image file path, if not exist, return the /uploads/null.png
     */
    function fileGet($object, $image) {
            // valid the image file
            if (!empty($image) && file_exists( $_SERVER['DOCUMENT_ROOT'] .'/uploads/' . $object . '/' . $image)) {
                return '/uploads/' . $object . '/' . $image;
            } else {
                return '/uploads/null.png';
            }
        }

    /**
     * Delete the image file from the disk storage
     * 
     * @param string $image - file name wit hextension 
     * 
     */
    function fileDelete($image) {
        if (basename($image) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'] . $image);
        }
    }
?>