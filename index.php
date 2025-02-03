<?php
require_once("config/params.php");
include(VUE . "/debut.php");

if (isset($_SESSION["logged"])) {
    if ($_SESSION["logged"] != true) {
        header("Location: controleur/login.php");
    }
} else {
    header("Location: controleur/login.php");
}

header("Location: controleur/mesGroupes.php");

require(VUE . "/fin.php");
?>
