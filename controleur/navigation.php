<?php
require_once(__DIR__ . "/../config/params.php");

$propos = isset($_GET["propos"]) ? true : false;
$account = isset($_GET["account"]) ? true : false;

if ($propos){
    include(VUE . "/mesPropos.html");
} else if ($account){
    include(VUE . "/monCompte.html");
} else {
    include(VUE . "/accueil.html");
}
?>