<?php
require_once(__DIR__ . "/../config/params.php");

$propos = isset($_GET["propos"]) ? true : false;
$invite = isset($_GET["inviterMembre"]) ? true : false;
$modifRole = isset($_GET["modifRole"]) ? true : false;
$account = isset($_GET["account"]) ? true : false; // TODO get the following from DB instead of true/false (use ids)
$ceGroupe = isset($_GET["ceGroupe"]) ? true : false;
$membres = isset($_GET["membres"]) ? true : false;

require(VUE . "/debut.php");
if ($propos){
    include(VUE . "/mesPropos.html");
} else if ($account){
    include(VUE . "/monCompte.html");
} else if ($ceGroupe){
    include(VUE . "/ceGroupe.html");
} else if ($membres){
    include(VUE . "/voirMembres.html");
} else if ($invite){
    include(VUE . "/inviterMembre.html");
} else if ($modifRole){
    include(VUE . "/modifierRole.html");
} else {
    include(VUE . "/accueil.html");
}
include(VUE . "/fin.html");
?>