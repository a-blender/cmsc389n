<!--
* Grades Submission System - gradesForm class
* @author Anna Blendermann
-->
<?php
session_start();
require_once("generate.php");

class gradesForm
{
    public function __construct()
    {
        if (!isset($_SESSION['course'])) {
            $this->setCourse($_POST['course']);
        }
        if (!isset($_SESSION['section'])) {
            $this->setSection($_POST['section']);
        }
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
        <form action="submitForm.php" method="post">

            <!-- Grades Submission Form -->
            <h2>Grades Submission Form</h2>

            <!-- Course and Section Number -->
            <h2> <?php echo $this->toString(); ?> </h2>

            <!-- Table of Students and Radio Buttons -->
            <?php $array = $this->readFile();
            $_SESSION['students'] = $array; ?>

            <table border="1">
                <?php
                for ($x = 0; $x < count($array) - 1; $x += 2) {
                    $student = $array[$x]; ?>

                    <tr>
                        <td> <?php echo "$student"; ?> </td>
                        <td>
                            <?php
                            if (isset($_SESSION[$student]) && $_SESSION[$student] == 'A') { ?>
                                <input type="radio" name=<? echo "$student" ?> value="A" checked="checked"/><?php
                            } else { ?>
                                <input type="radio" name=<? echo "$student" ?> value="A"/><?php
                            } ?>
                            <label for="A">A</label>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION[$student]) && $_SESSION[$student] == 'B') { ?>
                                <input type="radio" name=<? echo "$student" ?> value="B" checked="checked"/><?php
                            } else { ?>
                                <input type="radio" name=<? echo "$student" ?> value="B"/><?php
                            } ?>
                            <label for="B">B</label>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION[$student]) && $_SESSION[$student] == 'C') { ?>
                                <input type="radio" name=<? echo "$student" ?> value="C" checked="checked"/><?php
                            } else { ?>
                                <input type="radio" name=<? echo "$student" ?> value="C"/><?php
                            } ?>
                            <label for="C">C</label>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION[$student]) && $_SESSION[$student] == 'D') { ?>
                                <input type="radio" name=<? echo "$student" ?> value="D" checked="checked"/><?php
                            } else { ?>
                                <input type="radio" name=<? echo "$student" ?> value="D"/><?php
                            } ?>
                            <label for="D">D</label>
                        </td>
                        <td>
                            <?php
                            if (isset($_SESSION[$student]) && $_SESSION[$student] == 'F') { ?>
                                <input type="radio" name=<? echo "$student" ?> value="F" checked="checked"/><?php
                            } else { ?>
                                <input type="radio" name=<? echo "$student" ?> value="F"/><?php
                            } ?>
                            <label for="F">F</label>
                        </td>
                    </tr> <?php
                } ?>
            </table>
            <br/>

            <!-- Submit Button -->
            <input type="submit" name="submitButton" value="Continue"/><br><br/>
        </form>
        </body>
        </html>

        <!-- Back to PHP -->
        <?php
    }


    public function readFile()
    {
        $studentData = array();
        $filename = "{$_SESSION['course']}{$_SESSION['section']}.txt";

        $fp = fopen($filename, "r");
        while (!feof($fp)) {
            $student = trim(fgets($fp));
            $studentData[] = $student;
        }
        fclose($fp);

        return $studentData;
    }

    public function setCourse($course)
    {
        $_SESSION["course"] = $course;
    }

    public function setSection($section)
    {
        $_SESSION["section"] = $section;
    }

    public function getCourse()
    {
        return $_SESSION['course'];
    }

    public function getSection()
    {
        return $_SESSION['section'];
    }

    public function toString()
    {
        return "Course: " . $_SESSION['course'] . ", Section: " . $_SESSION['section'];
    }
}
// Generate the grades form
$form = new gradesForm();
?>
