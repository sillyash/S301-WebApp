<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Groupe.php");
require_once(MODELE . "/Fait_partie_de.php");
require(VUE . "/debut.php");

if (!isset($_GET["idGroupe"])) {
    echo "<div class='error'><p>Error: missing group ID</p></div>";
    require(VUE . '/fin.php');
    exit();
}

$idGroupe = $_GET["idGroupe"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    $success = handleForm();
    if ($success) header("Location: " . ROOT_URL);
} else {
    require(VUE . "/createTheme.php");
}

require(VUE . '/fin.php');

/* --------------- Functions --------------- */

function handleForm() : bool {
    try {
        foreach ($_POST["themesGroupe"] as $theme) {
            if (!addThemeToGroup($theme)) {
                throw new Exception("Error adding theme to group");
            }
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }
    return true;
} 

function addThemeToGroup(string $theme) : bool {
    try {
        $url = API_URL . "Theme";
        $data = array("nomTheme" => $theme);
        $data_json = json_encode($data);

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
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

            require(VUE . "/createTheme.php");
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
