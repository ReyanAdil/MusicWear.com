<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/18/2017
 * Time: 3:10 AM
 */
require_once ("commonScripts.php");
require_once ("config.php");

//unset($_SESSION['shoppingCart']);
$productID = $_GET['pId'];
$productQty = $_GET['qty'];
$brandID = $_GET['bID'];
//var_dump($_GET);
//print "quantity is : " .$productQty;
//$brandID = $_POST['bID'];
addToCart($productID,$productQty);
header("location:viewProduct.php?BId=".$brandID); die();
?>
