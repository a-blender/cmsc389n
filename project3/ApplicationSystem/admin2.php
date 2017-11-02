<!-- Admin Applications Table -->
<!-- by Anna Blendermann-->

<?php
include ("DBOperations.php");

// query the database with your admin options
$db = new DBOperations();
$result = $db->adminQuery($_POST['options'], $_POST['sort'], $_POST['filter']);
$db->disconnectFromDB();

// check return value of the query
if ($result) {

// get the number of rows in the result
    $numberOfRows = mysqli_num_rows($result);

// check that the number of rows > 0
    if ($numberOfRows == 0) {
        echo "<h2>No entries exist in the table</h2>";
    } else { ?>

        <!-- Header of the Applications Page -->
        <h1>Applications</h1>

        <!-- Applications Table  -->
        <table border='1'>
        <tr>
            <?php
            foreach ($_POST['options'] as $option) {
                echo "<td>" . $option . "</td>";
            } ?>
        </tr>

        <?php
        while ($row = mysqli_fetch_array($result)) {
            for ($x = 0; $x < count($_POST['options']); $x++) {
                echo "<td>" . $row[$x] . "</td>";
            }
            echo "</tr>";
        } ?>
        </table><br /><?php
    }
} ?>

<!-- Return to Main Menu -->
<form action="main.php" method="post">
    <input type="submit" name="mainButton" value="Return to Main Menu"/><br /><br />
</form>