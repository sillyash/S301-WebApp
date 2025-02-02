<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Internaute.php");
require_once(VUE . "/debut.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $internaute = new Internaute($_POST, CONSTRUCT_POST);
        $data_json = json_encode($internaute);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
     
    try {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, API_URL . "Internaute");
        curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) {
            throw new Exception("Error executing POST request");
            exit();
        }

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode > 299 || $httpCode < 200) {
            //echo "<pre>" . htmlspecialchars($response) . "</pre>";
            //throw new Exception("Error creating account: API returned HTTP code $httpCode.");
            //exit();

            $response = json_decode($response, true);
            $sqlError = $response['error'];

            include(VUE . "/createAccount.php");
            if (Internaute::isSqlDuplicate($sqlError)) {
                echo "<div class='error'><p>Error: login already exists</p></div>";
            } else {
                echo "<div class='error'><p>Error: $sqlError</p></div>";
            }
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
    }
}
require_once VUE . '/fin.php';
?>
