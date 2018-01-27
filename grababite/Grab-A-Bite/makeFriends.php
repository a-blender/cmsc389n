<!-- Grab A Bite Make Friends Page -->
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
		    <h2>Make New Friends</h2>
		</div>
		<form action="congrats.php" method="post">
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
    $userTime = $user['specifications'];
    $userFood = $user['food'];
    $userFood = explode(",", $userFood);

    $userTime = explode(' ', $userTime);

    $query = "select * from users where email != '$email'";
    $result = $db_connection->query($query);

    if ($result) {
        $anyFriends = false;
        $numRow = mysqli_num_rows($result);

        if ($numRow == 0) {
            $body = "<h2>Sorry no new friends were found :(</h2>";
        } else {
            
            $body .= "<table border=1 bordercolor=#B50C0C>";
            $body .= "<th>Picture</th><th>First Name</th><th>Last Name</th><th>Foods</th>";
            $body .= "<th>Time Available</th><th>Age</th><th>Match?</th>";

            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $body .= "<tr>";
                $firstName = $recordArray['firstName'];
                $lastName = $recordArray['lastName'];
                $friendEmail = $recordArray['email'];

                $food = $recordArray['food'];
                $birthday= $recordArray['birthday'];
                $timeAvail = $recordArray['specifications'];
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

                $photo = $recordArray["photo"];

                $photodata = base64_encode($photo);
                $phoneNumber = $recordArray['telephoneNumber'];

                $exists = false;
                $size = count($userFriends);
                if ($size > 0){
                    $exists = alreadyExists($userFriends, $friendEmail);
                }

                if (checkTimes($userTime[0],$userTime[1],$timeAvail[0],$timeAvail[1]) && !$exists && hasCommonFood($userFood ,$food)){
                    $anyFriends = true;
                    $food = implode(", ", $food);
                    $body .= <<<TABLEDATA
                    <td><img src="data:image / jpeg;base64,{$photodata}" width='100' height='100'></td>
                    <td>$firstName</td>
                    <td>$lastName</td> 
                   
                    <td>$food</td>
                    <td>$firstHour[0]:$firstHour[1]$firstAmOrPm - $secondHour[0]:$secondHour[1]$secondAmOrPm</td>
                    <td>$birthday[3]</td>
                  
                    <td><input type='checkbox' name='email[]' value=$friendEmail></td></tr>
TABLEDATA;
                }
            }
        }
       $body .= "</table><br>";
    }

    function checkTimes($userStart, $userEnd, $friendStart, $friendEnd){
        if(($userStart <= $friendStart && $userEnd >= $friendStart) || ($userStart <= $friendStart && $userEnd >= $friendEnd) || ($userStart >= $friendStart && $userEnd <= $friendEnd) || ($userStart >= $friendStart && $userStart <= $friendEnd)){
            return true;
        }
        return false;
    }

    function alreadyExists($students, $email){
        foreach ($students as $student){
            if ($email == $student->getEmail()){
                return true;
            }
        }
        return false;
    }

    function hasCommonFood($userFoods, $friendFoods){
        foreach ($userFoods as $userFood){
            foreach ($friendFoods as $friendFood){
                if ($userFood == $friendFood){
                    return true;
                }
            }
        }
        return false;
    }

    if ($anyFriends == false){

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
		        <h2>Sorry, no new friends were found :(</h2>
		     </div>	
		     <form action="congrats.php" method="post"></form>	       
TOPBODY;
    }

    $body .= <<<BOTTOMBODY
        <div class="container">
        <div class="text-center"> 
        <input type="submit" name="addFriends" value="Add Friends" class="back"/>
        </form><br><br>
        
        <form action="menu.html" method="POST">
			<input type="submit" name="home" value="Go Home" class="back"/>
		</form>
		</div>
		</div>
	</body>
</html>
BOTTOMBODY;

echo $body;
?>