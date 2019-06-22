<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 19-12-2017
 * Time: 15:17
 */
require_once ("commonScripts.php");
require_once ("config.php");
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- Payment info -->
    <section id="contact" class="section">
        <div class="container">
            <div class="section-header">
                <h1 style="color: steelblue" class="wow fadeInDown animated">Payment info</h1>
            </div>
            <div>
                <h4>Payment Section may be included.</h4>
                <a href="orderStatus.php">
                    <button id="orderStatus" name="orderStatus" class="btn-info">Place Order</button>
                </a>
            </div>
        </div>
    </section>
<!-- Payment info -->
</body>