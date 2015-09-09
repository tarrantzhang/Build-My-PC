<?php
    $from_url = $_POST["txtUrl"];
    session_start();    
    if($_SESSION["cart"]==null){
        $added_product = array($_POST["cata"] => array($_POST["site"], $_POST["image"], $_POST["name"], $_POST["price"]));
        $cart = $added_product;
    }
    else{
        $cart = $_SESSION["cart"];
        $cart[$_POST["cata"]] = array($_POST["site"], $_POST["image"], $_POST["name"], $_POST["price"]);
    }
    $_SESSION["cart"] = $cart;
   // print_r($_SESSION);
   // echo "<br>";
    //print_r($_POST);
    $fp=fopen("html/cart_bak.html","r");
    $str=fread($fp,filesize("html/cart_bak.html"));
    fclose($fp);
    $fp=fopen("html/cart.html","w");
    $total_price = 0;
    while($product = current($cart)){
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
	                                    
	                                    <td width="10%"> <input type="checkbox" class="checkbox" name="check_item" id="check_item"></td>
	                                </tr>
	                            </table>
	                        </li>
	                        <!--cart_item-->';
	    $str=str_replace("<!--cart_item-->",$replace_str,$str);
	    next($cart);
	    }
    $str=str_replace("<!--total-->",strval($total_price),$str);
    fwrite($fp,$str);
    fclose($fp);
    header('Location: '.$from_url);
?>