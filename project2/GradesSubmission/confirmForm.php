<!--
* Grades Submission System - confirmForm class
* @author Anna Blendermann
-->
<?php
require_once("generate.php");

class confirmForm
{
    public function __construct()
    {
        $this->printBody();
    }

    public function printBody()
    {
        $body = "<h1>Grades Submitted and Email Confirmation Sent</h1><br />";
        $page = generatePage($body);
        echo $page;
    }
}
// Generate the login page
$form = new confirmForm();
?>
