<?php

try {
    $login = $_SESSION["login"];
    $handle = curl_init();
    $url = API_URL . "Internaute?loginInter=$login";
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);

    if (!$response) throw new Exception("Response is empty/false. URL = $url");
    else {
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode > 299 || $httpCode < 200) {
            $response = json_decode($response, true);
            $sqlError = $response['error'];
            echo "<div class='error'><p>Error: $sqlError</p></div>";
        }
    }
    return json_decode($response, true);
} catch (Throwable $e) {
    echo "<div class='error'>";
    echo "<p>Error executing GET request : " . $e->getMessage() . "<p></div>";
}

$_SESSION = [];
session_destroy();
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}
exit;
?>