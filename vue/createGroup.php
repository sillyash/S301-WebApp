
<div class="pageTitleBar">
    Créer un Groupe
</div>
<form class="flex flex-col justify-space-between align-center w-200" method="post" action="<?php echo ROOT_URL.'controleur/createGroup.php'; ?>">
    <div class="formRow">
        <label class="flex-1" for="nomGroupe">Nom*</label>
        <input class="flex-2" type="text" name="nomGroupe" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="themesGroupe">Thème(s)*</label>
        <input class="flex-2" type="text" name="themesGroupe" required>
    </div>

    <div class="formRow">
        <label class="flex-1" for="couleurGroup">Couleur*</label>
        <input class="flex-2" type="text" name="couleurGroup" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="imgGroup">Image*</label>
        <input class="flex-2" type="text" name="imgGroup" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="descGroup">Description*</label>
        <input class="flex-2" type="text" name="descGroup" required>
    </div>

    <button type="submit">
        Créer un Groupe ➜
    </button>
</form>
