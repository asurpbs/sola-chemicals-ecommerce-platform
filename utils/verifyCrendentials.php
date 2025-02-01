<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Verify credentials
 *
 * @param string $type -> user / admin : the instance of class that you want to verify credentials for
 * @return int if there is any error occurred, return 1
 */
function verifyCredentials($type) {
    global $conn;
    require_once $_SERVER['DOCUMENT_ROOT'] . "/context/connect.php";
    $error_state = 0;

    // Check if the user is already logged in (cookie exists)
    if (isset($_COOKIE['user_id'])) {
        if ($type === 'admin') {
            header('Location: /admin/dashboard.php');
        } else {
            header('Location: /index.php');
        }
        exit();
    }

    // Process login form submission
    if (isset($_POST['submitlogin']) && !empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pass  = $_POST['pass']; // No need to sanitize passwords

        // Fetch user from database
        $select_user = $conn->prepare("SELECT * FROM `$type` WHERE email = ? LIMIT 1");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        // Verify credentials
        if ($select_user->rowCount() > 0 && password_verify($pass, $row['password'])) {
            // Set cookie with security flags
            setcookie('user_id', $row['id'], [
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'secure' => true, // Send only over HTTPS
                'httponly' => true, // Prevent JavaScript access
                'samesite' => 'Strict' // Prevent CSRF attacks
            ]);

            // Redirect after setting the cookie
            if ($type === 'admin') {
                header('Location: /admin/dashboard.php');
            } else {
                header('Location: /index.php');
            }
            exit();
        } else {
            $error_state = 1; // Invalid credentials
        }
    }

    return $error_state;
}