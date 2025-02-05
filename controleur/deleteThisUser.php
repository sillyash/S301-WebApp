<?php
require_once("../config/params.php");
include(VUE . "/debut.php");

try {
    $login = $_GET["idMembre"];
    $role = $_GET["idRole"];
    $handle = curl_init();
    $url = API_URL . "Fait_partie_de?loginInter=$login";
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);

    if (!$response) throw new Exception("Response is empty/false. URL = $url");
    else {
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode > 299 || $httpCode < 200) {
            $response = json_decode($response, true);
            $sqlError = isset($response["error"]) ? $response["error"] : $response;
            echo "<div class='error'><p>Error: $sqlError</p></div>";
            include(VUE . "/fin.php");
            exit();
        }
    }
    echo "<div class='success'><p>". json_decode($response, true) ."</p></div>";
} catch (Throwable $e) {
    echo "<div class='error'>";
    echo "<p>Error executing GET request : " . $e->getMessage() . "<p></div>";
    include(VUE . "/fin.php");
    exit();
}

echo "<p class='my-5'>Suppression du compte reussie.";
echo "Redirection vers la page Membres...</p>";
$idGroupe = $_GET["idGroupe"];
header("Location: voirMembres.php?idGroupe=$idGroupe");

?>