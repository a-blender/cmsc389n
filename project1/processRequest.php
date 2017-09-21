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

        if (isset($_POST['softwares'])) {
            print "<strong>Software Order: </strong><br /><br />";

        }

        if (isset($_POST['specs'])) {
            print "<strong>Order Specifications: </strong><br />{$_POST["specs"]}";
        }

        ?>
    </body>
</html>