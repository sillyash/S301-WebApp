<?php
require_once(__DIR__ . "/../config/params.php");

$createGroup = isset($_GET["createGroup"]) ? true : false;
// TODO : give internaute admin role upon group creation

require(VUE . "/debut.php");
if ($createGroup){
    include(VUE . "/createGroup.php");
}else {
    include(VUE . "/accueil.php");
}
require_once VUE . 'fin.php';
?>