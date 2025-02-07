<?php
require_once("../config/params.php");
include(VUE . "/debut.php");

if (isset($_SESSION["logged"])) {
    if ($_SESSION["logged"] != true) {
        header("Location: " . ROOT_URL);
    }
} else {
    header("Location: " . ROOT_URL);
}

try {
    $login = $_SESSION["login"];
    $handle = curl_init();
    $url = API_URL . "Internaute?loginInter=$login";
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);

    if (!$response) throw new Exception("Response is empty/false. URL = $url");
    else {
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode > 299 || $httpCode < 200) {
            $response = json_decode($response, true);
            $sqlError = isset($response["error"]) ? $response["error"] : $response;
            echo "<div class='error'><p>Error: $sqlError</p></div>";
            include(VUE . "/fin.php");
            exit();
        }
    }
    echo "<div class='success'><p>". json_decode($response, true) ."</p></div>";
} catch (Throwable $e) {
    echo "<div class='error'>";
    echo "<p>Error executing GET request : " . $e->getMessage() . "<p></div>";
    include(VUE . "/fin.php");
    exit();
}

$_SESSION = [];
session_destroy();
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

header("Location: login.php");

?>