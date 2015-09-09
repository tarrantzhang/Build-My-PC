<?php
require_once("sql.php");

session_start();
//print_r($_POST);
$Name = $_POST['hardwareName'];
$Category = $_POST['category'];
$ID = $_POST['id'];
$URL = $_POST[(string)$ID.'Url'];
$Username = $_POST['username'];
$Date = $_POST['date'];
//print_r($_POST);
//print($ID);

ini_set('max_execution_time', 300); 
$newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
$newconn->connect();

$username = $_SESSION["loginUser"];
$newconn->removeComment($Username, $Name, $Date);

$result = $newconn->lookupHardwareFromCat($Name, $Category);
$instance = $result[0];
$instance = $instance[0];

$fp = fopen("html/product.html", "r");
$str = fread($fp, filesize("html/product.html"));
fclose($fp);

	$instance_name = $Name;
        $instance_brand = $instance[1];
        $instance_price = $instance[2];
        $instance_image = $instance[3];
        $instance_category = $Category;
        
        $postfix = ".html";
        $path = "html/products/".$instance_name.$postfix;
        
	        $str=str_replace("*PRODUCT NAME*",$instance_name,$str);
	        $str=str_replace("*BRAND*",$instance_brand,$str);
	        $str=str_replace("*PRICE*",$instance_price,$str);
	        $str=str_replace("*IMAGE_LINK*",$instance_image,$str);
	        $str=str_replace("*CATEGORY*", $instance_category, $str);
	        $hidden = '            <form action="../../cart.php" method="post">
                <input type= "hidden" name = "cata" value = "'.$instance_category.'">
                <input type= "hidden" name = "site" value = "products/'.$instance_name.$postfix.'">
                <input type= "hidden" name = "image" value = "'.$instance_image.'">
                <input type= "hidden" name = "name" value = "'.$instance_name.'">
                <input type="hidden" id="txtUrl" name="txtUrl" value="" >
                 <script>
                document.getElementById("txtUrl").value = window.location.href;
                </script> 
                </script> 
                <input type="image" src="../css/images/watermarked_cover-2.png" width = "60" height = "50" alt="Submit" onClick = "MoveBox(this)"/>
            </form>';
          	$str=str_replace("<!--hidden_info-->",$hidden,$str);
	        
	        $substr = "";
	        if($instance_category == "Case"){
	            $cat = 0;
	        }
	        else if($instance_category == "Graphic"){
	            $cat = 1;
	            $substr .= "<p>Clock Frequency: ".$instance[5]."</p>";
	            $substr .= "<p>Manufacturer: ".$instance[6]."</p>";
	            $substr .= "<p>Model: ".$instance[7]."</p>";
	            $substr .= "<p>Power Consumption: ".$instance[8]."W</p>";
	        }
	        else if($instance_category == "HardDrives"){
	            $cat = 2;
	            $substr .= "<p>Storage Size: ".$instance[5]."</p>";
	            $substr .= "<p>Features: ".$instance[6]."</p>";
	            $substr .= "<p>Power Consumption: ".$instance[8]."W</p>";
	        }
	        else if($instance_category == "Memory"){
	            $cat = 3;
	            $substr .= "<p>Capacity: ".$instance[5]."</p>";
	            $substr .= "<p>Speed: ".$instance[6]."</p>";
	            $substr .= "<p>Power Consumption: ".$instance[8]."W</p>";
	        }
	        else if($instance_category == "Monitor"){
	            $cat = 4;
	            $substr .= "<p>Resolution: ".$instance[5]."</p>";
	            $substr .= "<p>Size: ".$instance[6]." in.</p>";
	            $substr .= "<p>Model: ".$instance[7]."</p>";
	        }
	        else if($instance_category == "MotherBoard"){
	            $cat = 5;
	            $substr .= "<p>Manufacturer: ".$instance[6]."</p>";
	            $substr .= "<p>Socket: ".$instance[7]."</p>";
	            $substr .= "<p>Chip Set: ".$instance[8]."</p>";
	            $substr .= "<p>USB: ".$instance[9]."</p>";
	            $substr .= "<p>Power Consumption: ".$instance[10]."W</p>";
	        }
	        else if($instance_category == "PowerSupply"){
	            $cat = 6;
	        }
	        else if($instance_category == "Processor"){
	            $cat = 7;
	            $substr .= "<p>Description: ".$instance[5]."</p>";
	            $substr .= "<p>Socket: ".$instance[6]."</p>";
	            $substr .= "<p>Power Consumption: ".$instance[8]."W</p>";
	        }
	        $str = str_replace("<!--specs-->", $substr, $str);
	        
	        //add reviews
	        
	        $str_reviews = "";
	        $str_review = "";
	        $review_fp = fopen("html/product_review.html", "r");
	        $review_template = fread($review_fp, filesize("html/product_review.html"));
	        fclose($review_fp);
	        $reviewresult = $newconn->getComments($instance_name);
	        
	        $count = 0;

	        foreach($reviewresult as $reviews){
		        foreach($reviews as $review){
		        	$str_review = $review_template;
		        	$str_review = str_replace("*RUSERNAME*", $review[0], $str_review);
		        	$str_review = str_replace("*RDATE*", $review[2], $str_review);
		        	$str_review = str_replace("*RCONTENT*", $review[3], $str_review);
		        	$str_review = str_replace("*ID*", (string)$count, $str_review);
		        	$str_review = str_replace("<!--product_name-->", $instance_name, $str_review);
		        	$str_review = str_replace("<!--product_category-->", $instance_category, $str_review);
		        	if($username == "root") $str_review = str_replace("<!--delete_comment-->", "<input type = \"submit\" value = \"Delete Comment\" />", $str_review);
		        	$str_reviews .= $str_review;
		        	$count++;
		        }
	        }

	        $str = str_replace("<!--Reviews-->", $str_reviews, $str);
		$str = str_replace("<!--comment_info-->", "<input type = \"hidden\" name = \"cata\" value = \"".$instance_category."\"/>", $str);

	        $handle=fopen($path,"w"); 
	        fwrite($handle,$str);
	        fclose($handle); 	        


header('Location: '.$URL);
exit;
?>