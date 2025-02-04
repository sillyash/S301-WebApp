
<div class="pageTitleBar">
    Mon Compte
</div>
<!-- TODO: for loop to retrieve data for a user -->
<!-- TODO: opt - add edit field possibility -->
<div class="flex flex-col justify-space-between align-center w-200">

<?php
foreach ($userData as $data) {
    $login = $data["loginInter"];
    $mdp = $data["mdpInter"];
    $email = $data["emailInter"];
    $nom = $data["nomInter"];
    $prenom = $data["prenomInter"];
    $addr = $data["adrInter"];
    echo "<div class='flex flex-col text-white align-middle bg-blue-500 rounded-md mx-1 my-2 p-2 justify-end items-center'>";
    echo "<span class='flex-2 text-lg mx-4'>Login: $login</span>";
    echo "<span class='flex-2 text-lg mx-4'>Mot de Passe: $mdp</span>";
    echo "<span class='flex-2 text-lg mx-4'>Email: $email</span>";
    echo "<span class='flex-2 text-lg mx-4'>Nom: $nom</span>";
    echo "<span class='flex-2 text-lg mx-4'>Prenom: $prenom</span>";
    echo "<span class='flex-2 text-lg mx-4'>Addresse: $addr</span>";
    echo "</div></a>";
}
?>

    <a href="<?php echo ROOT_URL.'controleur/deleteAccount.php'?>">
        <button class="mb-3 w-full">Supprimer mon Compte</button>
    </a>
    <a href="<?php echo ROOT_URL.'controleur/logout.php'?>">
        <button class="mb-3 w-full">Déconnexion</button>
    </a>
</div>
