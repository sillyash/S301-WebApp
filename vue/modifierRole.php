<?php
require_once VUE . '/debut.php';
?>
<div class="pageTitleBar">
    CE GROUPE > Membres > Changer rôle
</div>

<div class="flex items-center justify-between w-1/2 mt-4">
    <div>Membre 1: </div>
    <div>[ rôle ]</div>


    <form class="bg-white rounded-md p-4" action="<?php echo ROOT_URL.'/controleur/modifRole.php'?>">
        <div class="flex">
            <div class="mr-4">
                <label for="admin">
                    Administrateur
                </label>
                <input id="admin" type="checkbox">
            </div>
            <div>
                <label for="moderateur">
                    Modérateur
                </label>
                <input id="moderateur" type="checkbox">
            </div>
        </div>
        <div class="flex mt-2">
            <div class="mr-4">
                <label for="organisateur">
                    Organisateur
                </label>
                <input id="organisateur" type="checkbox">
            </div>
            <div>
                <label for="scrutateur">
                    Scrutateur
                </label>
                <input id="scrutateur" type="checkbox">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit">
                Enregistrer ➜
            </button>
        </div>
    </form>    
</div>
