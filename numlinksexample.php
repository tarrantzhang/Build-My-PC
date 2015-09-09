<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <META NAME="ROBOTS" CONTENT="NOARCHIVE"> 
    
<link rel="stylesheet" type="text/css" href="numlinkstyle.css">
    <title>< 1 2 3 > < Prev Next > - 1. 2. 3. page link PHP function Example</title>
    </head>
    
<body style=" border-color:">
		  <p>
		    <?php 
            if ($_GET['page'] != "") $page = $_GET['page'];
            else $page = 1;
            
            require_once('numlinkfunctions.php');
            
            numlinks($page, 25, 11, '', 'demoparam=useless');
        ?>
</p>
</body>
</html>
