<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 19-12-2017
 * Time: 00:21
 */
require_once ("commonScripts.php");
require_once ("config.php");
$error_register =0;
if(!empty($_POST)){
    $errors = array();
    $success = "";

    $username = $loggedInUser->user_name;
    $FName = trim($_POST["fName"]);
    $LName = trim($_POST["lName"]);
    $Street = trim($_POST["street"]);
    $City = trim($_POST["city"]);
    $State = trim($_POST["state"]);
    $Country = trim($_POST["country"]);
    $Zip = trim($_POST["zip"]);

    $billingDetails = addBillingInfo($username, $FName, $LName, $Street, $City, $State, $Zip, $Country);
    if($billingDetails != 1){
        $error_register = 1;
    }
    else{

        header("location: paymentinfo.php"); die();
    }
}
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- Billing info section -->
<section id="contact" class="section">
    <div class="container">
        <div class="section-header">
            <h1 style="color: steelblue" class="wow fadeInDown animated">Billing Information</h1>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 conForm">
                <form name='Billingform' action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <input name="fName" id="Fname" type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" placeholder="Your First name..." required >
                    <input name="lName" id="Lname" type="text" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="Your Last name" required >
                    <input name="street" id="street" type="text" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="Street" required >
                    <input name="city" id="city" type="text" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="City" required >
                    <input name="state" id="state" type="text" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="State" required >
                    <input name="zip" id="Zip" type="text" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="Zip" required >
                    <input name="country" id="Country" type="text" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="Country" required >
                    <button type="submit" id="submit" name="send" class="submitBnt">Continue to checkout</button>
                </form>
                <br>
            </div>
        </div>
<!-- Billing info section -->
        <script>
            if(<?php echo $error_register?>){
                alert("Registration Error occured");
            }
            </script>
<?php
require_once ("footer.php");
?>

