<?php
    include 'sql.php';
    session_start();
    $Name = $_POST['accountname'];
    $Password = $_POST['password'];
    $new_regi = $_POST['new_regi'];
   // print_r($_POST);
    function write_login($is_user){
        if($is_user){
            $login_text=fopen("html/index_login_filled.html","r");
            $login_str=fread($login_text,filesize("html/index_login_filled.html")); 
            $login_str = str_replace("<!--login_user-->",$_SESSION["loginUser"],$login_str);
        }
        else{
            $login_text=fopen("html/index_login_unfilled.html","r");
            $login_str=fread($login_text,filesize("html/index_login_unfilled.html")); 
        }
        $result_html=fopen("html/login_status.html","w");
        fwrite($result_html,$login_str);
        fclose($login_text);
        fclose($result_html);
    }
    
    
    function login($Name,$Password,$new_regi){
        $newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
        $newconn->connect();
        
        $login_bool =  $newconn->verifyUser($Name,$Password);
        mysqli_close($newconn->getconn());
        write_login($login_bool);
       	if($new_regi == null)
        	header('Location: html/login_status.html');
        else
        	header('Location: html/index.html');
        exit;
   }
    login($Name,$Password,$new_regi);

    
?>
