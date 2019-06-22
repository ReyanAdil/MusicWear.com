<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 13-12-2017
 * Time: 12:55
 */
require_once ("commonScripts.php");
require_once ("config.php");
//collecting brand Information
$brandsInfo = fetchAllBrandImgID();

//creating arrays to store brand details
$brandImgID = array();
$brandName = array();

//collecting brand information
foreach ($brandsInfo as $brandInfo){
    $brandImgID[] = $brandInfo['BImgID'];
    $brandName[] = $brandInfo['BName'];
}
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- Headphone section -->
<section id="services" class="services service-section">
    <div class="container">
        <div class="section-header">
            <h2 style="color: white" class="wow fadeInDown animated"><br>Shop by Brands</h2>
        </div>
        <div class="row">
            <?php for($x = 0; $x<sizeof($brandImgID); $x++){?>
            <div class="col-md-4 col-sm-6 brands-div services text-center"> <span class="icon icon-recycle"></span>
                <div class="services-content">
                    <a href="viewProduct.php?BId=<?php echo $x+1; ?>" class="work-box">
                        <img style="height: 300px; width: 300px;" src="images/brands/<?php echo $brandImgID[$x]?>" alt="">
                    </a>
                    <h3 style="color: white"><?php echo $brandName[$x]?></h3>
                </div>
            </div>
            <?php }?>
    </div>
</section>
<!--headphone section-->
<?php
require_once ("footer.php");
?>