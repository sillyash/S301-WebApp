<?php
require_once(__DIR__ . "/../config/params.php");
require_once(VUE . "/debut.php");

if (!isset($_GET['hash'])) {
    echo "<div class='error'>Error: hash not specified</div>";
    require(VUE . "/fin.php");
    exit();
}

$hash = $_GET['hash'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) {
        $_SESSION["login"] = $_POST["loginInter"];
        $_SESSION["logged"] = true;
        header("Location: " . ROOT_URL);
    } else {
        require(VUE . "/createAccountInvite.php");
        echo "<div class='error'><p>Unknown error: Account creation failed.</p></div>";
    }
} else {
    require(VUE . "/createAccountInvite.php");
}

require(VUE . '/fin.php');

/* --------------- Functions --------------- */

function handleForm() : bool {
    try {
        $_POST["compteValide"] = true;
        $data_json = json_encode($_POST);
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
            $hash = $_GET["hash"];
            $str = openssl_decrypt($hash, OPENSSL_ALGO, OPENSSL_PASS);
            $arr = explode(';', $str);

            $group = $arr[0];
            $role = $arr[1];
            $login = $_POST["loginInter"];

            return addUserToGroup($login, $group, $role);
        } else {
            // Handle API errors
            $response = json_decode($response, true);
            $sqlError = isset($response["error"]) ? $response["error"] : $response;

            include(VUE . "/createAccountInvite.php");
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

function addUserToGroup(string $login, int $group, int $role) : bool {
    $data = array(
        "loginInter" => $login,
        "idGroupe" => $group,
        "idRole" => $role
    );
    $data_json = json_encode($data);

    $handle = curl_init();
    $url = API_URL . "Fait_partie_de";
    curl_setopt($handle, CURLOPT_URL, $url);
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
