<?php
require("main.php");

if (isset($_SESSION["access"])) {
    header($_SESSION["nextpage"]);
}
?>