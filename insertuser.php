<?php
    include 'sql.php';
    session_start();
    $newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
    $newconn->connect();
    print_r($_POST);
    if(!$newconn->addUser($_POST["email"],$_POST["name"], $_POST["password"]))
     echo "User exist";
    echo '
    	<body onload="document.createElement(\'form\').submit.call(document.getElementById(\'myForm\'))">
    	<form id = "myForm" action="login.php" method="post">
        <input type="hidden" name="accountname" value ="'. $_POST["email"].'" class="field" />
        <input type="hidden" name="password" value ="'.  $_POST["password"].'"  class ="field" />
        <input type="hidden" name="new_regi" value ="1" class="field" />
        </form>
        </body>'
?>
    