
<div class="pageTitleBar">
    CE GROUPE > Inviter Membre
</div>

<form class="flex flex-col justify-space-between align-center w-200" method="post" action="<?php echo ROOT_URL.'controleur/createGroup.php'; ?>">
    <div class="formRow">
        <label class="flex-1" for="emailMembre">Email*</label>
        <input class="flex-2" type="email" name="emailMembre" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="roleMembre">Rôle*</label>
        <input class="flex-2" type="text" name="roleMembre" required>
    </div>

    <button type="submit">
        Envoyer invitation ➜
    </button>
</form>
