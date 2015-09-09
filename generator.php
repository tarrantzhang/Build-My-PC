<?php
require_once("sql.php");
/*$Price = $_POST['price'];
$Year = $_POST['year'];
$Brand = $_POST['brand'];*/
$Name = $_POST['searchname'];
$Category = $_POST['category'];
    
ini_set('max_execution_time', 300); 
$newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
$newconn->connect();

$flag_seemore = false;

session_start();
$username = $_SESSION["loginUser"];
$socket = "0";
//print_r($_SESSION);
if($_SESSION["cart"]["Processor"] != null){
		$processor_name = $_SESSION["cart"]["Processor"][2];
		$socket=  $newconn->lookupSocket($processor_name,1);
	}
else if($_SESSION["cart"]["MotherBoard"] != null){
		$processor_name = $_SESSION["cart"]["MotherBoard"][2];
		$socket=  $newconn->lookupSocket($processor_name,0);
	}
//echo $socket;

if($Category == "All"){
	$result =  $newconn->lookupHardwareLim($Name, 3, $socket);
	$flag_seemore = true;
}
else{
	$result = $newconn->lookupHardwareCat($Name, $Category,$socket);
	$flag_seemore = false;
}
 
//print_r($result);

$instance_file=fopen("html/product_instance.html","r");
$instance_model=fread($instance_file,filesize("html/product_instance.html"));
$categories = array();
$categories[0] = "Cases";
$categories[1] = "Graphic";
$categories[2] = "HardDrives";
$categories[3] = "Memory";
$categories[4] = "Monitor";
$categories[5] = "MotherBoard";
$categories[6] = "PowerSupply";
$categories[7] = "Processor";

$show = array();
$show[0] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>CASE</u></font><br><ul>";
$show[1] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>GRAPHIC</u></font><br><ul>";
$show[2] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>HARD DRIVE</u></font><br><ul>";
$show[3] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>MEMORY</u></font><br><ul>";
$show[4] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>MONITOR</u></font><br><ul>";
$show[5] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>MOTHER BOARD</u></font><br><ul>";
$show[6] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>POWER SUPPLY</u></font><br><ul>";
$show[7] = "<div class=\"products\"><font color=\"black\" size=\"2\"><u>PROCESSOR</u></font><br><ul>";

$count = array();
for ($i = 0; $i < 10; $i++) $count[$i] = 0;

$cat = 0;

foreach($result as $hardwareCata){
    foreach($hardwareCata as $instance){
        $instance_name = $instance[0];
        $instance_name = utf8_decode($instance_name);
        $instance_brand = $instance[1];
        $instance_price = $instance[2];
        $instance_image = $instance[3];
        $instance_category = $instance[4];
        
        $postfix = ".html";
        $instance_name=str_replace("/",'_',$instance_name);
        $instance_name=str_replace('"','_',$instance_name);
        $instance_name=str_replace('"','_',$instance_name);
        $instance_name=str_replace(',','_',$instance_name);
        $instance_name=str_replace(':','_',$instance_name);
        $instance_name=str_replace('?','_',$instance_name);
        $instance_name=str_replace('*','_',$instance_name);
        $instance_name=str_replace('&','_',$instance_name);
        $instance_name=str_replace('|','_',$instance_name);
        $path = "html/products/".$instance_name.$postfix;
        $dirname = dirname($path);
        if (!is_dir($dirname))
        {
            mkdir($dirname, 0755, true);
        }
        
	        $fp=fopen("html/product.html","r");
	        $str=fread($fp,filesize("html/product.html"));
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
                <input type= "hidden" name = "price" value = "'.$instance_price.'">
                <input type="hidden" id="txtUrl" name="txtUrl" value="" >
                 <script>
                document.getElementById("txtUrl").value = window.location.href;
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
	        
	        $review_count = 0;
	        
	        foreach($reviewresult as $reviews){
		        foreach($reviews as $review){
		        	$str_review = $review_template;
		        	$str_review = str_replace("*RUSERNAME*", $review[0], $str_review);
		        	$str_review = str_replace("*RDATE*", $review[2], $str_review);
		        	$str_review = str_replace("*RCONTENT*", $review[3], $str_review);
		        	$str_review = str_replace("*ID*", (string)$review_count, $str_review);
		        	$str_review = str_replace("<!--product_name-->", $instance_name, $str_review);
		        	$str_review = str_replace("<!--product_category-->", $instance_category, $str_review);
		        	if($username == "root") $str_review = str_replace("<!--delete_comment-->", "<input type = \"submit\" value = \"Delete Comment\" />", $str_review);
		        	$str_reviews .= $str_review;
		        	$review_count++;
		        }
	        }
	        $str = str_replace("<!--Reviews-->", $str_reviews, $str);
		$str = str_replace("<!--comment_info-->", "<input type = \"hidden\" name = \"cata\" value = \"".$instance_category."\"/>", $str);
	        fclose($fp);
	        $handle=fopen($path,"w"); 
	        fwrite($handle,$str);
	        fclose($handle); 
	        
	        $show[$cat] = $show[$cat].$instance_model;
	        $product_link = "products/".$instance_name.$postfix;
	        $show[$cat]=str_replace("*product_link*",$product_link,$show[$cat]);
	        $show[$cat]=str_replace("*name*",$instance_name,$show[$cat]);
	        $show[$cat]=str_replace("*brand*",$instance_brand,$show[$cat]);
	        $show[$cat]=str_replace("*price*",$instance_price,$show[$cat]);
	        $show[$cat]=str_replace("*image_link*",$instance_image,$show[$cat]);
	        $show[$cat]=str_replace("*category*",$instance_category,$show[$cat]);
        $count[$cat]++;   
    }
}

fclose($instance_file);
//connect and show result
$final = "<label name=\"Search Name\"><font color=#989898 size=\"4\">Search result for ".$Name." from ".$Category.": </font></label>";
for ($i = 0; $i < 10; $i++) if ($count[$i] > 0){
	if($flag_seemore)
		$show[$i].="</ul></div><form id=\"seemore".$i."\" action=\"../generator.php\" method=\"post\"> <input type=\"hidden\" name=\"searchname\" value=\"".$Name."\"/> <input type=\"hidden\" name=\"category\" value=\"".$categories[$i]."\"/><p align=\"right\"><a href=\"javascript: submitform(".$i.")\">See more...</a></p></form>";
	else
		$show[$i].="</ul></div>";
	$final.=$show[$i];
}

$fp=fopen("html/index.html","r");
$result_page=fread($fp,filesize("html/index.html"));
$result_page=str_replace("<!--*show_result*-->",$final,$result_page);
fclose($fp);

$result_html=fopen("html/result_page.html","w"); 
fwrite($result_html,$result_page);
fclose($result_html); 
header('Location: html/result_page.html');
exit;
?>