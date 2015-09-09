<?php
    session_start();
    $_SESSION["loginState"] = 0;
    $_SESSION["loginUser"] = "none";
    //print_r($_SESSION);
    header('Location: login_checker.php');
?>