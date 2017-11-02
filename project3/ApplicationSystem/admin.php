<!-- Admin Authentication and Options -->
<!-- by Anna Blendermann-->

<?php
$user = "main";
$password = "terps";

if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) &&
    $_SERVER['PHP_AUTH_USER'] == $user && $_SERVER['PHP_AUTH_PW'] == $password) {

    $body = <<<EOBODY
<!doctype html>
<html>
    <head> 
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Authentication Window</title>	
    </head>
            
    <body>
            
<form action="admin2.php" method="post">

    <!-- Applications Header -->
    <h1>Applications</h1>

    <!-- Scrollbar for Database Fields /-->
    <p>
    <em>Select fields to display</em><br /><br />
    <select name="options[]" multiple>
        <option value="Name">name</option>
        <option value="Email">email</option>
        <option value="GPA">gpa</option>
        <option value="Year">year</option>
        <option value="Gender">gender</option>
    </select>
    </p>
    
    <!-- Drop Down Menu for Database Fields /-->
    <p>
    <em>Select field to sort applications </em>
    <select name="sort">
        <option value="name">name</option>
        <option value="email">email</option>
        <option value="gpa">gpa</option>
        <option value="year">year</option>
        <option value="gender">gender</option>
    </select>
    </p>
    
    <!-- Text Boxes for Name, Email, and GPA -->
    <p>
    <em>Filter Condition: </em><input type="text" name="filter" /><br />
    </p>
    
    <!-- Submit Button -->
    <input type="submit" name="displayButton" value="Display Applications"/><br /><br />
</form>

<!-- Return to Main Menu -->
<form action="main.php" method="post">
    <input type="submit" name="mainButton" value="Return to Main Menu"/><br /><br />
</form>
</body>
</html>
EOBODY;

    /* display the select options page */
    echo $body;

} else {
    header("WWW-Authenticate: Basic realm=\"Application System\"");
    header("HTTP/1.0 401 Unauthorized");
} ?>

