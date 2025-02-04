<?php
require_once(__DIR__ . "/../config/params.php");
require_once(MODELE . "/Internaute.php");
require(VUE . "/debut.php");

if (isset($_SESSION["logged"])){
    if ($_SESSION["logged"] == true){
        header("Location: " . ROOT_URL);
    }
} else {
    include(VUE . "/login.php");
}
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = handleForm();
    if ($success) {
        header("Location: " . ROOT_URL);
    }
}

require(VUE . "/fin.php");



function handleForm() : bool {
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
        return false;
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
            return false;
        }

        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode > 299 || $httpCode < 200) {
            $response = json_decode($response, true);
            $sqlError = $response['error'];
            echo "<div class='error'><p>Error: $sqlError</p></div>";
            return false;
        }
    } catch (Throwable $e) {
        echo "<div class='error'><p>Error: " . $e->getMessage(). "</p></div>";
        return false;
    }

    $response = json_decode($response, true);
    if (!$response) {
        echo "<div class='error'><p>Erreur de connexion : l'utilisateur \"$login\" n'existe pas.</p></div>";
        return false;
    } else {
        $compteValide = $response[0]['compteValide'];
        
        if (!$compteValide) {
            echo "<div class='error'><p>Erreur de connexion : le compte n'est pas validé. ";
            echo "Veuillez verifier votre boite mail.</p></div>";
            return false;
        }
        
        $passwordBDD = $response[0]['mdpInter'];
        $passwordForm = $_POST['mdpInter'];
        
        if ($passwordBDD != $passwordForm) {
            echo "<div class='error'><p>Erreur de connexion : mot de passe incorrect.</p></div>";
            return false;
        }

        $_SESSION["logged"] = true;
        $_SESSION["login"] = $login;
        $_SESSION["password"] = $passwordBDD;
        return true;
    }
}
?>
