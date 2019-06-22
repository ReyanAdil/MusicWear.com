<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/17/2017
 * Time: 10:02 PM
 */
require_once ("config.php");
require_once ("commonScripts.php");
    if(isset($_GET['clear'])){
    unset($_SESSION['cart']);
    if(isUserLoggedIn()){
        deleteFromDbAfterLoginAtClearCart($loggedInUser->user_name);
    }

}
if(isset($_SESSION['cart'])){
    $checkOut = $_SESSION['cart'];
$i= $total = $current_total = 0;

?>
<body>
<?php require_once ("navigationMenu.php");?>

<section class="section">
    <div class="container ">
        <div class="section-header">
            <h2 style="color: white" class="wow fadeInDown animated"><br>Your Cart</h2>
        </div>
        <div name="cartProductsTable">
            <table class="table table-responsive table-bordered">
                    <thead class="bg-primary">
                    <tr>
                        <th>Serial</th>
                        <th>Product Details</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                <tbody>
                <?php foreach ($checkOut as $item) {
                    $i++;
                    $current_total = $item['product_price']*$item['qty'];
                    $total = $total + $current_total;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td>Name : <?php echo $item['product_name']?>
                            <br>
                            ID : <?php echo $item['product_code']?>
                            <br>
                            Description : <?php echo $item['product_desc']?>
                        </td>
                        <td>$<?php echo $item['product_price'];?></td>
                        <td><?php echo $item['qty'];?></td>
                        <td>$<?php echo $current_total;?></td>
                    </tr>

                <?php }?>
                <tr>
                    <td style="text-align: center" colspan="4">Total</td>
                    <td>$<?php echo $total;?></td>
                </tr>
                </tbody>
            </table>
            <div class="col-sm-offset-8">
                <button type="submit" id="clearCart" name="clearCart" class="btn-danger" onclick="clearCart();">Clear Cart</button>
                <a href="index.php">
                    <button id="continueShopping" name="continueShopping" class="btn-info">Continue Shopping</button>
                </a>
                <?php if(isUserLoggedIn()){?>
                    <a href="Billinginfo.php">
                        <button id="proceedCheckout" name="proceedCheckout" class="btn-success">Checkout</button>
                    </a>
                <?php } else{?>
                    <a href="createAccount.php">
                        <button id="proceedCheckout" name="proceedCheckout" class="btn-success">Checkout</button>
                    </a>
                <?php }?>

            </div>
        </div>
    </div>
</section>
<?php
}
else {
    require_once ("navigationMenu.php");?>
<section class="section">
    <div class="container ">
        <div class="section-header">
            <h2 style="color: white" class="wow fadeInDown animated"><br>Your Cart is Empty!!</h2>
        </div>
        <a href="index.php">
            <button id="continueShopping" name="continueShopping" class="btn-info col-sm-offset-5">Continue Shopping</button>
        </a>
    </div>
<?php } ?>
</body>
<script>
    function checkout() {
        var url = "checkout.php";
        window.location.href = url;
    }
    function continueShopping() {
        var url = "headphones.php";
        window.location.href = url;
    }
    function clearCart() {
        if(confirm("Are you sure you want to empty the cart ?")){
            window.location.href = "viewCart.php?clear=1";
        }
    }
</script>