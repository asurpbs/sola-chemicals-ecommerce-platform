<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Don't require connect.php here - it's already included in profile.php

// Check if this file is included from profile.php or called directly
$is_ajax = !isset($user_id);

if ($is_ajax) {
    require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
    
    // For AJAX requests
    if (!isset($_COOKIE['user_id'])) {
        $response = [
            'success' => false,
            'message' => 'Please login first',
            'redirect' => '/pages/signin.php'
        ];
        echo json_encode($response);
        exit;
    }
    
    $user_id = $_COOKIE['user_id'];
    header('Content-Type: application/json');
}

// The rest of the handler works for both AJAX and direct inclusion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_personal'])) {
        // Handle image upload
        $image_name = $_POST['current_image'];
        if (!empty($_FILES['image']['name'])) {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image_name = uniqid() . '.' . $ext;
            $upload_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/user/' . $image_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                if ($_POST['current_image'] != 'null.png') {
                    $old_image_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/user/' . $_POST['current_image'];
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
            }
        }

        try {
            $stmt = $conn->prepare("UPDATE user SET 
                first_name = ?, last_name = ?, email = ?,
                birth_date = ?, gender = ?, image = ?,
                date_modified = CURRENT_TIMESTAMP WHERE id = ?");
            $stmt->execute([
                $_POST['first_name'], 
                $_POST['last_name'], 
                $_POST['email'],
                $_POST['birth_date'], 
                $_POST['gender'], 
                $image_name, 
                $user_id
            ]);
            
            if ($is_ajax) {
                $response = [
                    'success' => true,
                    'message' => 'Personal information updated successfully',
                    'reload' => true,
                    'redirect' => '/index.php?page=profile'
                ];
            } else {
                $_SESSION['success_message'] = "Personal information updated successfully";
                // For non-AJAX, we'll rely on the redirect in profile.php
            }
        } catch (Exception $e) {
            if ($is_ajax) {
                $response = [
                    'success' => false,
                    'message' => 'Failed to update personal information'
                ];
            } else {
                $_SESSION['error_message'] = "Failed to update personal information";
            }
        }
    }

    elseif (isset($_POST['update_contact'])) {
        try {
            // Update address
            $stmt = $conn->prepare("INSERT INTO user_address 
                (user_id, address1, address2, postal_code, city_id) 
                VALUES (?, ?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE 
                address1 = VALUES(address1),
                address2 = VALUES(address2),
                postal_code = VALUES(postal_code),
                city_id = VALUES(city_id)");
            $stmt->execute([
                $user_id,
                $_POST['address1'],
                $_POST['address2'],
                $_POST['postal_code'],
                $_POST['city_id']
            ]);

            // Update telephone
            $stmt = $conn->prepare("INSERT INTO user_telephone 
                (user_id, telephone1, telephone2) 
                VALUES (?, ?, ?) 
                ON DUPLICATE KEY UPDATE 
                telephone1 = VALUES(telephone1),
                telephone2 = VALUES(telephone2)");
            $stmt->execute([
                $user_id,
                $_POST['telephone1'],
                $_POST['telephone2']
            ]);
            
            if ($is_ajax) {
                $response = [
                    'success' => true,
                    'message' => 'Contact information updated successfully',
                    'reload' => true,
                    'redirect' => '/index.php?page=profile'
                ];
            } else {
                $_SESSION['success_message'] = "Contact information updated successfully";
                // For non-AJAX, we'll rely on the redirect in profile.php
            }
        } catch (Exception $e) {
            if ($is_ajax) {
                $response = [
                    'success' => false,
                    'message' => 'Failed to update contact information'
                ];
            } else {
                $_SESSION['error_message'] = "Failed to update contact information";
            }
        }
    }

    elseif (isset($_POST['update_password'])) {
        try {
            $stmt = $conn->prepare("UPDATE user SET 
                password = ?,
                date_modified = CURRENT_TIMESTAMP
                WHERE id = ?");
            $stmt->execute([
                password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                $user_id
            ]);
            
            if ($is_ajax) {
                $response = [
                    'success' => true,
                    'message' => 'Password updated successfully',
                    'reload' => true,
                    'redirect' => '/index.php?page=profile'
                ];
            } else {
                $_SESSION['success_message'] = "Password updated successfully";
                // For non-AJAX, we'll rely on the redirect in profile.php
            }
        } catch (Exception $e) {
            if ($is_ajax) {
                $response = [
                    'success' => false,
                    'message' => 'Failed to update password'
                ];
            } else {
                $_SESSION['error_message'] = "Failed to update password";
            }
        }
    }
}

// Only output JSON for AJAX requests
if ($is_ajax) {
    echo json_encode($response);
}
?>
