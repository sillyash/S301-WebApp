<?php
require_once(__DIR__ . "/../config/params.php");

$createAccount = isset($_GET["create"]) ? true : false;
$homePage = isset($_GET["home"]) ? true : false;

if ($createAccount){
    include(VUE . "/createAccount.html");
} else if ($homePage){
    $_SESSION["logged"] = "true";
    include(CONTROLEUR . "/navigation.php");
    include(VUE . "/accueil.html");
} else {
    include(VUE . "/login.html");
}
?>