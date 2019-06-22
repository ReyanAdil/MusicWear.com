<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/17/2017
 * Time: 12:26 AM
 */
require_once ("commonScripts.php");
require_once ("config.php");

//collecting BrandID
$brandID = $_GET["BId"];

//fetching products based on Brand ID
$products = fetchProductsBasedOnBID($brandID);

//arrays for collecting Product's details with brand name separately
$PNames = array();
$PPDescs = array();
$PPrices = array();
$PImages = array();
$PIDs = array();
$BrandNames = array();

//collecting details separately
foreach ($products as $product){
  $PNames[] = $product['PName'];
  $PPDescs[] = $product['PDesc'];
  $PPrices[] = $product['PPrice'];
  $PImages[] = $product['PImgID'];
  $PIDs[] = $product['PID'];
  $BrandNames[] = $product['BName'];
}

//Form posted
if(!empty($_POST)) {
    $errors = array();
    if (isset($_POST["pId"])) {
        print "Form posted";
        $product_id = $_POST['pID'];
        $product_qty = 1;
        addToCart($product_id, $product_qty);
        header("location:products.php");
    } else {
        $errors[] = "Please enter valid quantity";
    }
}

?>
<body>
<?php
require_once("navigationMenu.php");
?>
<section id="gallery" class="gallery section">
    <div class="container-fluid">
        <div class="section-header">
            <h2 class="wow fadeInDown animated">Our Products</h2>
        </div>
        <form name="products" method="post" action="processAddToCart.php">
            <div class="row no-gutter">
                <?php for($x = 0; $x<sizeof($PIDs); $x++){?>
                    <div class="jumbotron col-lg-3 col-md-6 col-sm-6 products-div work">
                        <a href="products.php?BId=<?php echo $brandID?>" class="work-box">
                            <img src="images/product_images/<?php echo $BrandNames[$x]?>/<?php echo $PImages[$x]?>" alt="">
                        </a>
                        <h4 class="products-name"><?php echo $PNames[$x]?></h4>
                        <h6 class="products-price">Price : $<?php echo $PPrices[$x]?></h6>
                        <input type="text" name="bID" value="<?php echo $brandID?>" hidden />
                        <input type="text" name="qty" value="1" hidden />
                        <input type="text" name="pId" value="<?php echo $PIDs[$x]?>" hidden />
                        <button type="submit" id="submit" name="send" class="btn-primary btn-cart"> Add To Cart</button>
                    </div>
                <?php }?>
            </div>
        </form>
    </div>
</section>
</body>
<?php
require_once ("footer.php");
?>
