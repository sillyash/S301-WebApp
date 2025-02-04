
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
    
    <div id="themesContainer">
        <div class="formRow themeRow">
            <label class="flex-1" for="themesGroupe[]">Theme*</label>
            <input class="flex-2" type="text" name="themesGroupe[]" required>
            <button type="button" class="removeThemeBtn flex-1 mx-5" onclick="removeTheme(this)">Supprimer</button>
        </div>
    </div>
    <button type="button" id="addThemeBtn" class="w-200! my-5!" onclick="addTheme()">Ajouter un theme</button>
    
    <script>
        function addTheme() {
            const container = document.getElementById('themesContainer');
            const newFormRow = document.createElement('div');
            newFormRow.className = 'formRow themeRow';
            newFormRow.innerHTML = `
            <label class="flex-1" for="themesGroupe[]">Theme*</label>
            <input class="flex-2" type="text" name="themesGroupe[]" required>
            <button type="button" class="removeThemeBtn flex-1 mx-5" onclick="removeTheme(this)">Supprimer</button>
            `;
            container.appendChild(newFormRow);
        }
        
        function removeTheme(button) {
            const row = button.parentElement;
            row.remove();
        }
    </script>

    <div class="formRow">
        <label class="flex-1" for="imgGroupe">Image</label>
        <input class="flex-2" type="file" name="imgGroupe" accept="image/*" onchange="validateFileSize(this)">
    </div>

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
