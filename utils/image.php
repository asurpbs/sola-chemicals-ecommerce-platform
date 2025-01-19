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
            
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $maxFileSize = 5 * 1024 * 1024; // 5MB
            
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            // Valid the file extension and size
            if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                // Upload directory
                $uploadDir = 'uploads/'.strtolower($object).'/';
                
                // check if the uploadDir , does exsit or not 
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                // Generate a unique file name
                $newFileName = uniqid() . '.' . $fileExtension;
    
                // full path of the img
                $uploadFilePath = $uploadDir . $newFileName;
    
                // Move the uploaded file from cache in browser to the uploadDir in the serevr
                if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                    echo "File uploaded successfully! <br>";
                    echo "File name: " . $newFileName . "<br>";
                    return $newFileName;
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file extension or file size exceeds the limit.";
            }
        }
        return null;
    }

    /**
     * Retrieves the image file path for a given ID and object type.
     *
     * @param int $id The ID of the object
     * @param string $object -> user / admin / item / banner : the tablename that you want to retrive image
     * @return string the image file path, if not exist, return the /uploads/null.png
     */
    function fileGet($id, $object) {
        include './context/connect.php';
        $object = strtolower($object);

        // SQL query
        $stmt = $conn->prepare("SELECT `image` FROM `$object` WHERE `id` = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // check the result ammount
        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $row['image'];
            // valid the image file
            if (!empty($row['image']) && file_exists('uploads/' . $object . '/' . $row['image'])) {
                return '/uploads/' . $object . '/' . $row['image'];
            }
        }
    
        return '/uploads/null.png';
    }

?>