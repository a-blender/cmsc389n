<!-- Update Application Form -->
<!-- by Anna Blendermann-->

<!-- Session Start -->
<?php session_start() ?>

<!-- Check Update Application Button -->
<?php $_SESSION["update"] = "clicked"; ?>

<!-- Get Database Entry -->
<?php
include ("DBOperations.php");
$db = new DBOperations();
$array = $db->getEntry($_SESSION['email']);
$db->disconnectFromDB();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Submit Application</title>
</head>

<body>

<form action="confirm.php" method="post">

    <!-- Text Boxes for Name, Email, and GPA -->
    <p>
        <strong>Name: </strong><input type="text" name="name" value=<? echo $array['name'] ?> /><br /><br />
        <strong>Email: </strong><input type="text" name="email" readonly value=<? echo $array['email'] ?> /><br /><br />
        <strong>GPA: </strong><input type="text" name="gpa" value=<? echo $array['gpa'] ?> /><br />
    </p>

    <!-- Radio Buttons for Year -->
    <p>
        <strong>Year: </strong>
        <?php
        if ($array['year'] == 10) {
            echo "10<input type=\"radio\" name=\"year\" value=\"10\" checked='checked'/>";
        }
        else {
            echo "10<input type=\"radio\" name=\"year\" value=\"10\" />";
        }

        if ($array['year'] == 11) {
            echo "11<input type=\"radio\" name=\"year\" value=\"11\" checked='checked'/>";
        }
        else {
            echo "11<input type=\"radio\" name=\"year\" value=\"11\" />";
        }

        if ($array['year'] == 12) {
            echo "12<input type=\"radio\" name=\"year\" value=\"12\" checked='checked'/>";
        }
        else {
            echo "12<input type=\"radio\" name=\"year\" value=\"12\" />";
        } ?>
    </p>

    <!-- Radio Buttons for Gender -->
    <p>
        <strong>Gender </strong>
        <?php
        if ($array['gender'] == 'M') {
            echo "M<input type=\"radio\" name=\"gender\" value=\"M\" checked='checked'/>";
        }
        else {
            echo "10<input type=\"radio\" name=\"year\" value=\"10\" />";
        }

        if ($array['gender'] == 'F') {
            echo "F<input type=\"radio\" name=\"gender\" value=\"F\" checked='checked'/>";
        }
        else {
            echo "F<input type=\"radio\" name=\"year\" value=\"F\" />";
        }?>
    </p>

    <!-- Password and Verify Password -->
    <strong>Password: </strong><input type="password" name="password"/><br><br />
    <strong>Verify Password: </strong><input type="password" name="verify"/><br><br />

    <!-- Submit Button -->
    <input type="submit" name="submitButton" value="Submit Data"/><br /><br />

</form>

<!-- Return to Main Menu -->
<form action="main.php" method="post">
    <input type="submit" name="mainButton" value="Return to Main Menu"/><br /><br />
</form>

</body>
</html>