<!-- UMCP Application System (Main Menu) -->
<!-- by Anna Blendermann-->

<!-- Session Unset and Start -->
<?php session_start() ?>

<!-- Unset Session Variables -->
<?php
if (isset($_SESSION['submit'])) {
    unset($_SESSION['submit']);
}
if (isset($_SESSION['review'])) {
    unset($_SESSION['review']);
}
if (isset($_SESSION['update'])) {
    unset($_SESSION['update']);
} ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>UMCP Application System</title>
    <link rel="stylesheet" href="main.css" />
</head>

<body>

<br />

<!-- UMD Logo Image -->
<img src="http://www.cs.umd.edu/class/fall2017/cmsc389N/content/projects/ApplicationSystem/p3_files/umdLogo.gif" alt="UMD Logo"><br />

<hr>

<div class="header">
    <!-- Testudo Image -->
    <img src="http://www.cs.umd.edu/class/fall2017/cmsc389N/content/projects/ApplicationSystem/p3_files/testudo.jpg" alt="Testudo">

    <!-- Welcome to the Application System -->
    <h1>Welcome to the UMCP<br />Application System</h1><br /><br />
</div>

<!-- Submit Application Button -->
<form action="submit.php" method="post">
    <input type="submit" name="submitButton" value="Submit Application"/><br /><br />
</form>

<!-- Review Application Button -->
<form action="login.php" method="post">
    <input type="submit" name="reviewButton" value="Review Application"/><br /><br />
</form>

<!-- Update Application Button -->
<form action="login.php" method="post">
    <input type="submit" name="updateButton" value="Update Application"/><br /><br />
</form>

<!-- Administrative Button -->
<form action="admin.php" method="post">
    <input type="submit" name="adminButton" value="Administrative"/><br /><br />
</form>

<hr>

<!-- Questions about our program -->
<p>If you have any questions about our program, please contact the system administrator at
    <a href="mailto:annablender91@gmail.com">annablender91@gmail.com</a>.</p>

</body>
</html>