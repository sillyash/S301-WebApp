<?php
require_once("../config/params.php");
require(VUE . "/debut.php");
$login = $_SESSION["login"];
$propositions = apiGetPropositions($login);

include(VUE . "/mesPropos.php");

require(VUE . "/fin.php");

/* ------------------ Functions ------------------ */
function apiGetPropositions($login) {
    try {
        $handle = curl_init();
        $url = API_URL . "view/PropositionsUtilisateur?loginInter=$login";
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) throw new Exception("Response is empty/false. URL = $url");
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

    return json_decode($response);
}
?>