<div class="pageTitleBar">
    Mes Groupes
</div>
<div class="flex flex-col justify-center align-middle w-full my-4 mx-2 p-1">

<?php
foreach ($groupes as $groupe) {
    $nom = $groupe["nomGroupe"];
    $id = $groupe["idGroupe"];
    $role = $groupe["nomRole"];
    $href = ROOT_URL . "controleur/ceGroupe.php?groupe=$id";
    echo "<a class='text-white hover:text-red-500' href='$href'>";
    echo "<div class='flex flex-row align-middle bg-blue-500 rounded-md mx-1 my-2 p-2 justify-end h-20 items-center'>";
    echo "<img class='w-16 h-16 object-contain rounded-full mx-4' src='https://picsum.photos/200/200' alt='logo groupe'>";
    echo "<span class='flex-2 text-lg mx-4'>$nom</span>";
    echo "<span class='flex-2 text-right text-2xl mx-4'>➜</span>";
    echo "</div></a>";
}
?>

</div>
<a href= "<?php echo ROOT_URL.'controleur/createGroup.php' ?>">
    <button class="w-100" type="button">
        Créer un Groupe
    </button>
</a>
</div>
