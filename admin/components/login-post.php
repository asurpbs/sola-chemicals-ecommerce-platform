<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../components/connect.php';

if(isset($_POST['submitlogin'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $select_user = $conn->prepare("SELECT * FROM `user` WHERE email = ? LIMIT 1");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
    if($select_user->rowCount() > 0 && password_verify($pass, $row['password'])){
        setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
        header('location:../pages/index.php');
        exit();
    } else {
        $message[] = 'Incorrect email or password!';
        // Display the error message
        echo '<p>' . $message[0] . '</p>';
    }
}
?>