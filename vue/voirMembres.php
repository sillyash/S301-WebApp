
<div class="pageTitleBar">
    CE GROUPE > Membres
</div>

<!-- TODO add get members + roles from DB -->
<div>
    <ul class="w-full">
        <li class="w-full">
            <div class="flex items-center justify-between w-full">
                <div>Membre 1</div>
                <div>[ rôle ]</div>
                <a href="<?php echo ROOT_URL.'/controleur/navigation.php/?modifRole=true'?>">
                    <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Changer rôle</button>
                </a>
                <a href="index.php">
                    <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Supprimer</button>
                </a>
            </div>
        </li>
        <li class="w-full">
            <div class="flex items-center justify-between w-full">
                <div>Membre 2</div>
                <div>[ rôle ]</div>
                <a href="<?php echo ROOT_URL.'/controleur/navigation.php/?modifRole=true'?>">
                    <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Changer rôle</button>
                </a>
                <a href="index.php">
                    <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Supprimer</button>
                </a>
            </div>
        </li>
        <li class="w-full">
            <div class="flex items-center justify-between w-full">
                <div>Membre 3</div>
                <div>[ rôle ]</div>
                <a href="<?php echo ROOT_URL.'/controleur/navigation.php/?modifRole=true'?>">
                    <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Changer rôle</button>
                </a>
                <a href="index.php">
                    <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Supprimer</button>
                </a>
            </div>
        </li>
    </ul>
    <a href="<?php echo ROOT_URL.'/controleur/navigation.php/?inviterMembre=true'?>">
        <button class="w-full">Inviter un nouveau membre</button>
    </a>
</div>
