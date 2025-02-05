<?php
require_once("../config/params.php");
require_once(MODELE . "/Budget.php");
require(VUE . "/debut.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) require(VUE . "/ceGroup.php");
} else {
    require(VUE . "/createGroup.php");
}

require(VUE . "/fin.php");

function handleForm() : bool {
    try {
        $idGroupe = isset($_GET["idGroupe"]); // idk wtf to do w this but it's gotta do smt
        Budget::init();
        $budget = new Budget($_POST, CONSTRUCT_POST);
        $data_json = json_encode($budget);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
    try {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, API_URL . "Budget");
        curl_setopt($handle, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) {
            throw new Exception("Error executing POST request");
            return false;
        }

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode >= 200 && $httpCode < 300) {
            return true;
        } else {
            // Handle API errors
            $response = json_decode($response, true);
            $sqlError = isset($response["error"]) ? $response["error"] : $response;

            require(VUE . "/createBudget.php");
            echo "<div class='error'><p>Error: $sqlError</p></div>";
            return false;
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }
    return true;
}

?>