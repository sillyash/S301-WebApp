<div class="pageTitleBar">
    Membres
</div>

<div>
    <ul class="w-full">
        <?php
        $idGroupe = $_GET["idGroupe"];
        foreach ($membres as $membre): 
            $login = $membre['loginInter'];
            $role = apiGetRole($login, $idGroupe);
            $roleName = $role['nomRole'];
            $idRole = $role['idRole'];
            echo "<li class='flex items-center justify-between w-full p-2 m-2'>";
            echo "$login : $roleName";
            echo "<a href='" . ROOT_URL . "controleur/modifierRole.php?idMembre=$login'>
                <button class='m-4 !bg-white !text-red-500 hover:!text-orange-500'>Modifier Rôle</button>
                </a>";
            echo "<a href='" . ROOT_URL . "controleur/deleteThisUser.php?idMembre=$login?idGroupe=$idGroupe?idRole=$idRole'>
                <button class='m-4 !bg-white !text-red-500 hover:!text-orange-500'>Supprimer</button>
                </a>";
            echo "</li>";
        endforeach;
        ?>
    </ul>
    <a href="<?php echo ROOT_URL . "controleur/inviterMembre.php?idGroupe=$idGroupe"; ?>">
        <button class="w-full">Inviter un nouveau membre</button>
    </a>
</div>