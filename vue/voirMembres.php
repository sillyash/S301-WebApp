<div class="pageTitleBar">
    CE GROUPE > Membres
</div>

<div>
    <ul class="w-full">
        <?php 
        foreach ($membres as $membre): 
            $login = $membre['loginInter'];
            $role = $membre['role'];
            $idMembre = $membre['id'];
            echo "<li class='flex items-center justify-between w-full p-2 m-2'>";
            echo "$login : $role";
            echo "href='".ROOT_URL."controleur/modifierRole.php?idMembre=$idMembre'>";
            echo "href='".ROOT_URL."controleur/deleteThisUser.php?idMembre=$idMembre'>";
            echo "</li>";
        endforeach;
        ?>
    </ul>
    echo "href='".ROOT_URL."controleur/deleteThisUser.php?idMembre=$idMembre'>";
    <a href="<?php echo ROOT_URL . 'controleur/inviterMembre.php'; ?>">
        <button class="w-full">Inviter un nouveau membre</button>
    </a>
</div>