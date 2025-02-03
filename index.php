<?php
require_once("config/params.php");
include(VUE . "/debut.php");

if (isset($_SESSION["logged"])) {
    if ($_SESSION["logged"] == true) {
        header("Location: " . ROOT_URL . "controleur/mesGroupes.php");
    } else {
        include(VUE . "/login.php");
    }
} else {
    include(VUE . "/login.php");
}

include(VUE . "/fin.php");
?>
