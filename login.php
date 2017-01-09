<?php

session_start();
include ("header.php");

if (isset($_POST['login'])) {
    if (isset($_SESSION['uid'])) {
        echo '<script>window.alert("You are already logged in!");</script>';
    } else {
        $email = ($_POST['email']);
        $password = sha1($_POST['password']);
        $stmt = $conn->prepare("SELECT user_id,display_name FROM user WHERE email = '" . $email . "'  AND password = '" . $password . "'");
        $stmt->bindParam("email", $email, PDO::PARAM_STR);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            $get_id = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['uid'] = $get_id['user_id'];
            $_SESSION['disp_name'] = $get_id['display_name'];
            header("Location: meetings.php");
        } else {
            echo '<script>window.alert("Invalid Username/Password Combination!");</script>';
        }
    }
} else {
    echo '<script>window.alert("You have visited this page incorrectly!");</script>';
}


include("footer.php");
?>