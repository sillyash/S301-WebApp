<form class="flex flex-col justify-space-between align-center w-200 mt-4" method="post" action="<?php echo ROOT_URL.'controleur/createAccount.php'; ?>">
    <a href= "<?php echo ROOT_URL.'controleur/login.php'; ?>">
        <button class="w-full" type="button">
            Se connecter
        </button>
    </a>

    <div class="formRow">
        <label class="flex-1" for="loginInter">Login*</label>
        <input class="flex-2" type="text" name="loginInter" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="mdpInter">Mot de passe*</label>
        <input class="flex-2" type="password" name="mdpInter" required>
    </div>

    <div class="formRow">
        <label class="flex-1" for="nomInter">Nom*</label>
        <input class="flex-2" type="text" name="nomInter" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="prenomInter">Prénom*</label>
        <input class="flex-2" type="text" name="prenomInter" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="emailInter">Adresse Mail*</label>
        <input class="flex-2" type="email" name="emailInter" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="adrInter">Adresse Postale*</label>
        <input class="flex-2" type="text" name="adrInter" required>
    </div>

    <button type="submit">
        ➜
    </button>
</form>
