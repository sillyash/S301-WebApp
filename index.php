<?php
require_once("config/params.php");
session_start();
$_SESSION["logged"] = "true";

include(VUE . "/debut.php");

if ($_SESSION["logged"] == "true") {
    if (isset($_GET["propos"]) || isset($_GET["account"])) {
        include(CONTROLEUR . "/navigation.php");
    }
} else {
    include(CONTROLEUR . "/login.php");
}

include(VUE . "/fin.html");
?>
