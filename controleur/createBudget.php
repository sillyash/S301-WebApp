<?php
require_once("../config/params.php");
require_once(MODELE . "/Budget.php");
require(VUE . "/debut.php");

$idGroupe = $_GET["idGroupe"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) header("Location: ceGroupe.php?idGroupe=" . $_GET['idGroupe']);
} else {
    require(VUE . "/createBudget.php");
}

require(VUE . "/fin.php");

function handleForm() : bool {
    try {
        $idGroupe = $_GET["idGroupe"];
        $titreBudget = isset($_POST["titreBudget"]) ? trim($_POST["titreBudget"]) : null;
        $limiteBudgetGlobal = isset($_POST["limiteBudgetGlobal"]) ? $_POST["limiteBudgetGlobal"] : null;

        $postData = json_encode([
            "titreBudget" => $titreBudget,
            "limiteBudgetGlobal" => $limiteBudgetGlobal,
            "idGroupe" => $idGroupe
        ]);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
    try {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, API_URL . "Budget");
        curl_setopt($handle, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $postData);
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
            if (strpos($error, "Duplicate entry") !== false) {
                echo "<div class='error'><p>Un budget avec ce titre existe déjà</p></div>";
            } else {
                echo "<div class='error'><p>Error: $sqlError</p></div>";
            }
            return false;
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }
    return true;
}

?>