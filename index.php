<?php
require_once("config/params.php");
require(VUE . "/debut.php");

if ($_SESSION["logged"] == "true") {
    include(VUE . "/accueil.php");
} else {
    include(VUE . "/login.php");
}

require(VUE . "/fin.php");
?>
