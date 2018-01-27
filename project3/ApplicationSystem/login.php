<!-- Database Login Page -->
<!-- by Anna Blendermann-->

<!-- Session Start -->
<?php session_start();
include("DBOperations.php"); ?>

<!-- Check Review/Update Button -->
<?php
if(isset($_POST['reviewButton'])) {
    $_SESSION["review"] = "clicked";
}
else if(isset($_POST['updateButton'])) {
    $_SESSION["update"] = "clicked";
} ?>

<!-- Verify Email and Password -->
<?php
if (isset($_POST['email']) && isset($_POST['password'])) {

    /* verify the email and password */
    $db = new DBOperations();
    if ($db->verifyPassword($_POST['email'], $_POST['password'])) {

        /* set session variable for email */
        $_SESSION["email"] = $_POST['email'];

        /* redirect to review/update pages after login */
        if (isset($_SESSION['review'])) {
            header("Location: confirm.php");

        } else if (isset($_SESSION['update'])) {
            header("Location: update.php");
        }
        // disconnect from database
        $db->disconnectFromDB();
    } else {
        echo "No entry exists in the database for the specified email and password";
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login Page</title>
</head>

<?php
$body = <<<EOBODY
<form action="{$_SERVER['PHP_SELF']}" method="post">

    <!-- Text Boxes for Email and Password -->
    <p>
        <strong>Email Associated with Application: </strong><input type="text" name="email" /><br /><br />
        <strong>Password Associated with Application: </strong><input type="password" name="password"/><br>
    </p>

    <!-- Submit Button -->
    <input type="submit" name="submitButton" value="Submit"/><br /><br />

</form>

<!-- Return to Main Menu -->
<form action="main.php" method="post">
    <input type="submit" name="mainButton" value="Return to Main Menu"/><br /><br />
</form>
EOBODY;

/* print out contents of the login page */
echo $body; ?>

</body>
</html>
