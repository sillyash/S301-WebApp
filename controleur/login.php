<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Internaute.php");
require(VUE . "/debut.php");

if (isset($_SESSION["logged"]) || $_SESSION["logged"] == "false"){
    include(VUE . "/login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login="";
    try {
        $internaute = new Internaute($_POST, CONSTRUCT_GET);
        $login = $internaute->get("loginInter");
    } catch (Throwable $e) {
        echo "<div class='error'>";
        echo "<p>Error: " . $e->getMessage() . "<p>";
        echo "<pre> INTERNAUTE: " . var_dump($internaute) . "</pre>";
        echo "<pre> POST: " . var_dump($_POST) . "</pre>";
        echo "</div>";
        exit();
    }
    
    $response="";
    try {
        $handle = curl_init();
        $url = API_URL . "Internaute?loginInter=$login";
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
    } catch (Throwable $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
    }

    $response = json_decode($response, true);
    if (!$response) {
        echo "<div class='error'><p>Erreur de connexion : l'utilisateur \"$login\" n'existe pas.</p></div>";
    } else {
        $passwordBDD = $response[0]['mdpInter'];
        $passwordForm = $_POST['mdpInter'];
        if ($passwordBDD == $passwordForm) {
            $_SESSION["logged"] = true;
            $_SESSION["login"] = $login;
            header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            echo "<div class='error'><p>Erreur de connexion</p></div>";
        }
    }
}
require(VUE . "/fin.php");
?>
