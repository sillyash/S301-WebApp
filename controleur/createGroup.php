<?php
require_once(__DIR__ . "/../config/params.php");

$createGroup = isset($_GET["createGroup"]) ? true : false;
// TODO : give internaute admin role upon group creation

require(VUE . "/debut.php");
if ($createGroup){
    include(VUE . "/createGroup.html");
}else {
    include(VUE . "/accueil.html");
}
require(VUE . "/fin.html");
?>