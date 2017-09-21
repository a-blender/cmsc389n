<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="processRequest.css" />
</head>
<body>
<h1>Order Confirmation</h1>
<?php

if (isset($_POST['lastname'])) {
    print "<strong>Last Name: </strong>{$_POST["lastname"]}, ";
}

if (isset($_POST['firstname'])) {
    print "<strong>First Name: </strong>{$_POST["firstname"]}<br /><br />";
}

if (isset($_POST['email'])) {
    print "<strong>Email: </strong>{$_POST["email"]}<br /><br />";
}

if (isset($_POST['shipping'])) {
    print "<strong>Shipping Method: </strong>{$_POST["shipping"]}<br /><br />";
}

print "<strong>Software Order: </strong><br /><br />";
?>
<table border="1">
    <tr> <th>Software</th>  <th>Cost</th></tr>
    <tr> <td>Student1</td> <td>10</td> </tr>
    <tr> <td>Student2</td> <td>20</td> </tr>
</table><br />
<?php

if (isset($_POST['softwares[]'])) {
    print "<strong>Software Order: </strong><br />";
}

// THIS IS YOUR STUDENT FUNCTION
function printSoftwares($input) {
    print_r($input);
}

if (isset($_POST['specs'])) {
    print "<strong>Order Specifications: </strong><br />{$_POST["specs"]}";
}

?>
</body>
</html>