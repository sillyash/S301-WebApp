
<div class="pageTitleBar">
    Créer un Groupe
</div>
<form class="flex flex-col justify-space-between align-center w-200" method="post" action="<?php echo ROOT_URL.'controleur/createGroup.php'; ?>">
    <div class="formRow">
        <label class="flex-1" for="nomGroupe">Nom*</label>
        <input class="flex-2" type="text" name="nomGroupe" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="couleurGroupe">Couleur*</label>
        <input class="flex-2" type="color" name="couleurGroupe" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="descGroupe">Description*</label>
        <input class="flex-2" type="text" name="descGroupe" required>
    </div>

    <!--div class="formRow">
        <label class="flex-1" for="ppGroupe">Image</label>
        <input class="flex-2" type="file" name="ppGroupe" accept="image/*" onchange="validateFileSize(this)">
    </div-->

    <script>
        function validateFileSize(input) {
            const file = input.files[0];
            if (file && file.size > 65536) { // 64 KB = 65536 bytes
                alert('The file size must be less than 64 KB.');
                input.value = ''; // Clear the input
            }
        }
    </script>

    <button type="submit">
        ➜
    </button>
</form>
