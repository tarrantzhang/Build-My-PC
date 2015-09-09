<?php
require_once("sql.php");
$newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
$newconn->connect();

session_start();
$cart = $_SESSION["cart"];
//print_r($cart);
$hardwarecate = array("Cases", "Graphic","HardDrives","Memory","Monitor","MotherBoard","Processor");
$selected_item = array();
$selected_name = array();
while($product = current($cart)){
    array_push($selected_item, key($cart));
    $selected_name[key($cart)] = $product[2];
    //$selected_name[key($cart)] = str_replace("'","",$selected_name[key($cart)]);
    next($cart);
}
$unselected_item = array_diff($hardwarecate, $selected_item);

//print_r($_SESSION);
//print_r($selected_name);
$percentile = $newconn->getPricePercentile($selected_name);
//$percentile."<br>";
$suggest_items = $newconn->get_suggested_hardware($unselected_item,$percentile);
$exist_items = $newconn->get_hardware_detail($selected_name);
$all_item = $exist_items + $suggest_items;

$fp=fopen("html/cart_genius_bak.html","r");
$str=fread($fp,filesize("html/cart_genius_bak.html"));
fclose($fp);
//print_r($all_item);
while($each_item = current($all_item)){
    $cur_name = $each_item[0];
    $cur_name2 = $cur_name;
    $cur_price = $each_item[2];
    $cur_image = $each_item[3];
    $cur_cate = $each_item[4];
    $postfix = ".html";
    $cur_name=str_replace("/",'_',$cur_name);
    $cur_name=str_replace('"','_',$cur_name);
    $cur_name=str_replace(',','_',$cur_name);
    $cur_name=str_replace(':','_',$cur_name);
    $cur_name=str_replace('?','_',$cur_name);
    $cur_name=str_replace('*','_',$cur_name);
    $cur_name=str_replace('&','_',$cur_name);
    $cur_name=str_replace('|','_',$cur_name);
    $path = "html/products/".$cur_name.$postfix;
    $cur_percentile = $newconn->getPricePercentile(array($cur_cate => $cur_name2));
    $replace_str = '<li>
                    <table>
                        <tr>
                            <p>'.$cur_cate.'</p>
                            <td width="15%"><a href="'.$path.'" target="_parent"><img src="'.$cur_image.'" alt="" width="50" height="50" /></a> </td>
                            <td width="65%">
                                <p>'.$cur_name.'</p>
                                <p><span class="lse" style="color:red" color = "red">$'.$cur_price.'</span></p>
                            </td>
                            <form method="post" action="../cart_upgrade.php">
                            <input type ="hidden" name = "product_cate" value = "'.$cur_cate.'">
                            <input type ="hidden" name = "percentile" value = "'.$cur_percentile.'">
                            <td width="40%"><input type="submit" value="upgrade"></td>
                            </form>
                            <td width="10%"> <input type="checkbox" class="checkbox" name="check_item" id="check_item" /></td>
                        </tr>
                    </table>
                </li>
                <!--products-->';
    $str=str_replace("<!--products-->",$replace_str,$str);
    next($all_item);
}
$fp=fopen("html/cart_genius.html","w");
fwrite($fp,$str);
fclose($fp);
header('Location: html/cart_genius.html');
?>