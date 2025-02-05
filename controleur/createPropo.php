<?php
require_once(__DIR__ . "/../config/params.php");
require(VUE . "/debut.php");

if (!isset($_GET['idGroupe'])) {
    echo "<div class='error'>Erreur : idGroupe non défini</div>";
    require_once VUE . '/fin.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) header("Location: ceGroupe.php?groupe=" . $_GET['idGroupe']);
} else {
    require(VUE . "/createPropo.php");
}

require(VUE . "/fin.php");

//$budgets = apiGetBudgets($idGroupe);

require_once VUE . '/fin.php';

/* --------------- Functions --------------- */
function handleForm() : bool {
    try {
        $idGroupe = $_GET["idGroupe"];
        $descProposition = isset($_POST["descProposition"]) ? trim($_POST["descProposition"]) : null;
        $titreProposition  = isset($_POST["titreProposition"]) ? trim($_POST["titreProposition"]) : null;
        $coutProp  = isset($_POST["coutProp"]) ? trim($_POST["coutProp"]) : null;
        $dateProp  = date("Y-m-d H:i:s");

        $postData = json_encode([
            "descProposition" => $descProposition,
            "titreProposition" => $titreProposition,
            "dateProp " => $dateProp,
            "coutProp " => $coutProp
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

function apiGetBudgets($idGroupe) {
    try {
        $handle = curl_init();
        $url = API_URL . "view/BudgetsGroupe?idGroupe=" . $idGroupe;
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

function apiGetRolesGroupe(int $idGroupe) : array|false {
    $handle = curl_init();
    $url = API_URL . "table/Role";
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    try {
        $response = curl_exec($handle);

        if (!$response) {
            throw new Exception("Error executing GET request");
            return false;
        }

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode >= 200 && $httpCode < 300) {
            return json_decode($response, true);
        } else {
            throw new Exception("Error: " . $response);
            return false;
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }
}
?>