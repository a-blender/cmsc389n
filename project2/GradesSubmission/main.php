<!--
* Grades Submission System - loginPage class
* @author Anna Blendermann
-->
<?php
require_once("generate.php");
session_start();

class loginPage
{
    public function __construct()
    {
        $this->printBody();
    }

    public function printBody()
    {
        $topPart = <<<EOBODY
		<form action="{$_SERVER['PHP_SELF']}" method="post">
		    <h1>Grades Submission System</h1><br />
			<strong>Login ID: </strong><input type="text" name="login" /><br><br>
			<strong>Password: </strong><input type="password" name="password"/><br><br />
			
			<!--We need the submit button-->
			<input type="submit" name="submitButton" /><br><br />
		</form>		
EOBODY;

        $bottomPart = "";
        if (isset($_POST["submitButton"]))
        {
            $login = trim($_POST["login"]);
            $password = trim($_POST["password"]);

            if ($login !== "cmsc389s" || ($password !== "terps")) {
                $bottomPart .= "<strong>Invalid Information Provided</strong><br />";
            }
            $password = "";

            if ($bottomPart === "") {
                $_SESSION["access"] = "granted";
                header("Location: sectionForm.php");
            }
        }
        else
        {
            $login = "";
            $password = "";
        }
        $body = $topPart . $bottomPart;
        $page = generatePage($body);
        echo $page;
    }
}
// Generate the login page

if (isset($_SESSION['access'])) {
    header("Location: sectionForm.php");
}
else {
    $page = new loginPage();
}
?>