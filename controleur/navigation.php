<?php
require_once(__DIR__ . "/../config/params.php");

$home = isset($_GET["home"]) ? true : false;
$propos = isset($_GET["propos"]) ? true : false;
$account = isset($_GET["account"]) ? true : false;

if ($propos){
    include(VUE . "/mesPropos.html");
} else if ($account){
    include(VUE . "/monCompte.html");
} else if ($home){
    include(VUE . "/accueil.html");
} else {
    include(VUE . "/login.html");
}
?>