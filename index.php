<?php
require_once("config/params.php");

include(VUE . "/debut.php");

if ($_SESSION["logged"] == "true") {
    if (isset($_GET["propos"]) || isset($_GET["account"]) || isset($_GET["home"])) {
        include(CONTROLEUR . "/navigation.php");
    } else {
        include(VUE . "/accueil.html");
    }
} else {
    include(CONTROLEUR . "/login.php");
}

include(VUE . "/fin.html");
?>
