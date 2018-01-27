<!-- Grab A Bite My Matches Page -->
<!-- Anna Blendermann, Ronnie Davis, Ashley Dear, Hunter Klamut -->

<?php
/**
 * Created by PhpStorm.
 * User: ronalddavis
 * Date: 11/29/17
 * Time: 5:34 PM
 */

require_once("dbLogin.php");
require_once("Student.php");

$body = <<<TOPBODY
<!DOCTYPE html>
<html>
	<head>
		<title>Make Friends</title>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="menu.css"/>
        <link rel="stylesheet" href="makeFriends.css"/>
        <link rel="shortcut icon" href="favicon.ico"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
	    <div class="jumbotron text-center">
		    <h2>My Friends</h2>
		    <form action="menu.html" method="post">
		</div>
TOPBODY;

//Connect to DB
$db_connection = new mysqli($host, $user, $dbpassword, $database);

if ($db_connection->connect_error){
    die($db_connection->connect_error);
}

session_start();
$email = $_SESSION['UserEmail'];
$query2 = "select * from users where email = '$email'";
$result2 = $db_connection->query($query2);

$user = mysqli_fetch_array($result2, MYSQLI_ASSOC);
$userFriends = unserialize($user['friends']);

$count = count($userFriends);

if($count == 0){
    $body .= "<h2>Sorry you haven't made any friends yet :(</h2>";
}else {
    $body .= "<table border=1 bordercolor=#B50C0C>";
    $body .= "<th>Picture</th><th>First Name</th><th>Last Name</th><th>Email</th>";
    $body .= "<th>Foods</th><th>Time Available</th><th>Age</th><th>Phone Number</th>";

    foreach ($userFriends as $friend){

        $friendEmail = $friend->getEmail();

        $query = "select * from users where email = '$friendEmail'";
        $result = $db_connection->query($query);

        $currFriend = $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $body .= "<tr>";
        $firstName = $currFriend['firstName'];
        $lastName = $currFriend['lastName'];
        $friendEmail = $currFriend['email'];

        $food = $currFriend['food'];
        $birthday= $currFriend['birthday'];
        $timeAvail = $currFriend['specifications'];

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
        $birthday = explode("-", $birthday);

        $birthday[3] = 2017 - $birthday[0];

        $photo = $currFriend["photo"];

        $photodata = base64_encode($photo);
        $phoneNumber = $currFriend['telephoneNumber'];


            $food = implode(", ", $food);
            $body .= <<<TABLEDATA
                    <td><img src="data:image / jpeg;base64,{$photodata}" width='100' height='100'></td>
                    <td>$firstName</td>
                     <td>$lastName</td> 
                     <td>$friendEmail</td> 
                     <td>$food</td>
                    <td>$firstHour[0]:$firstHour[1]$firstAmOrPm - $secondHour[0]:$secondHour[1]$secondAmOrPm</td>
                    <td>$birthday[3]</td>
                    <td>$phoneNumber</td>
                   </tr>
TABLEDATA;

    }
    $body .= "</table><br>";
}

$body .= <<<BOTTOMBODY
			<input type="submit" name="home" value="Go Home" class="back"/>
		</form>
	</body>
</html>
BOTTOMBODY;

echo $body;
?>