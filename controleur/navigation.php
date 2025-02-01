<?php
require_once(__DIR__ . "/../config/params.php");

$homePage = isset($_GET["home"]) ? true : false;
$propos = isset($_GET["propos"]) ? true : false;
$account = isset($_GET["account"]) ? true : false;

if ($propos){
    include(VUE . "/mesPropos.html");
} else if ($account){
    include(VUE . "/monCompte.html");
} else if ($homePage){
    include(VUE . "/accueil.html");
} else {
    include(VUE . "/login.html");
}
?>