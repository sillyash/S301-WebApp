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

$groupes = getGroupesUtilisateur();
include(VUE . "/mesGroupes.php");
include(VUE . "/fin.php");

function getGroupesUtilisateur() : array {
    try {
        $handle = curl_init();
        $url = API_URL . "view/GroupesUtilisateur?loginInter=" . $_SESSION["login"];
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) throw new Exception("Response is empty/false");
        else {
            $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            if ($httpCode > 299 || $httpCode < 200) {
                $response = json_decode($response, true);
                $sqlError = isset($response["error"]) ? $response["error"] : $response;
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
