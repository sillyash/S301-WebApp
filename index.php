<?php
require_once("config/params.php");
session_start();
$_SESSION["logged"] = "true";

include(VUE . "/debut.php");
include(CONTROLEUR . "/login.php");
include(CONTROLEUR . "/navigation.php");
include(VUE . "/fin.html");
?>
