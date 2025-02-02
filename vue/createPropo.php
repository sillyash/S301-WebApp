
<div class="pageTitleBar">
    Créer une Proposition
</div>
<!-- TODO : add for loop to get all themes for a given group to display in a drop down menu isntead of having text input -->
<!-- TODO : change form action -->
<form class="flex flex-col justify-space-between align-center w-200" method="post" action="<?php echo ROOT_URL.'/controleur/createGroup.php'; ?>">
    <div class="formRow">
        <label class="flex-1" for="titrePropo">Titre*</label>
        <input class="flex-2" type="text" name="titrePropo" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="themesPropo">Thème(s)*</label>
        <input class="flex-2" type="text" name="themesPropo" required>
    </div>

    <div class="formRow">
        <label class="flex-1" for="descPropo">Description*</label>
        <input class="flex-2" type="text" name="descPropo" required>
    </div>

    <button type="submit">
        Créer une Proposition ➜
    </button>
</form>
