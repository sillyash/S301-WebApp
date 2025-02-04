<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Groupe.php");
require(VUE . "/debut.php");

$createGroup = isset($_GET["createGroup"]) ? true : false;

if (!$createGroup) {
    header("Location: " . ROOT_URL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) {
        header("Location: " . ROOT_URL);
    }
} else {
    require(VUE . "/createGroup.php");
}

require(VUE . '/fin.php');

/* --------------- Functions --------------- */

function handleForm() : bool {
    try {
        Groupe::init();
        $groupe = new Groupe($_POST, CONSTRUCT_POST);
        $data_json = json_encode($groupe);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
    try {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, API_URL . "Groupe");
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
            $sqlError = $response['error'];

            require(VUE . "/createGroup.php");
            echo "<div class='error'><p>Error: $sqlError</p></div>";
            return false;
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }
}

?>
