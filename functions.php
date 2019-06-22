<?php
/**
 * Created by PhpStorm.
 * User: ankit
 * Date: 12/10/2017
 * Time: 3:02 PM
 */

//function for checking if User is Logged In
function isUserLoggedIn(){
    global $loggedInUser,$mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserName,
		Password
		FROM ".$db_table_prefix."user_info
		WHERE
		UserName = ?
		AND
		Password = ?
		LIMIT 1");
    $stmt->bind_param("is", $loggedInUser->user_name, $loggedInUser->hash_pw);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if($loggedInUser == NULL)
    {
        return false;
    }
    else
    {
        if ($num_returns > 0)
        {
            return true;
        }
        else
        {
            destroySession("ThisUser");
            return false;
        }
    }
}

//Destroys a session as part of logout
function destroySession($name)
{
    if(isset($_SESSION[$name]))
    {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}

//function to fetch all Users
function fetchAllUsers(){
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		UID,
		FName,
		LName,
		Email,
		UserName,
		Password
		FROM " . $db_table_prefix . "user_info"
    );
    $stmt->execute();
    $stmt->bind_result($UID, $FName, $LName, $Email, $UserName, $Password);
    while ($stmt->fetch()){
        $row[] = array('UID' => $UID,
            'FName' => $FName,
            'LName' => $LName,
            'Email' => $Email,
            'UserName' => $UserName,
            'Password' => $Password);
    }
    $stmt->close();
    return ($row);
}

//function for generating random user id
function generateUserID(){
    $character_array = array_merge(range('a', 'z'), range(0, 9), range('A','Z'));
    $userID = "";
    for ($i = 0; $i < 6; $i++) {
        $userID .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }
    return $userID;
}

//function to check if userExists
function checkIfUserExists($userName){
    //collecting all users data
    $db_Users = fetchAllUsers();

    //getting randomly generated UserID
    $UID = generateUserID();

    $ifUserExists = false;

    //checking if userID or userName already Exists
    foreach ($db_Users as $db_User){
        if($db_User['UserName'] == $userName || $db_User['UID']== $UID){
            $ifUserExists = true;
            break;
        }
        else{
            $ifUserExists = false;
        }
    }
    return array($ifUserExists,$UID,$userName);

}

//function for generating hash password
function generateHash($plainText, $salt = NULL) {
    if ($salt === NULL) {
        $salt = substr(md5(uniqid(rand(), TRUE)), 0, 25);
    }
    else {
        $salt = substr($salt, 0, 25);
    }
    return $salt . sha1($salt . $plainText);
}

//function for creating new user
function createNewUser($email, $firstname, $lastname, $username, $password){
    global $mysqli, $db_table_prefix;

    //collecting information about if user already exists
    $ifUserExists = checkIfUserExists($username);
    $duplicateUser = $ifUserExists[0];

    //creating new user if user not exists (checking based on username or user id)
    if($duplicateUser == false){
        $UID = $ifUserExists[1];
        $UserName = $ifUserExists[2];
        $hashPassword = generateHash($password);
        $stmt = $mysqli->prepare(
            "INSERT INTO " . $db_table_prefix . "user_info (
		UID,
		FName,
		LName,
		Email,
		UserName,
		Password
		)
		VALUES (
		?,
		?,
		?,
		?,
		?,
		?
		)"
        );
        $stmt->bind_param("ssssss", $UID, $firstname, $lastname, $email, $UserName, $hashPassword);
        $result = $stmt->execute();
        $stmt->close();
    }
    else{
        //if user already exists
        $result = 0;
    }

    return $result;
}

//function for fetching UserData based on Username
function fetchThisUser($username){
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserName,
		FName,
		Email,
		Password
		FROM ".$db_table_prefix."user_info
		WHERE
		UserName = ?
		LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($UserName, $FName, $Email, $Password);
    $stmt -> execute();
    while ($stmt->fetch()){
        $row = array(
            'UserName' => $UserName,
            'FName' => $FName,
            'Email' => $Email,
            'Password' => $Password
        );
    }
    $stmt->close();
    return ($row);
}

