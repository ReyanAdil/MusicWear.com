<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/13/2017
 * Time: 3:41 PM
 */
require_once ("commonScripts.php");
require_once ("config.php");
$status = $_GET['status'];
if($status == 0){
    echo "Username Already Exists..<br>Please <a href='createAccount.php'>Register</a> again!!";
}
else{
    echo "Registeration successful..!! <br>Please <a href='login.php'>Login</a>";
}
?>
