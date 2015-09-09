<?php
require_once("sql.php");
$Name = $_POST['Name'];
$newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
$newconn->connect();
if(!$newconn->removeHardware($Name))
    echo "failed";
header("refresh:3;url = html/index.html");
echo "success <br>";
echo 'Switching to homepage...';

?>