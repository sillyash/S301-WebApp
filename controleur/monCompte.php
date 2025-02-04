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

$userData = getUtilisateur();
include(VUE . "/monCompte.php");

require(VUE . "/fin.php");

function getUtilisateur() : array {
    try {
        $handle = curl_init();
        $url = API_URL . "view/Internaute?loginInter=" . $_SESSION["login"];
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) throw new Exception("Response is empty/false");
        else {
            $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            if ($httpCode > 299 || $httpCode < 200) {
                $response = json_decode($response, true);
                $sqlError = $response['error'];
                echo "<div class='error'><p>Error: $sqlError</p></div>";
            }
        }
        return json_decode($response, true);
    } catch (Throwable $e) {
        echo "<div class='error'>";
        echo "<p>Error executing GET request : " . $e->getMessage() . "<p></div>";
    }
}
?>