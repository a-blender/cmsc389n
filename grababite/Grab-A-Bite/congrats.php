<!-- Grab A Bite Congrats Page -->
<!-- Anna Blendermann, Ronnie Davis, Ashley Dear, Hunter Klamut -->

<?php
require_once("dbLogin.php");
require_once ("Student.php");

$body = <<<BODY
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Grab A Bite Homepage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="menu.css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

BODY;

if(isset($_POST['email'])){
    $emailArray = $_POST['email'];
    session_start();
    $email = $_SESSION['UserEmail'];

    $db_connection = new mysqli($host, $user, $dbpassword, $database);
    $result = $db_connection->query("SELECT * FROM users WHERE email = \"{$email}\"");

    $result->data_seek(0);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $friends = unserialize($row['friends']);

    foreach ($emailArray as $entry) {
        $temp = new Student($entry);
        $friends[] = $temp;
    }

    $serializedFriends = serialize($friends);
    $serializedFriends = $db_connection->real_escape_string($serializedFriends);

    $query = "update users set friends=\"{$serializedFriends}\" where email=\"{$email}\"";
    $worked = $db_connection->query($query);

    if($worked){
        $body .= "<div class=\"jumbotron text-center\">
            <h2>Congratulations, your new friends were added :)</h2>
            </div>
            
            <div class=\"container\">
            <div class=\"text-center\">
            <form action=\"menu.html\" method=\"post\">
                <input type=\"submit\" value=\"Go Home\" class=\"back\">
            </form>
            </div>
            </div>
            
            </div>
            </body>
            </html>";
    }else {
        $body .= "<div class=\"jumbotron text-center\">
            <h2>Sorry, no friends were added :(</h2>
            </div>
            
            <div class=\"container\">
            <div class=\"text-center\">
            <form action=\"menu.html\" method=\"post\">
                <input type=\"submit\" value=\"Go Home\" class=\"back\">
            </form>
            </div>
            </div>
            
            </div>           
            </body>
            </html>";
    }

}else{
    $body .= "<div class=\"jumbotron text-center\">
            <h2>Sorry, no friends were added :(</h2>
            </div>
            
            <div class=\"container\">
            <div class=\"text-center\">
            <form action=\"menu.html\" method=\"post\">
                <input type=\"submit\" value=\"Go Home\" class=\"back\">
            </form>
            </div>
            </div>

            </div>
            </body>
            </html>";
}
echo $body;
?>