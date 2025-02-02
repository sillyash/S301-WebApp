<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Internaute.php");
require(VUE . "/debut.php");
require(VUE . "/login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $internaute = new Internaute($_POST, CONSTRUCT_GET);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
     
    try {
        $handle = curl_init();
        $url = API_URL . "Internaute?login=" . $internaute->get("loginInter");
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) {
            throw new Exception("Error executing GET request");
            exit();
        }

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode > 299 || $httpCode < 200) {
            //echo "<pre>" . htmlspecialchars($response) . "</pre>";
            //throw new Exception("Error creating account: API returned HTTP code $httpCode.");
            //exit();

            $response = json_decode($response, true);
            $sqlError = $response['error'];

            echo "<div class='error'><p>Error: $sqlError</p></div>";
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
    }
}
require(VUE . "/fin.php");
?>
