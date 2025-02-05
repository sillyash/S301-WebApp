<div class="pageTitleBar">
    Inviter Membre
</div>

<form class="flex flex-col justify-space-between align-center w-200"
method="post" action="<?php echo ROOT_URL."controleur/inviterMembre.php?idGroupe=$idGroupe"; ?>">

<div id="invitesContainer">
    <div class="formRow inviteRow">
        <label class="flex-1 my-2" for="emails[]">Email*</label>
        <input class="flex-2" type="email" name="emails[]" required>
        <button type="button" class="flex-1 mx-5 removeInviteBtn" onclick="removeInvite(this)">Supprimer</button>
    </div>
</div>

<button type="button" id="addInviteBtn" class="w-200! my-5!" onclick="addInvite()">Ajouter un email</button>

<div class="formRow">
    <label class="flex-1 my-2" for="role">Role*</label>
        <select class="flex-2" name="role" required>
        <?php
        foreach ($roles as $role) {
            $idRole = $role['idRole'];
            $nomRole = $role['nomRole'];
            echo "<option value='$idRole'>$nomRole</option>";
        }
        ?>
        </select>
</div>

<script>
    function addInvite() {
        const container = document.getElementById('invitesContainer');
        const newFormRow = document.createElement('div');
        newFormRow.className = 'formRow inviteRow';
        newFormRow.innerHTML = `
        <label class="flex-1 my-2" for="emails[]">Email*</label>
        <input class="flex-2" type="email" name="emails[]" required>
        <button type="button" class="flex-1 mx-5 removeInviteBtn" onclick="removeInvite(this)">Supprimer</button>
        `;
        container.appendChild(newFormRow);
    }
    
    function removeInvite(button) {
        const row = button.parentElement;
        row.remove();
    }
</script>

<button type="submit">
    ➜
</button>
</form>
