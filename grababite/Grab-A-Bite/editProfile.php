




<?php


session_start();
$email = $_SESSION["UserEmail"];

require_once ("dbLogin.php");

$db_connection = new mysqli($host,$user,$dbpassword,$database);
$result = $db_connection->query("Select firstName,lastName,telephoneNumber,birthday,text,specifications,food from users where email = \"{$email}\"");

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$fn = $row['firstName'];
$ln = $row['lastName'];
$password = "";
$pn = $row['telephoneNumber'];
$bd = $row['birthday'];
$text = $row['text'];
$avail = $row['specifications'];
$foodSnipe = $row['food'];
$food = explode(",", $foodSnipe);
$fixAvail = explode(" ", $avail);
$startAvail = $avail[0];
$endAvail = $avail[1];
$fileName= "";
$imgData;
$page = "";


$checked1 = "";
$checked2 = "";
$checked3 = "";
$checked4 = "";
$checked5 = "";
$checked6 = "";


if (in_array("American", $food)) {
    $checked1 = "checked=\"checked\"";
}
if (in_array("Mexican", $food)) {
    $checked2 = "checked=\"checked\"";
}
if (in_array("Italian", $food)) {
    $checked3 = "checked=\"checked\"";
}
if (in_array("Asian", $food)) {
    $checked4 = "checked=\"checked\"";
}
if (in_array("Caribbean", $food)) {
    $checked5 = "checked=\"checked\"";
} if (in_array("Buffet", $food)) {
    $checked6 = "checked=\"checked\"";
}


if (isset($_POST["submitButton"])) {
    if ($_POST["submitButton"] === "Go Back") {
        header("Location: menu.html");
    } else {
        $fn = trim($_POST["firstName"]);
        $ln = trim($_POST["lastName"]);
        $pn = $_POST["telephoneNumber"];
        $bd = $_POST["birthday"];
        $food = implode(",", $_POST["food"]);
        $text = nl2br(trim($_POST["text"]));
        $startAvail = $_POST["usr-start-time"];
        $endAvail = $_POST["usr-end-time"];
        $avail = $startAvail . " " . $endAvail;



        if ($_FILES['picture']['tmp_name'] === "") {
            $imgData = $row['photo'];
        } else {
            $imgData = $db_connection->real_escape_string(file_get_contents($_FILES['picture']['tmp_name']));
        }

        $pwhash = password_hash($password, PASSWORD_DEFAULT);

        $db_connection->query("update tables set firstName = \"{$fn}\", lastName=\"{$ln}\", 
                                password = \"{$pwhash}\", telephoneNumber = \"{$pn}\", birthday=\"{$bd}\",
                                food =\"{$food}\", text=\"{$text}\", specifications=\"{$avail}\", photo=\"{$imgData}\"
                                where email = \"$email\"");
        $db_connection->close();
        header("Location: menu.html");
    }
}



$page = <<< THIS
		<!DOCTYPE html>
		<html>
		<head>
		<meta charset="UTF-8">
			<title>Edit Profile</title>
		    
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		    <link rel="stylesheet" href="menu.css"/>
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		</head>
		<body>
			<div class="container">
		    <div class="text-center">
			<form enctype="multipart/form-data" action="editProfile.php" method="POST">
		    	<hr><br>
		        
		         <!-- First Name -->
    	First Name: <input type="text" name="firstName" value="$fn">
        
        
        <!-- Last Name -->
		Last Name: <input type="text" name="lastName" value="$ln"><br>
        <hr><br>
        
        <!-- Email -->
       
		Email: <input type="email" name="email" value="$email" required="required" readonly="readonly"> 
        
        <!-- Password -->
		Password: <input type="password" name="password" value="$password"/><br>
        <hr><br>
        
        <!-- Phone Number -->
		Phone Number: <input type="tel" name="telephoneNumber" value="$pn">
        
        <!-- Birth Date -->
		Birthday: <input type="date" name="birthday" value="$bd"><br>
        <hr><br>
        
        <!-- Types of Food -->
		Select the Types of Food You Like:<br><br>
        <div class="form-group row">
        	<div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="American" $checked1> American  
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Mexican" $checked2> Mexican
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Italian" $checked3> Italian
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Asian" $checked4> Asian
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Caribbean" $checked5> Caribbean
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Buffet" $checked6> Buffet<br><br>
            </div>
        </div>
        <hr><br>
        
        <!-- Personal Description -->
		Tell us a little about yourself or some of the foods you enjoy!<br><br>
		<textarea rows="5" cols="75" name="text" value="{$text}" content="{$text}"> </textarea><hr><br>
       
        
     	<!-- Availability -->
		When are you available?<br><br>
		Starting From: <input type="time" name="usr-start-time" value="{$startAvail}"> Until: <input type="time" name="usr-end-time" value="{$endAvail}"><br>
        <hr><br>

		<!-- Profile Picture -->
        <div class="container" text-align="center">
        Upload your profile picture: <br><br> 
        </div>
        
        <div class="form-group text-center">
    		<div class="input-group" style="margin:auto;">
      			<input type="file" name="picture" accept="image/*" id="filePic"><br>
    		</div>
    	</div>
        <hr><br>
       
    	<!-- Reset, Submit, and Go Back buttons -->
		<input type="reset" value="Clear" class="buttons">
		<input type="submit" name="submitButton" value="Submit" class="buttons">
		<input type="submit" name="submitButton" value="Go Back" class="back"/>
    	<hr>
        
	</form>
    </div>
    
    
</body>
</html>
THIS;



echo $page;

