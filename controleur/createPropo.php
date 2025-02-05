<?php
require_once(__DIR__ . "/../config/params.php");
require(VUE . "/debut.php");

if (!isset($_GET['idGroupe'])) {
    echo "<div class='error'>Erreur : idGroupe non défini</div>";
    require_once VUE . '/fin.php';
    exit();
}

$idProposition = $_GET['idGroupe'];
$budgets = apiGetBudgets($idGroupe);

include(VUE . "/createPropo.php");

require_once VUE . '/fin.php';

/* --------------- Functions --------------- */

function apiGetBudgets($idGroupe) {
    try {
        $handle = curl_init();
        $url = API_URL . "BudgetsGroupe?idGroupe=" . $idGroupe;
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
    } catch (Throwable $e) {
        echo "<div class='error'>";
        echo "<p>Error executing GET request : " . $e->getMessage() . "<p></div>";
    }

    $budgets = json_decode($response, true);
    return $budgets;
}

?>