<?php
require_once("../config/params.php");
require(VUE . "/debut.php");

$idGroupe = $_GET["idGroupe"];
$membres = apiGetMembres($idGroupe);

include(VUE . "/voirMembres.php");

require(VUE . "/fin.php");

/* ------------------ Functions ------------------ */
function apiGetMembres($idGroupe) {
    try {
        $handle = curl_init();
        $url = API_URL . "view/MembresGroupe?idGroupe=$idGroupe";
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

function apiGetRole($login, $idGroupe) : array|false {
    try {
        $handle = curl_init();
        $url = API_URL . "view/GroupesUtilisateur?loginInter=$login";
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

    $roles = json_decode($response, true);
    //var_dump($roles);

    foreach ($roles as $role) {
        if ($role['idGroupe'] == $idGroupe) {
            return array(
                "idRole" => $role['idRole'],
                "nomRole" => $role['nomRole']
            );
        }
    }
    return false;
}
?>