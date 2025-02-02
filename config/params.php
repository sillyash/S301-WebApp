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

define('DB_HOST', 'localhost');
define('DB_NAME', 'prj-mmorich');
define('DB_USER', 'prj-mmorich');
define('DB_PASS', 'vZnmFpECUAvJTwCf');

define("WORKDIR",   realpath(__DIR__ . "/../"));
define("CONFIG",    realpath(WORKDIR . "/config"));
define("VUE",       realpath(WORKDIR . "/vue"));
define("MODELE",    realpath(WORKDIR . "/modele"));
define("CONTROLEUR",realpath(WORKDIR . "/controleur"));
define("CSS",       realpath(WORKDIR . "/css"));
define("ASSETS",    realpath(WORKDIR . "/assets"));
define("ROOT_URL",  "https://projets.iut-orsay.fr/prj-mmorich/S301-WebApp/");

define("API_URL", "https://projets.iut-orsay.fr/prj-mmorich/S301-API/");

define("OPENSSL_ALGO", "AES-128-CTR");
define("OPENSSL_PASS", "mmorich");

?>