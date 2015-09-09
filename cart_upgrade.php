<?php
    require_once("sql.php");
    $newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
    $newconn->connect();
    session_start();
    $product_need_upgrade = $_POST["product_cate"];
    $product_percentile = $_POST["percentile"];
    $cart = $_SESSION["cart"];
   // echo $product_need_upgrade;
    $new_product = $newconn->upgrade_hardware($product_need_upgrade,floatval($product_percentile));
    $path = $new_product[0];
    $path=str_replace("/",'_',$path);
	$path=str_replace('"','_',$path);
	$path=str_replace(',','_',$path);
	$path=str_replace(':','_',$path);
	$path=str_replace('?','_',$path);
	$path=str_replace('*','_',$path);
	$path=str_replace('&','_',$path);
	$path=str_replace('|','_',$path);
	$path = "products/".$path.".html";
	if($cart[$product_need_upgrade] != null)
   	 $cart[$product_need_upgrade] = array($path,$new_product[3],$new_product[0],$new_product[2]);
    	$_SESSION["cart"] = $cart;
    
    $fp=fopen("html/cart_bak.html","r");
    $str=fread($fp,filesize("html/cart_bak.html"));
    fclose($fp);
    $fp=fopen("html/cart.html","w");
    $total_price = 0;
    while($product = current($cart)){
    	if(in_array($product,$cart)){
    	    $total_price+= intval($product[3]);
	    $replace_str = '<li>
	                            <table>
	                                <tr>
	                                <p>'.key($cart).'</p>
	                                    <td width="15%"><a href="'.$product[0].'" target="_parent"><img src="'.$product[1].'" alt="" width = "50" height = "50"/></a> </td>
	                                    <td width="65%">
	                                        <p>'.$product[2].'</p>
	                                        <p><span class="lse">$'.$product[3].'</span></p>
	                                    </td>
	                                    <td width="10%" valign="middle"><a href="#" class="del">delete</a></td>
	                                    <td width="10%"> <input type="checkbox" class="checkbox" name="check_item" id="check_item"></td>
	                                </tr>
	                            </table>
	                        </li>
	                        <!--cart_item-->';
	    $str=str_replace("<!--cart_item-->",$replace_str,$str);
	    next($cart);
	    }
	    }
    $str=str_replace("<!--total-->",strval($total_price),$str);
    fwrite($fp,$str);
    fclose($fp);
    
    header('Location: cart_plan.php');
?>