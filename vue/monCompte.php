<?php
require_once '../config/params.php';
require_once VUE . '/debut.php';
?>
<div class="pageTitleBar">
    Mon Compte
</div>

<!-- TODO: for loop to retrieve data for a user -->
<!-- TODO: opt - add edit field possibility -->
<div class="flex flex-col justify-space-between align-center w-200">
    <div>
        <p class="flex-1">Login:</p>
        <p> [login] </p>
    </div>
    
    <div>
        <p class="flex-1">Mot de passe:</p>
        <p> [mdp] </p>
    </div>

    <div>
        <p class="flex-1">Adresse Mail:</p>
        <p> [email] </p>
    </div>

    <div>
        <p class="flex-1">Nom:</p>
        <p> [nom] </p>
    </div>
    
    <div>
        <p class="flex-1">Prénom:</p>
        <p> [prenom] </p>
    </div>

    <div>
        <p class="flex-1">Adresse Postale:</p>
        <p> [adr] </p>
    </div>

    <!-- TODO: change action of each button -->
    <a>
        <button class="mb-3">Supprimer mon Compte</button>
    </a>
    href="<?php echo ROOT_URL.'/assets/favicon.svg'; ?>
    <a href="<?php echo ROOT_URL.'/controleur/logout.php'?>">
        <button class="mb-3">Déconnexion</button>
    </a>
</div>
