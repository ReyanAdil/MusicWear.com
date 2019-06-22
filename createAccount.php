<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/10/2017
 * Time: 2:17 AM
 */
require_once ("commonScripts.php");
require_once ("config.php");
//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) {
    header("Location: index.php"); die();
}
//Forms posted
if(!empty($_POST))
{
    $errors = array();
    $success = "";
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $firstname = trim($_POST["fname"]);
    $lastname = trim($_POST["lname"]);
    $password = trim($_POST["password"]);
    $confirm_pass = trim($_POST["confirmPassword"]);


    if($password != $confirm_pass)
    {
        $errors[] = "Passwords do not match <br> Please fill in your details again..";
    }

    //End data validation
    if(count($errors) == 0)
    {
        $user = createNewUser($email, $firstname, $lastname, $username, $password);
        if($user <> 1){
            header("Location: registerationStatus.php?status=0"); die();
            //$errors[] = "Registration Error occured";
        }
    }
    if(count($errors) == 0) {
        header("Location: registerationStatus.php?status=1"); die();
        //$success = "Registration Successful";
    }
}
?>
<body>
<?php
require_once("navigationMenu.php");
?>
<div class="container">
    <div id="login-box">
        <div class="logo">
            <img src="images/login.png" class="img img-responsive img-circle center-block"/>
            <h1 class="logo-caption"><span class="tweak">R</span>egister</h1>
        </div><!-- /.logo -->
        <form name="registerForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <div class="controls">
                <div id="error">
                    <span class="errors">
                        <?php
                        if($errors!=null){
                            foreach ($errors as $error){
                                echo $error."<br>";
                            }
                        }
                        ?>
                    </span>
                </div>
                <input type="text" name="email" placeholder="Email" class="form-control controlSpacing" required />
                <input type="text" name="fname" placeholder="First Name" class="form-control controlSpacing" required />
                <input type="text" name="lname" placeholder="Last Name" class="form-control controlSpacing" required />
                <input type="text" name="username" placeholder="User Name" class="form-control controlSpacing" required />
                <a class="loginLinks" href="checkAvailability.php" hidden></a>
                <input type="password" name="password" placeholder="Password" class="form-control controlSpacing" required />
                <input type="password" name="confirmPassword" placeholder="Confirm Password" class="form-control" required />
                <button type="submit" class="btn btn-default btn-block btn-custom">Create Account</button>
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <a class="loginLinks" href="login.php">Already a member</a>
                    </div>
                </div>
            </div><!-- /.controls -->
        </form>
    </div><!-- /#login-box -->
</div><!-- /.container -->
<div id="particles-js"></div>
