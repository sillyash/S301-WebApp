<div class="pageTitleBar">
    Créer un Budget
</div>

<form class="flex flex-col justify-space-between align-center w-200" method="post" 
      action="<?php echo ROOT_URL . 'controleur/createBudget.php?idGroupe=' . $_GET['idGroupe']; ?>">
    <div class="formRow">
        <label class="flex-1" for="titreBudget">Titre*</label>
        <input class="flex-2" type="text" name="titreBudget" required>
    </div>
    
    <div class="formRow">
        <label class="flex-1" for="limiteBudgetGlobal">Budget Max*</label>
        <input class="flex-2" type="number" name="limiteBudgetGlobal" required>
    </div>
    
    <button type="submit">
        ➜
    </button>
</form>
