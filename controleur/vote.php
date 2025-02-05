<?php
require_once("../config/params.php");
require(VUE . "/debut.php");

try {
    $login = $_SESSION['login'];
    $valeurVote = isset($_GET['valeurVote']) ? (int)$_GET['valeurVote'] : null;
    $idScrutin = isset($_GET['idScrutin']) ? (int)$_GET['idScrutin'] : null;

    if ($valeurVote !== 1 && $valeurVote !== -1) {
        throw new Exception("Invalid vote value. Only 1 or -1 allowed.");
    }

    $handle = curl_init();
    $url = API_URL . "Vote";

    $postData = json_encode([
        "loginInter" => $login,
        "idScrutin" => $idScrutin,
        "valeurVote" => $valeurVote
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
include(VUE . "/cettePropo.php");
require(VUE . "/fin.php");

?>