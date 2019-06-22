<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 13-12-2017
 * Time: 15:05
 */
require_once ("commonScripts.php");
require_once ("config.php");
//Form Posted
if(!empty($_POST)) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $comments = trim($_POST["comments"]);

    //submitting message into the database
    $messageSent = submitMessage($name, $email, $comments);
}
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<!-- contact section -->
<section id="contact" class="section">
    <div class="container">
        <div class="section-header">
            <h1 style="color: steelblue" class="wow fadeInDown animated">Contact Us</h1>
            <p class="wow fadeInDown animatd">For any suggestions or feedback please leave us a message</p>
        </div>
            <div class="col-md-10 col-md-offset-1">
                <?php
                if(isset($messageSent)){
                    if($messageSent == 1 ){?>
                        <div id="success" class="alert alert-success">
                            <strong>Success!</strong> Your message has been sent successfully.
                        </div>
                    <?php } else{?>
                        <div id="error" class="alert alert-danger">
                            <strong>Error!</strong> An error has occurred while sending message.<br>Please try again.
                        </div>
                <?php }} ?>
            </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 conForm">
                <form name='cform' action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <input name="name" id="name" type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" placeholder="Your name..." required >
                    <input name="email" id="email" type="email" class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 noMarr" placeholder="Email Address..." required >
                    <textarea name="comments" id="comments" cols="" rows="" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" placeholder="Message..." required></textarea>
                    <button type="submit" id="submit" name="send" class="submitBnt">Send</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- contact section -->
<?php
require_once ("footer.php");
?>

