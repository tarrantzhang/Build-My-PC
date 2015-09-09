<?php
include_once 'login.php';
session_start();
write_login($_SESSION["loginState"]);
header('Location: html/index.html');
?>