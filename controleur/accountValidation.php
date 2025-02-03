<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Internaute.php");
require(VUE . "/debut.php");

$login = handleHash();
$success = updateAccountStatus($login);

if ($success) {
    $url = ROOT_URL;
    echo "<div class='success'><p>Account validated successfully, $login! ";
    echo "You are being redirected to the login page...</p>";
    echo "<p>Click <a href='$url'>here</a> to go to the login page if the redirect fails.</p></div>";
    sleep(2);
    header("Location: " . ROOT_URL);
} else {
    echo "<div class='error'><p>Error: Account validation failed.</p></div>";
}

require(VUE . "/fin.php");


/* -------------------- Functions -------------------- */

function handleHash() : string {
    if (isset($_GET["hash"])) {
        $hash = $_GET["hash"];
        $login = openssl_decrypt($hash, OPENSSL_ALGO, OPENSSL_PASS);
        return $login;
    } else {
        echo "<div class='error'><p>Error: The URL isn't correct. You are missing a hash.</p></div>";
    }
}

function updateAccountStatus(string $login) : bool {
    $internaute = new Internaute(["loginInter" => $login], CONSTRUCT_GET);
    $internaute->set("compteValide", true);
    $data_json = json_encode($internaute);

    try {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, API_URL . "Internaute");
        curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);

        if (!$response) {
            throw new Exception("Error executing PUT request");
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

?>
