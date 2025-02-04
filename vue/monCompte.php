
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
    echo "<div class='flex flex-row align-middle bg-blue-500 rounded-md mx-1 my-2 p-2 justify-end h-20 items-center'>";
    echo "<span class='flex-2 text-lg mx-4'>$login</span>";
    echo "<span class='flex-2 text-lg mx-4'>$mdp</span>";
    echo "<span class='flex-2 text-lg mx-4'>$email</span>";
    echo "<span class='flex-2 text-lg mx-4'>$nom</span>";
    echo "<span class='flex-2 text-lg mx-4'>$prenom</span>";
    echo "<span class='flex-2 text-lg mx-4'>$addr</span>";
    echo "</div></a>";
}
?>

    <!-- TODO: change action of each button -->
    <a>
        <button class="mb-3">Supprimer mon Compte</button>
    </a>
    <a href="<?php echo ROOT_URL.'controleur/logout.php'?>">
        <button class="mb-3">Déconnexion</button>
    </a>
</div>
