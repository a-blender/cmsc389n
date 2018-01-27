<?php
require_once("dbLogin.php");

$db_connection = new mysqli($host, $user, $dbpassword, $database);

if ($db_connection->connect_error){
    die($db_connection->connect_error);
}

session_start();
$email = $_SESSION['UserEmail'];
$query = "select * from users where email='$email'";
$result = $db_connection->query($query);

$result->data_seek(0);
$row = $result->fetch_array(MYSQLI_ASSOC);

$photo = $row["photo"];

$photodata = base64_encode($photo);

$imgData = "<img src=\"data:image/;base64,{$photodata}\" height='250' width='250' style='border-style: solid;
    border-color: black;'>";  //THE PROFILE PICTUREEEEEE, EDIT THIS INTO PAGE

$firstName = $row['firstName'];
$lastName = $row['lastName'];
$telephoneNumber = $row['telephoneNumber'];
$birthday= $row['birthday'];
$food = $row['food'];
$text = $row['text'];
$timeAvail = $row['specifications'];

$timeAvail = explode(" ", $timeAvail);
$firstHour = explode(":", $timeAvail[0]);
$secondHour = explode(":", $timeAvail[1]);

if ($firstHour[0] < 13) {
    $firstAmOrPm = "am";
} else {
    $firstHour[0] = $firstHour[0] - 12;
    $firstAmOrPm = "pm";
}

if ($secondHour[0] < 13) {
    $secondAmOrPm = "am";
} else {
    $secondHour[0] = $secondHour[0] - 12;
    $secondAmOrPm = "pm";
}

$food = explode(",", $food);
$food = implode(", ", $food);

$birthday = explode("-", $birthday);

switch ($birthday[1]) {
    case 1:
        $birthday[1] = "January";
        break;
    case 2:
        $birthday[1] = "February";
        break;
    case 3:
        $birthday[1] = "March";
        break;
    case 4:
        $birthday[1] = "April";
        break;
    case 5:
        $birthday[1] = "May";
        break;
    case 6:
        $birthday[1] = "June";
        break;
    case 7:
        $birthday[1] = "July";
        break;
    case 8:
        $birthday[1] = "August";
        break;
    case 9:
        $birthday[1] = "September";
        break;
    case 10:
        $birthday[1] = "October";
        break;
    case 11:
        $birthday[1] = "November";
        break;
    case 12:
        $birthday[1] = "December";
        break;
}

$birthday[3] = 2017 - $birthday[0];


$body = <<<BODY
    <!DOCTYPE html>
    <html>
    <head>
        <title>My Profile</title>       
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="menu.css"/>
		<link rel="shortcut icon" href="favicon.ico"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    
    <div class="jumbotron text-center">
		<h2>This is your profile, $firstName $lastName.</h2><br><br>
    	$imgData<br><br>
	</div>

    <div class="container">
    <div class="text-center">
    
    <div class="form-group">
		<div class="col-sm-4">       
    	<strong>Name: </strong>$firstName $lastName<br><br>        
       	<strong>Current Age: </strong>$birthday[3]<br><br> 
        <strong>Birthday: </strong>$birthday[1] $birthday[2]<br><br>
        </div>
    </div>
    
   	<div class="col-sm-4">
    	<strong>Favorite Kinds of Foods: </strong>$food<br><br> 
        <strong>Biography: </strong>$text<br><br>
    </div>
    
    <div class="col-sm-4">
    	<strong>Time Availability: </strong>
       		$firstHour[0]:$firstHour[1]$firstAmOrPm - $secondHour[0]:$secondHour[1]$secondAmOrPm
    	<br><br>
        <strong>Contact Information: </strong>$telephoneNumber[0]$telephoneNumber[1]$telephoneNumber[2]-$telephoneNumber[3]$telephoneNumber[4]$telephoneNumber[5]-$telephoneNumber[6]$telephoneNumber[7]$telephoneNumber[8]$telephoneNumber[9]<br><br>
    </div>   

	<div class="form-group row">
    <div class="col-sm-12">
    <hr><br>
    <form action="editProfile.php" method="POST">
        <input type="submit" name="edit" value="Edit My Profile" class="buttons"/>
    </form><br>
    <form action="menu.html" method="POST">
        <input type="submit" name="home" value="Go Home" class="back"/>
    </form><hr>
    </div>
    </div>
    
    </div>
    </div> 
</body>
</html>
BODY;

echo $body;
?>
