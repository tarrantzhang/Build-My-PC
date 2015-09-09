<?php
session_start();
$_SESSION["cart"] = null; 
$fp=fopen("html/cart_bak.html","r");
$str=fread($fp,filesize("html/cart_bak.html"));
fclose($fp);
$fp=fopen("html/cart.html","w");
fwrite($fp,$str);
fclose($fp);
header('Location: html/cart.html');
?>