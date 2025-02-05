<div class="pageTitleBar">
    Ajouter des thèmes
</div>
<form class="flex flex-col justify-space-between align-center w-200" method="post" action="<?php echo ROOT_URL."controleur/createTheme.php?idGroupe=$idGroupe"; ?>">

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

    <button type="submit">
        ➜
    </button>
</form>
