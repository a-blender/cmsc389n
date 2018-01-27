<!-- Grab A Bite Sign Up Page -->
<!-- Anna Blendermann, Ronnie Davis, Ashley Dear, Hunter Klamut -->

<?php
$fn = "";
$ln = "";
$email = "";
$password = "";
$pn = "";
$bd = "";
$text = "";
$startAvail = "";
$endAvail = "";
$avail = "";
$fileName= "";
$imgData;
$page = "";
$validEmail = "";

require_once ("dbLogin.php");

if (isset($_POST["submitButton"])) {
    if ($_POST["submitButton"] === "Go Back") {
        header("Location: homepage.php");
    } else {
        $email = trim($_POST["email"]);

        $db_connection = new mysqli($host, $user, $dbpassword, $database);
        $result = $db_connection->query("SELECT 1 FROM users WHERE email = \"{$email}\"");

        if ($result->num_rows === 0) {

            $fn = trim($_POST["firstName"]);
            $ln = trim($_POST["lastName"]);

            $password = trim($_POST["password"]);
            $pn = $_POST["telephoneNumber"];
            $bd = $_POST["birthday"];
            $food = implode(",", $_POST["food"]);
            $text = nl2br(trim($_POST["text"]));
            $startAvail = $_POST["usr-start-time"];
            $endAvail = $_POST["usr-end-time"];
            $avail = $startAvail . " " . $endAvail;

            $arr = [];
            $friendsArray = serialize($arr);

            if ($_FILES['picture']['tmp_name'] === "") {
                $imgData = $db_connection->real_escape_string(
                    file_get_contents("ProfilePictures/defaultProfile.png"));
            } else {
                $imgData = $db_connection->real_escape_string(file_get_contents($_FILES['picture']['tmp_name']));
            }

            $pwhash = password_hash($password, PASSWORD_DEFAULT);
            $db_connection->query("insert into users VALUES 
                                (\"{$fn}\", \"{$ln}\", \"{$email}\",
                                \"{$pwhash}\", \"{$pn}\", \"{$bd}\",
                                \"{$food}\", \"{$text}\", \"{$avail}\", \"{$imgData}\", \"{$friendsArray}\")");

            $db_connection->close();

            session_start();
            $_SESSION["UserEmail"] = $email;

            header("Location: menu.html");
        } else {
            $validEmail = "Account already exists under this email.";
        }
    }
}

if(isset($_POST['email']) && $result->num_rows > 0){
    $page .= "<h2>Email already in system</h2>";
}
$page = <<< THIS
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title>Sign Up Page</title>
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
	<form enctype="multipart/form-data" action="signup.php" method="POST">
    	<hr><br>
        
        <!-- First Name -->
    	First Name: <input type="text" name="firstName" id="firstName" value="$fn">
        
        <!-- Last Name -->
		Last Name: <input type="text" name="lastName" value="$ln" id="lastName"><br>
        <hr><br>
        
        <!-- Email -->
        <h1><strong>$validEmail</strong></h1>
		Email: <input id="email" type="email" name="email" value="$email"> 
        
        <!-- Password -->
		Password: <input  type="password" name="password" id="password" value="$password"/><br>
        <hr><br>
        
        <!-- Phone Number -->
		Phone Number: <input type="tel" name="telephoneNumber" id="phone" value="$pn">
        
        <!-- Birth Date -->
		Birthday: <input type="date" name="birthday" value="$bd"><br>
        <hr><br>
        
        <!-- Types of Food -->
		Select the Types of Food You Like:<br><br>
        <div class="form-group row">
        	<div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="American"> American  
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Mexican"> Mexican
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Italian"> Italian
            </div>
            <div class="col-sm-2">
        		<input type="checkbox" name="food[]" value="Asian"> Asian
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Caribbean"> Caribbean
            </div>
            <div class="col-sm-2">
        	<input type="checkbox" name="food[]" value="Buffet"> Buffet<br><br>
            </div>
        </div>
        <hr><br>
        
        <!-- Personal Description -->
		Tell us a little about yourself or some of the foods you enjoy!<br><br>
		<textarea rows="5" cols="75" name="text" value="$text"> </textarea><hr><br>
       
        
     	<!-- Availability -->
		When are you available?<br><br>
		Starting From: <input type="time" name="usr-start-time"> Until: <input type="time" name="usr-end-time"><br>
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
		<input type="submit" name="submitButton" id="submit" value="Submit" class="buttons">
		<input type="submit" name="submitButton" id="back" value="Go Back" class="back"/>
    	<hr>
        
	</form>
    </div>
    
    <!-- Javascript Validation file -->
    <script src="validateSignup.js"></script>  
</body>
</html>
THIS;

echo $page;
