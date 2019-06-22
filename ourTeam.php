<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 13-12-2017
 * Time: 15:00
 */
require_once ("commonScripts.php");
require_once ("config.php");
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- our team section -->
<section id="teams" class="section teams">
    <div class="container">
        <div class="section-header">
            <h1 style="color: steelblue;" class="wow fadeInDown animated">Our Team</h1>
            <p style="font-family:'Monotype Corsiva'; font-size:x-large; padding-top: 20px;" class="wow fadeInDown animated">"Coming together is a beginning, staying together is progress, and working together is success." <br> -Henry Ford</p>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6">
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="person"> <img src="images/ourTeam/pranami.jpg" alt="" class="img-responsive">
                    <div class="person-content">
                        <h4>Pranami Jhawar</h4>
                    </div>
                    <ul class="social-icons clearfix">
                        <li><a href="https://www.facebook.com/jhawar.pranami" class=""><span class="fa fa-facebook"></span></a></li>
                        <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li>
                        <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="person"> <img src="images/ourTeam/ankit.jpg" alt="" class="img-responsive">
                    <div class="person-content">
                        <h4>Ankit Sharma</h4>
                    </div>
                    <ul class="social-icons clearfix">
                        <li><a href="https://www.facebook.com/ankit9964" class=""><span class="fa fa-facebook"></span></a></li>
                        <li><a href="#" class=""><span class="fa fa-twitter"></span></a></li>
                        <li><a href="#" class=""><span class="fa fa-google-plus"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- our team section -->
<?php
require_once ("footer.php");
?>
