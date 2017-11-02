<!-- Submit Application Form -->
<!-- by Anna Blendermann-->

<!-- Session Start -->
<?php session_start() ?>

<!-- Check Submit Application Button -->
<?php $_SESSION["submit"] = "clicked"; ?>

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
        <strong>Name: </strong><input type="text" name="name" /><br /><br />
        <strong>Email: </strong><input type="text" name="email" /><br /><br />
        <strong>GPA: </strong><input type="text" name="gpa" /><br />
    </p>

    <!-- Radio Buttons for Year -->
    <p>
        <strong>Year: </strong>
        10<input type="radio" name="year" value="10" />
        11<input type="radio" name="year" value="11" />
        12<input type="radio" name="year" value="12" /><br />
    </p>

    <!-- Radio Buttons for Gender -->
    <p>
        <strong>Gender </strong>
        M<input type="radio" name="gender" value="M" />
        F<input type="radio" name="gender" value="F" /><br />
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