<?php
require_once(__DIR__ . "/../config/params.php");
require(VUE . "/debut.php");

if ($createPropo){
    include(VUE . "/createPropo.php");
}else {
    include(VUE . "/mesPropos.php");
}
require_once VUE . 'fin.php';
?>