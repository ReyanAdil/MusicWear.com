<?php
/**
 * Created by PhpStorm.
 * User: jhawa
 * Date: 12/10/2017
 * Time: 2:51 PM
 */
//Development Database Information
//$db_host = "10.0.0.105"; //Host address (most likely localhost)
//$db_host = "localhost";
//$db_name = "headphonesdb"; //Name of Database
//$db_user = "root"; //Name of database user
//$db_pass = "root"; //Password for database user
//$db_table_prefix = ""; // if the table prefix exists use this variable as a global

// Heroku information
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$db_host = $url["host"];
$db_user = $url["user"];
$db_pass = $url["pass"];
$db_name = substr($url["path"],1);




//following variable declaration is for next class :)
GLOBAL $errors;
GLOBAL $successes;

$errors = array();
$successes = array();

/* Create a new mysqli object with database connection parameters */

$mysqli = new mysqli($db_host,$db_user,$db_pass,$db_name);
GLOBAL $mysqli;

if (mysqli_connect_errno()) {
    //display the reason for mysql connection error.
    echo "Connection Failed: " . mysqli_connect_errno();
    exit();

} else {
    //echo "Connection Successful";
}