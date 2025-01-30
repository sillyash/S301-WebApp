<?php
require_once(__DIR__ . "/../config/params.php");

$createAccount = isset($_GET["home"]) ? true : false;
if ($createAccount){
    include(VUE . "/accueil.html");
} else {
    include(VUE . "/login.html");
}
?>