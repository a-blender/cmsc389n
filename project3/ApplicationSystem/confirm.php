<!-- Database Confirmation Page -->
<!-- by Anna Blendermann-->

<!-- Session Start -->
<?php session_start();
include ("DBOperations.php"); ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Confirmation Page</title>
</head>
<body>

<?php
/* initialize connection with database */
$db = new DBOperations();

/* initialize array to display data */
$array = array();

/* SUBMIT APPLICATION **********************************************/
if (isset($_SESSION['submit'])) {

    // encrypt the password with a hash
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // connect to the database and submit application
    $db->submitApp($_POST['name'], $_POST['email'], $_POST['gpa'], $_POST['year'], $_POST['gender'], $hash);
    $array = $db->getEntry($_POST['email']);
}

/* REVIEW APPLICATION**********************************************/
else if (isset($_SESSION['review'])) {

    // show message for review application
    echo "<h2>Application found in the database with the following values:</h2>";

    // retrieve application from the database for review
    $email = $_SESSION['email'];
    $array = $db->getEntry($email);
}

/* UPDATE APPLICATION**********************************************/
else if (isset($_SESSION['update'])) {

    // encrypt the password with a hash
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // update the application in the database
    $db->updateApp($_POST['name'], $_POST['email'], $_POST['gpa'], $_POST['year'], $_POST['gender'], $hash);
    $array = $db->getEntry($_POST['email']);
}

// disconnect from the database
$db->disconnectFromDB(); ?>

<!-- Database Entry (Name, Email, GPA, Year, Gender -->
<p>
    <strong>Name: </strong><?php print $array['name'] ?><br />
    <strong>Email: </strong><?php print $array['email'] ?><br />
    <strong>GPA: </strong><?php print $array['gpa'] ?><br />
    <strong>Year: </strong><?php print $array['year'] ?><br />
    <strong>Gender: </strong><?php print $array['gender'] ?><br />
</p>

<!-- Return to Main Menu -->
<form action="main.php" method="post">
    <input type="submit" name="mainButton" value="Return to Main Menu"/><br /><br />
</form>

</body>
</html>