<?php
require_once(__DIR__ . "/../config/params.php");

$createGroup = isset($_GET["createGroup"]) ? true : false;

if ($createGroup){
    include(VUE . "/createGroup.html");
}else {
    include(VUE . "/accueil.html");
}
?>