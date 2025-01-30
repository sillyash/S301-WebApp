<?php
require_once(__DIR__ . "/../config/params.php");

$createAccount = isset($_GET["create"]) ? true : false;
if ($createAccount){
    include(VUE . "/createAccount.html");
} else {
    include(VUE . "/login.html");
}
?>