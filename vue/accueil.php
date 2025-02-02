
<div class="pageTitleBar">
    Mes Groupes
</div>
<div>
    <!-- TODO add for loop to get all groups an internaute is a part of -->
    <!-- TODO add admin icon if internaute has admin role for specific group -->
    <ul class="w-full">
        <li class="w-full">
            <div class="flex items-center text-base justify-between">
                <img class="h-4 w-auto" 
                     src="<?php echo ROOT_URL.'/assets/admin-sm.png'; ?>" alt="admin-logo"/>
                <span class="ml-2">MON GROUPE</span>
                <a class="pl-6" href="<?php echo ROOT_URL.'/controleur/ceGroupe.php'?>">➜</a>
            </div>            
        </li>
        <li class="w-full">
            <div class="flex items-center justify-between">
                <span>GROUPE 1</span>
                <a class="pl-6" href="<?php echo ROOT_URL.'/controleur/ceGroupe.php'?>">➜</a>
            </div>
        </li>
        <li class="w-full">
            <div class="flex items-center justify-between">
                <span>GROUPE 2</span>
                <a class="pl-6" href="<?php echo ROOT_URL.'/controleur/ceGroupe.php'?>">➜</a>
            </div>
        </li>
    </ul>
    

    <a href= "<?php echo ROOT_URL.'/controleur/createGroup.php?createGroup=true' ?>">
        <button class="w-full" type="button">
            Créer un Groupe
        </button>
    </a>
</div>
