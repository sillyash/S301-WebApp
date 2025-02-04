<?php
require_once("../config/params.php");
require(VUE . "/debut.php");

if (!isset($_GET['idProposition'])) {
    echo "<div class='error'><p>Groupe non spécifié</p>";
    echo "<p>Veuillez revenir a la page d'accueil.</p></div>";
    require(VUE . "/fin.php");
    exit();
}

$idProposition = $_GET['idProposition'];
$proposition = apiGetProposition($idProposition)[0];
include(VUE . "/cettePropo.php");

require(VUE . "/fin.php");

/* ------------------ Functions ------------------ */

function apiGetProposition($idProposition) {
    try {
        $handle = curl_init();
        $url = API_URL . "view/PropositionsDetaillees?idProposition=$idProposition";
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) throw new Exception("Response is empty/false. URL = $url");
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

    return json_decode($response);
}

?>