<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Internaute.php");
require(VUE . "/debut.php");

$login = handleHash();
$success = updateAccountStatus($login);

if ($success) {
    $url = ROOT_URL;
    echo "<div class='flex flex-col success'><p>Account validated successfully, $login!</p>";
    echo "<p>Click <a class='font-bold text-blue-500' href='$url'>";
    echo "here</a> to go to the login page.</p></div>";
} else {
    
    echo "<div class='error'><p>Error: Account validation failed.</p></div>";
}

require(VUE . "/fin.php");


/* -------------------- Functions -------------------- */

function handleHash() : string {
    if (isset($_GET["hash"])) {
        $hash = $_GET["hash"];
        $login = openssl_decrypt($hash, OPENSSL_ALGO, OPENSSL_PASS);
        if (!$login) {
            echo "<div class='error'><p>Error: Failed to decrypt the hash : '$hash'</p></div>";
        }
        return $login;
    } else {
        echo "<div class='error'><p>Error: The URL isn't correct. You are missing a hash.</p></div>";
    }
}

function updateAccountStatus(string $login) : bool {
    $data = array(
        "loginInter" => $login,
        "compteValide" => 1
    );
    $internaute = new Internaute($data, CONSTRUCT_PUT);
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
