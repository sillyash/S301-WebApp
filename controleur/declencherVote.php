<?php
require_once("../config/params.php");
include(VUE . "/debut.php");

try {

    $idPropo = $_GET["idProposition"];
    $handle = curl_init();
    $url = API_URL . "Scrutin";
    
    $postData = json_encode([
        "dureeDiscussion" => 60,
        "dureeScrutin" => 60,
        "natureScrutin" => "Vote Pour / Contre",
        "resultatScrutin" => "En cours",
        "idProposition" => $idPropo
    ]);
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $postData);
    
    $response = curl_exec($handle);
    
    if (!$response) throw new Exception("Response is empty/false. URL = $url");
    else {
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode > 299 || $httpCode < 200) {
            $response = json_decode($response, true);
            $sqlError = isset($response["error"]) ? $response["error"] : $response;
            
            if (strpos($error, "Duplicate entry") !== false) {
                echo "<div class='error'><p>Le vote est deja en cours!</p></div>";
            } else {
                echo "<div class='error'><p>Error: $sqlError</p></div>";
            }
            include(VUE . "/fin.php");
            exit();
        }
    }
} catch (Throwable $e) {
    echo "<div class='error'>";
    echo "<p>Error executing GET request : " . $e->getMessage() . "<p>";
    echo "<p>Session : " . var_export($_SESSION, true) . "</p></div>";
    include(VUE . "/fin.php");
    exit();
}

echo "<div class='success'><p>Vote declenche.</p>";

include(VUE . "/fin.php");

?>