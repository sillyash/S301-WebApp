<?php
require_once(__DIR__ . "/../config/params.php");
require(VUE . "/debut.php");

$createGroup = isset($_GET["createGroup"]) ? true : false;
// TODO : give internaute admin role upon group creation

if ($createGroup){
    include(VUE . "/createGroup.php");
}else {
    include(VUE . "/accueil.php");
}
require(VUE . 'fin.php');
?>