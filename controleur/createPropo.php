<?php
require_once(__DIR__ . "/../config/params.php");

$createPropo = isset($_GET["createPropo"]) ? true : false;
require(VUE . "/debut.php");
if ($createPropo){
    include(VUE . "/createPropo.html");
}else {
    include(VUE . "/mesPropos.html");
}
require(VUE . "/fin.html");
?>