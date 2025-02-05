<?php
require_once(__DIR__ . "/../config/params.php");
require(VUE . "/debut.php");

if (!isset($_GET['idGroupe'])) {
    echo "<div class='error'>Erreur : idGroupe non défini</div>";
    require_once VUE . '/fin.php';
    exit();
}

$themes = apiGetThemesGroupe($_GET['idGroupe']);
$budgets = apiGetBudgets($_GET['idGroupe']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) header("Location: ceGroupe.php?groupe=" . $_GET['idGroupe']);
} else {
    require(VUE . "/createPropo.php");
}

require(VUE . "/fin.php");

/* --------------- Functions --------------- */
function handleForm() : bool {
    try {
        $idGroupe = $_GET["idGroupe"];
        $_POST["idGroupe"] = $idGroupe;
        $_POST["loginInter"] = $_SESSION["login"];
        $postData = json_encode(array("in" => $_POST));

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, API_URL . "proc/CreerProposition");
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
            $dataError = isset($response["data"]) ? $response["data"] : "";

            echo "<div class='error'><p>Error: " . var_export($sqlError) . "</p>";
            echo "<p>Data : " . var_export($dataError, true) . "</p></div>";
            require(VUE . "/createPropo.php");
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
        $budgets = json_decode($response, true);
        return $budgets;
    } catch (Throwable $e) {
        echo "<div class='error'>";
        echo "<p>Error executing GET request : " . $e->getMessage() . "<p></div>";
    }
}

function apiGetThemesGroupe($idGroupe) {
    try {
        $handle = curl_init();
        $url = API_URL . "view/ThemesGroupe?idGroupe=" . $idGroupe;
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
        $themes = json_decode($response, true);
        return $themes;
    } catch (Throwable $e) {
        echo "<div class='error'>";
        echo "<p>Error executing GET request : " . $e->getMessage() . "<p></div>";
    }
}


?>