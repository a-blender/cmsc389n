<!--
* Grades Submission System - sectionForm class
* @author Anna Blendermann
-->
<?php
require_once("generate.php");

class sectionForm
{
    public function __construct()
    {
        $this->printBody();
    }

    public function printBody()
    {
        $body = <<<EOBODY
		<form action="gradesForm.php" method="post">
		
		    <!-- Section Information -->
		    <h1>Section Information</h1><br />
		    
		    <!-- Course and Section Number -->
			<strong>Course Name (ex. cmsc430): </strong><input type="text" name="course" /><br /><br />
            <strong>Section (ex. 0102): </strong><input type="text" name="section" /><br /><br />
			
			<!-- Submit Button -->
			<input type="submit" name="submitButton" /><br><br />
		</form>		
EOBODY;

        $page = generatePage($body);
        echo $page;
    }
}
// Generate the login page
$form = new sectionForm();
?>
