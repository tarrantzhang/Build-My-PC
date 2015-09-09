<?php
require_once("sql.php");
$Price = $_POST['Price'];
$Brand = $_POST['Brand'];
$Name = $_POST['Name'];
$Chipset = $_POST['Chipset'];
$ChipsetMan = $_POST['ChipsetMan'];
$Socket = $_POST['Socket'];
$Usb = $_POST['Usb'];
$Image = $_POST['Image'];

$newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
$newconn->connect();
if(!$newconn->addHardware_MB($Price, $Brand, $Name, $Chipset, $ChipsetMan, $Image, $Socket, $Usb))
    echo "failed";
header("refresh:3;url = html/index.html");
echo "success <br>";
echo 'Switching to homepage...';

?>