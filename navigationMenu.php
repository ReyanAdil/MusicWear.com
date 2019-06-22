<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/6/2017
 * Time: 6:42 PM
 */
//$_SESSION['shoppingCart']['count'] = "";
require_once ("config.php");
$cartItems = no_of_products();
//$cartItems = 1;
?>
<!-- header section -->
<section>
    <header id="header">
        <div class="header-content clearfix"> <span class="logo"><a href="index.php">MusicWear</a></span>
            <nav class="navigation" role="navigation">
                <ul class="primary-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="headphones.php">Headphones</a></li>
                    <li><a href="#services">Accessories</a></li>
                    <?php if (isUserLoggedIn()){?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi &nbsp <?php echo "$loggedInUser->first_name";?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li style="background-color: transparent"><a href="logOut.php">Log Out</a></li>
                            </ul>
                        </li>
                        <li><a href="viewCart.php">
                                <span class="glyphicon glyphicon-shopping-cart badge"><?php echo $cartItems?> Cart
                                    <span class="badge"></span>
                                </span>
                            </a>
                        </li>
                    <?php }else{?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="viewCart.php">
                                <span class="glyphicon glyphicon-shopping-cart badge"><?php echo $cartItems?> Cart
                                    <span class="badge"></span>
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
            <a href="#" class="nav-toggle">Menu<span></span></a>
        </div>
    </header>
</section>
<!-- header section -->


