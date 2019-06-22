<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 13-12-2017
 * Time: 14:54
 */
require_once ("commonScripts.php");
require_once ("config.php");
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- services section -->
<section id="services" class="services service-section">
    <div class="container">
        <div class="section-header">
            <h2 style="color: white" class="wow fadeInDown animated">About Us</h2>
            <p style="color: white" class="wow fadeInDown animated">Our primary vision is to provides all category headphones in the cheapest price.</p>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-recycle"></span>
                <div class="services-content">
                    <h5 style="color: white">CAREERS</h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-heart"></span>
                <div class="services-content">
                    <h5 style="color: white">PRIVACY POLICY</h5>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-megaphone"></span>
                <div class="services-content">
                    <h5 style="color: white">TERMS OF USE</h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!--services section-->
<?php
require_once ("footer.php");
?>