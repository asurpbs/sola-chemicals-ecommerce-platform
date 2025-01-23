<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * verify credentials
 *
 * @param string $type -> user / admin : the instance of class that you want to verify creden
 * @return int if there is any error occuered, return 1
 */
function verifyCredentials($type) {
    global $conn;
    include $_SERVER['DOCUMENT_ROOT'] . "/context/connect.php";
    // Ensure $conn is defined
    $error_state = 0;
    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
        if ($type === 'admin') {
            header('Location:./dashboard.php');
        } else {
            header('Location:./home.php');
        }
        exit();
    }

    if(isset($_POST['submitlogin']) && !empty($_POST['email']) && !empty($_POST['pass'])){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass = filter_var($_POST['pass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $select_user = $conn->prepare("SELECT * FROM `$type` WHERE email = ? LIMIT 1");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount() > 0 && password_verify($pass, $row['password'])){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            if ($type === 'admin') {
                header('Location:./dashboard.php');
            } else {
                header('Location:./home.php');
            }
            exit();
        } else {
            $error_state = 1;
        }
    }
    return $error_state;
}