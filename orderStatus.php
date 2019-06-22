<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/19/2017
 * Time: 4:41 PM
 */
require_once ("commonScripts.php");
require_once ("config.php");
unset($_SESSION['cart']);
deleteFromDbAfterLoginAtClearCart($loggedInUser->user_name);
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- Payment info -->
<section id="contact" class="section">
    <div class="container">
        <div class="section-header">
            <h1 style="color: steelblue" class="wow fadeInDown animated">Order Status</h1>
        </div>
        <div>
            <h4>Thank you for your order. <br> Your Order has been processed!!</h4>
        </div>
    </div>
</section>
<!-- Payment info -->
</body>