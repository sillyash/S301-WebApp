<?php
// development flag
if (!defined('DEV')) define('DEV', true);

// error reporting
if (DEV) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ERROR);
    ini_set('display_errors', 0);
}

define("WORKDIR",   realpath(__DIR__ . "/../"));
define("CONFIG",    realpath(WORKDIR . "/config"));
define("VUE",       realpath(WORKDIR . "/vue"));
define("MODELE",    realpath(WORKDIR . "/modele"));
define("CONTROLEUR",realpath(WORKDIR . "/controleur"));
define("CSS",       realpath(WORKDIR . "/css"));
define("ASSETS",    realpath(WORKDIR . "/assets"));

define("API_URL", "https://projets.iut-orsay.fr/prj-mmorich/S301-API/");
define("HASH_ALGO", "sha256");

?>