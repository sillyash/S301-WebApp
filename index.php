<?php
require_once("config/params.php");
include(VUE . "/debut.php");

if (isset($_SESSION["logged"])) {
    if ($_SESSION["logged"] == true) {
        include(VUE . "/accueil.php");
    }
} else {
    header("Location: controleur/login.php");
}

require(VUE . "/fin.php");
?>
