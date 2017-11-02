<!--
* Grades Submission System - submitForm class
* @author Anna Blendermann
-->
<?php
session_start();
require_once("generate.php");

class submitForm
{
    public function __construct()
    {
        $this->printBody();
    }

    public function printBody()
    {
        ?>
        <!-- Switch to HTML to print the page -->
        <!doctype html>
        <html>
        <head>
            <meta charset="utf-8"/>
            <title>GradesPage</title>
        </head>

        <body>
        <form action="confirmForm.php" method="post">

            <!-- Grades To Submit  -->
            <h2>Grades to Submit</h2>

            <!-- Table of Students and Grades -->
            <?php $array = $_SESSION['students']; ?>

            <table border="1">
                <?php
                for ($x = 0; $x < count($array) - 1; $x += 2) {
                    $student = $array[$x]; ?>
                    <tr>
                        <td> <?php echo "$student"; ?> </td>
                        <td> <?php echo "{$_POST[$student]}"; ?> </td>

                        <!-- Put Grades in SESSION variable -->
                        <?php $_SESSION[$student] = $_POST[$student]; ?>
                    </tr> <?php
                }
                ?>
            </table>
            <br/>

            <!-- Submit Button -->
            <input type="submit" name="submitButton" value="Continue"/><br><br/>
        </form>
        <!-- Back Button -->
        <form action="gradesForm.php" method="post">
            <input type="submit" name="backButton" value="Back"/><br><br/>
        </form>
        </body>
        </html>

        <!-- Back to PHP -->
        <?php
    }
}
// Generate the grades form
$form = new submitForm();
?>
