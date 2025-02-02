<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Internaute.php");
require_once(VUE . "/debut.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) {
        sendVerificationEmail($_POST["loginInter"], $_POST["emailInter"]);
        require(VUE . "/login.php");
    } else {
        echo "<div class='error'><p>Unknown error: Account creation failed.</p></div>";
    }
} else {
    require(VUE . "/createAccount.php");
}

require_once VUE . '/fin.php';

function handleForm() : bool {
    try {
        $internaute = new Internaute($_POST, CONSTRUCT_POST);
        $data_json = json_encode($internaute);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
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
            return false;
        }

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode >= 200 && $httpCode < 300) {
            require(VUE . "/login.php");
            echo "<div class='success'><p>Account created successfully! Please validate your email to activate your account.</p></div>";
            return true;
        } else {
            // Handle API errors
            $response = json_decode($response, true);
            $sqlError = $response['error'];

            include(VUE . "/createAccount.php");
            if (Internaute::isSqlDuplicate($sqlError)) {
                echo "<div class='error'><p>Error: login already exists</p></div>";
                return false;
            } else {
                echo "<div class='error'><p>Error: $sqlError</p></div>";
                return false;
            }
        }
    } catch (Exception $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }
}

function sendVerificationEmail(string $login, string $email) : bool {
    $hash = openssl_encrypt($login, OPENSSL_ALGO, OPENSSL_PASS);
    $url = ROOT_URL . "/controleur/accountValidation.php?hash=$hash";
    $data = array(
        "to" => [$email],
        "url" => $url
    );
    $data_json = json_encode($data);

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, API_URL . "Internaute");
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

?>
