<?php
/**
 * Created by PhpStorm.
 * User: Oontsk
 * Date: 11/30/2017
 * Time: 5:37 PM
 */
//Grab A Bite Homepage -->
//Anna Blendermann, Ronnie Davis, Ashley Dear, Hunter Klamut -->
session_start();
if (isset($_POST["Go-home"]) && $_POST["Go-home"] === "Logout") {
    $_SESSION["UserEmail"] = "";
}
if (isset($_SESSION["UserEmail"]) && $_SESSION["UserEmail"] !== "") {
    header("Location: menu.html");
}

require_once ("dbLogin.php");
$email = "";
$password = "";
$invalid = "";
$page = "";

if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($email === "" || $password === "") {
        $invalid .= "<h2>Cannot leave username or password field blank.</h2>";
    } else {

        $db_connection = new mysqli($host, $user, $dbpassword, $database);

        if ($db_connection->connect_error) {
            die($db_connection->connect_error);
        }

        $query = "select * from users where email=\"{$email}\"";
        $result = $db_connection->query($query);


        if ($result->num_rows === 0) {
            $invalid .= "<h2>No entry exists in our database for the specified email and password.</h2>";
        } else {
            $result->data_seek(0);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['UserEmail'] = $email;
            } else {
                $invalid .= "<h2>Incorrect password entered.</h2>";
            }
        }
    }

    if ($invalid === "") {
        header("Location: menu.html");
    }
}

$page = <<<THIS

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

<!-- Grab A Bite home page -->
<div class="jumbotron text-center">
    <h1>Welcome to Grab A Bite</h1>
    <p>Your guide to finding partners who love food.</p>
<p>$invalid</p>
</div>

<div class="container">
    <div class="text-center">

        <!-- User Login section -->
        <hr><br>
        <h3>Have you been here before?</h3><br>
        <form action="homepage.php" method="POST">
    Username/Email: <input type="email" name="email" value="$email"/><br><br>
Password: <input type="password" name="password" value="$password"/><br><br>
            <input type="submit" name="login" value="Log In" class="buttons"/><br><br>
        </form>
        <hr><br>

        <!-- User Signup section -->
        <h3>Are you a new friend?</h3><br>
        <form action="signup.php" method="POST">
            <input type="submit" name="signup" value="Sign Up" class="buttons"/><br><br>
            <hr>
        </form>
    </div>
</div>


</body>
</html>

THIS;

echo $page;
?>