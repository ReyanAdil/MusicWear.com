<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/17/2017
 * Time: 10:09 PM
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

?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- Product section -->
<section id="services" class="services service-section">
    <div class="container ">
        <div class="section-header">
            <h2 style="color: white" class="wow fadeInDown animated"><br>Product name</h2>
            <form name="products" method="get" action="processAddToCart.php">
                <?php for($x = 0; $x<sizeof($PIDs); $x++){?>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <a href="./images/product_images/<?php echo $BrandNames[$x]?>/<?php echo $PImages[$x]?>" class="work-box">
                                <img class="product-image" src="images/product_images/<?php echo $BrandNames[$x]?>/<?php echo $PImages[$x]?>" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <h4 class="product-name"><?php echo $PNames[$x]?></h4>
                            <br>
                            <h4>Item Details: <?php echo $PPDescs[$x]?></h4>
                            <h4 class="viewproduct-price">Price : $<?php echo $PPrices[$x]?></h4>
                            <hr class="viewproduct-divider">
                            <br>
                            <h4> QTY: <input type="number" id="qty<?php echo $PIDs[$x]?>" value="1" name="qty" class="qty-btn"></h4>
                            <input type="text" name="bID" id="bID" value="<?php echo $brandID?>" hidden />
                            <input type="text" name="pId" value="<?php echo $PIDs[$x]?>" hidden />
                            <a type="submit" href="#" onclick="addToCart('<?php echo $PIDs[$x]?>','<?php echo $brandID?>');" class="btn-primary btn-kart">Add To Cart</a>
                        </div>
                    </div>
                <?php }?>
            </form>
        </div>
    </div>
</section>
<script>
    function addToCart(pID,bID) {
        var qty = $("#qty"+pID).val();
        if(qty>0){
            var url = "processAddToCart.php?pId="+pID+"&qty="+qty+"&bID="+bID;
            window.location.href = url;
        }
        else {
            alert("Please enter a valid quantity");
        }

    }
</script>
<!-- Product section -->
<?php
require_once ("footer.php");
?>
