<?php
require_once(__DIR__ . "/../config/params.php");

$createPropo = isset($_GET["createPropo"]) ? true : false;

if ($createGroup){
    include(VUE . "/createPropo.html");
}else {
    include(VUE . "/mesPropos.html");
}
?>