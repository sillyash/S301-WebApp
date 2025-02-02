<?php
require_once VUE . '/debut.php';
?>
<div class="flex justify-space-between align-center">
    <img class="flex-start size-72" src="assets/favicon.svg" alt="logo">
    
    <form action="./controleur/login.php" method="POST" class="flex flex-col mx-8 my-4 w-200 cursor-pointer">
        <a href="./vue/createAccount.php">
            <button class="w-full" type="button">
                Créer un Compte!
            </button>
        </a>

        <div class="formRow">
            <label class="flex-1" for="login">Login</label>
            <input class="flex-2" type="text" name="login" required>
        </div>

        <div class="formRow">
            <label class="flex-1" for="password">Mot de passe</label>
            <input class="flex-2" type="password" name="password" required>
        </div>

        <button type="submit">
            ➜
        </button>

        <div class="flex-1 h-full inline text-center align-middle bg-gray-500 rounded-md text-white mt-4">
            <p><strong>DemoCité : la démocratie participative pour tous.</strong></p>
            <p>À vos marques, prêts, votez ! Notre application vous permet d'établir des votes entre membres d'un même groupe. Association, petite ou grande, entreprise ou simple collectif, nous vous accueillons avec enthousiasme!</p>
            <p>Exprimez vos idées, prenez part aux décisions et facilitez la gestion démocratique de votre organisation grâce à notre plateforme intuitive et accessible à tous.</p>
        </div>
    </form>
</div>
