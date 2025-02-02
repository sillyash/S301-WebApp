<?php
require_once("config/params.php");

if (isset($_SESSION["logged"])) {
    if ($_SESSION["logged"] == true) {
        include(VUE . "/debut.php");
        include(VUE . "/accueil.php");
        require(VUE . "/fin.php");
    } else {
        include(CONTROLEUR . "/login.php");
    }
    include(VUE . "/debut.php");
    include(VUE . "/accueil.php");
    require(VUE . "/fin.php");
} else {
    include(CONTROLEUR . "/login.php");
}
?>
