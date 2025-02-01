<?php
require_once("config/params.php");

include(VUE . "/debut.php");

if ($_SESSION["logged"] == "true") {
    if (isset($_GET["propos"]) || isset($_GET["account"]) || isset($_GET["home"])) {
        include(CONTROLEUR . "/navigation.php");
    }
} else {
    include(VUE . "/?home=true");
}

include(VUE . "/fin.html");
?>
