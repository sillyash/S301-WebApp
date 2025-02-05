<?php
require_once("../config/params.php");
require(VUE . "/debut.php");

if (!isset($_GET['idGroupe'])) {
    echo "<div class='error'>Erreur: idGroupe non spécifié</div>";
    require(VUE . "/fin.php");
    exit();
}

$idGroupe = $_GET['idGroupe'];
$roles = apiGetRolesGroupe($idGroupe);

include(VUE . "/inviterMembre.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $success = handleForm($idGroupe);
    if ($success) {
        echo "<div class='success'><p>Invitation envoyée avec succès</p></div>";
    } else {
        echo "<div class='error'>Erreur lors de l'envoi de l'invitation</div>";
    }
}

require(VUE . "/fin.php");

/* ---------------------- Functions ---------------------- */

function handleForm($idGroupe) : bool {
    $emails = $_POST['emails'];
    $role = $_POST['role'];

    $str = $idGroupe . ";" .  $role;
    $hash = openssl_encrypt($str, OPENSSL_ALGO, OPENSSL_PASS);
    $url = ROOT_URL . "controleur/createAccountInvite.php?hash=$hash";
    
    $data = array(
        "to" => $emails,
        "url" => $url
    );
    $data_json = json_encode($data);

    $handle = curl_init();
    $url = API_URL . "mail/invites";
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    try {
        $response = curl_exec($handle);

        if (!$response) {
            throw new Exception("Error executing POST request");
            return false;
        }

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode >= 200 && $httpCode < 300) {
            return true;
        } else {
            throw new Exception("Error: " . $response);
            return false;
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }
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