//function to submit message in db
function submitMessage($name,$email,$comments){
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "contact_us (
            CEmail,
            CName,
		    CMessage
            )
            VALUES (            
            ?,
            ?,
            ?
            )"
    );
    $stmt->bind_param("sss", $email, $name, $comments);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

//function to fetch products based on Brand ID
function fetchProductsBasedOnBID($BId){
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		p.PID,
		p.PImgID,
		p.BID,
		p.PName,
		p.PDesc,
		p.PPrice,
		b.BName
		FROM ".$db_table_prefix."product_info p
		JOIN ".$db_table_prefix."brand_info b
		ON
		p.BID = b.BID
		WHERE
		p.BID = ?
		");
    $stmt->bind_param("i", $BId);
    $stmt->execute();
    $stmt->bind_result($PID, $PImgID, $BID, $PName, $PDesc, $PPrice, $BName);
    $stmt -> execute();
    while ($stmt->fetch()){
        $row[] = array(
            'PID' => $PID,
            'PImgID' => $PImgID,
            'BID' => $BID,
            'PName' => $PName,
            'PDesc' => $PDesc,
            'PPrice' => $PPrice,
            'BName' => $BName
        );
    }
    $stmt->close();
    return ($row);

}

//function for fetching Brands Image ID
function fetchAllBrandImgID(){
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
        "SELECT
		BImgID,
		BName
		FROM " . $db_table_prefix . "brand_info"
    );
    $stmt->execute();
    $stmt->bind_result($BImgID, $BName);
    while ($stmt->fetch()){
        $row[] = array(
            'BImgID' => $BImgID,
            'BName' => $BName
        );
    }
    $stmt->close();
    return ($row);
}

