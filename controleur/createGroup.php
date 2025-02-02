<?php
require_once(__DIR__ . "/../config/params.php");

$createGroup = isset($_GET["createGroup"]) ? true : false;
require(VUE . "/debut.php");
if ($createGroup){
    include(VUE . "/createGroup.html");
}else {
    include(VUE . "/accueil.html");
}
require(VUE . "/fin.html");
?>