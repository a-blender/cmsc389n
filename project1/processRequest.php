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
}?>.,xx"

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
printSoftwares($_POST['softwaresSelected']);

// THIS IS YOUR STUDENT FUNCTION
function printSoftwares($array) {
    include 'softwares.php'; ?>
    <table border="1">
        <tr> <th>Software</th>  <th>Cost</th></tr>
        <?php
        for ($x = 0; $x < count($array); $x++) {

            $software = $array[$x];
            $cost = $softwares[$array[$x]]; ?>

            <tr> <td> <?php echo "$software"; ?> </td>
            <td> <?php echo "$$cost"; ?> </td> </tr> <?php
        }
        ?>
    </table><br />
    <?php
}

if (isset($_POST['specs'])) {
    print "<strong>Order Specifications: </strong><br />";
    echo nl2br($_POST['specs']);
}
?>
</body>
</html>