//function to fetch product details based on product id
function fetchThisProductDetails($prodID){
    global $mysqli,$db_table_prefix;

    $stmt = $mysqli->prepare("SELECT
		PName,
		PDesc,
		PPrice
		FROM ".$db_table_prefix."product_info
		WHERE
		PID = ?
		LIMIT 1");
    $stmt->bind_param("s", $prodID);
    $stmt->execute();
    $stmt->bind_result($PName, $PDesc, $PPrice);
    $stmt -> execute();
    while ($stmt->fetch()){
        $row = array(
            'PName' => $PName,
            'PDesc' => $PDesc,
            'PPrice' => $PPrice
        );
    }
    $stmt->close();
    return ($row);
}

//function to add products to cart
function addToCart($pID, $prodQty){
    global $loggedInUser,$mysqli,$db_table_prefix;
    if(isset($_SESSION['cart'][$pID])){
        $_SESSION['cart'][$pID]['qty']=$_SESSION['cart'][$pID]['qty']+$prodQty;
        if(isUserLoggedIn()){
            /*update the quantity in database too*/
            updateQtyInDbFromSession($loggedInUser->user_name,$pID,$_SESSION['cart'][$pID]['qty'] );
        }
    }
    else{
        $thisproduct = fetchThisProductDetails($pID);

        $_SESSION['cart'][$pID]['product_name']=$thisproduct['PName'];
        $_SESSION['cart'][$pID]['product_desc']=$thisproduct['PDesc'];
        $_SESSION['cart'][$pID]['product_price']=$thisproduct['PPrice'];
        $_SESSION['cart'][$pID]['product_code']=$pID;
        $_SESSION['cart'][$pID]['qty']=$prodQty;
        if(isUserLoggedIn()){
           insertToDB($loggedInUser->user_name,$_SESSION['cart'][$pID]);

        }
    }
    /* insert queries for logged in user do insert only afterwards check for previously inserted any value then update */
}

//function to check if product already exists in cart
function product_exists($pid){

    if(isset($_SESSION['cart'][$pid])){
        return 1;
    }
    else {
        return 0;
    }
}

//function to calculate no. of products in cart
function no_of_products(){
    $max = 0;
    if(isset($_SESSION['cart'])){
        $max=count($_SESSION['cart']);
    }
    return $max;
}

//function to insert into session from database for logged in user
function insertDatabaseToSession($userName){
    /*Db query fetch all information from cart table for this userName*/
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		PID,
		PName,
		PDesc,
		PPrice,
		PQuantity
		FROM ".$db_table_prefix."user_cart
		WHERE
		UID = ?
		");
    $stmt->bind_param("s",$userName);
    $stmt->execute();
    $stmt->bind_result($PID, $PName, $PDesc, $PPrice, $PQuantity);
    $stmt -> execute();
    while ($stmt->fetch()){
        addToSessionAfterLogin($PID,$PName, $PDesc, $PPrice, $PQuantity);
    }
    $stmt->close();
    return 0;
}

//function to add data to session when a user logged in
function addToSessionAfterLogin($pID, $PName,$PDesc,$PPrice,$qty) {
    if(isset($_SESSION['cart'][$pID])){
        $_SESSION['cart'][$pID]['qty']=$_SESSION['cart'][$pID]['qty']+$qty;
    }
    else{
        $_SESSION['cart'][$pID]['product_name']=$PName;
        $_SESSION['cart'][$pID]['product_desc']=$PDesc;
        $_SESSION['cart'][$pID]['product_price']=$PPrice;
        $_SESSION['cart'][$pID]['product_code']=$pID;
        $_SESSION['cart'][$pID]['qty']=$qty;
    }
}

// function to add session into database
function sessionToDatabase($userName) {
    /*
     * First delete all rows for selected user */
    deleteFromDbAfterLoginAtClearCart($userName);
    /* now for or foreach $_SESSION['cart'] values add to database user cart*/
    foreach ($_SESSION['cart'] as $key=> $value){
        insertToDB($userName, $value);
    }
}

//function for inserting data into database
function insertToDB($userName,$product_array){
    global $mysqli,$db_table_prefix;

    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "user_cart (
		PID,
		UID,
		PName,
		PDesc,
		PPrice,
		PQuantity
		)
		VALUES (
		?,
		?,
		?,
		?,
		?,
		?
		)"
    );
    $stmt->bind_param("ssssii", $product_array['product_code'], $userName, $product_array['product_name'],
        $product_array['product_desc'], $product_array['product_price'], $product_array['qty']);
    $stmt->execute();
    $stmt->close();
}

//function to delete entries from cart once cart is cleared
function deleteFromDbAfterLoginAtClearCart($userName){
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare("DELETE FROM ".$db_table_prefix."user_cart
		WHERE
		UID = ?
		");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $stmt->close();
}

//function to add billing information
function addBillingInfo($username, $FName, $LName, $Street, $City, $State, $Zip, $Country){
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "billing_address_info (	  
		UID,
		FName,
		LName,
		Street,
		City,
		State,
		Zip,
		Country
		)
		VALUES (
		?,
		?,
		?,
		?,
		?,
		?,
		?,
		?		
		)"
    );
    $stmt->bind_param("ssssssis", $username, $FName, $LName, $Street, $City, $State, $Zip, $Country);
    $result = $stmt->execute();
    $stmt->close();
    return $result;

}

//function to update quantity in database if any product's quantity is updated in session
function updateQtyInDbFromSession($userName, $pID, $pQty){
    global $mysqli,$db_table_prefix;
    $stmt = $mysqli->prepare(
        "UPDATE " . $db_table_prefix . "user_cart 
         SET 
         PQuantity = ?
         WHERE 
         PID = ?
         AND 
         UID = ?
         LIMIT 1"
    );
    $stmt->bind_param("sss", $pQty, $pID, $userName);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

?>