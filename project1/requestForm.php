<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Order Request Form</title>
    <?php include 'softwares.php'; ?>
    <link rel="stylesheet" href="requestForm.css" />
</head>
<body>
<h1>Order Request Form</h1>
<form action="processRequest.php" method="post">

    <!-- Text Boxes for First/Last Name and Email /--!>
    <p>
        <strong>Last Name: </strong><input type="text" name="lastname" />
        <strong>First Name: </strong><input type="text" name="firstname" /><br /><br />
        <strong>Email: </strong><input type="text" name="email" /><br />
    </p>

    <!-- Radio Buttons for the Shipping Method /--!>
    <p>
        <strong>Shipping Method: </strong>
        USPSS<input type="radio" name="shipping" value="USPSS" />
        FedEXC<input type="radio" name="shipping" value="FedEXC" />
        USMAIL<input type="radio" name="shipping" value="USMAIL" />
        Other<input type="radio" name="shipping" value="Other" />
    </p>

    <!-- Scrollbar for Softwares /--!>
    <p>
    <select multiple name="softwaresSelected[]">
    <?php
    foreach($softwares as $software => $cost)
        echo '<option value="'.$software.'">'.$software.' ($'.$cost.')</option>';
    ?>
    </select>
    </p>

    <!-- Text Area for Order Specifications /--!>
    <p>
        <strong>Order Specifications</strong><br />
        <textarea rows="5" cols="60" name="specs"></textarea>
    </p>

    <!-- Buttons for Form Submission /--!>
    <p>
        <input type="reset" name="reset" value="Reset Fields" />
        <input type="submit" name="submit" value="Submit Request" />
    </p>
</form>
</body>
</html>
