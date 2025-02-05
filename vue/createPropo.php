<div class="pageTitleBar">
    Créer une proposition
</div>

<form class="flex flex-col justify-space-between align-center w-200" method="post" action="<?php echo ROOT_URL.'controleur/createGroup.php'; ?>">

<div class="formRow">
    <label class="flex-1" for="titreProposition">Titre*</label>
    <input class="flex-2" type="text" name="titreProposition" required>
</div>

<div class="formRow">
    <label class="flex-1" for="descProposition">Description*</label>
    <input class="flex-2" type="text" name="descProposition" required>
</div>

<div class="formRow">
    <label class="flex-1" for="coutProp">Cout*</label>
    <input class="flex-2" type="number" name="coutProp" required>
</div>

<div class="formRow">
    <label class="flex-1" for="idBudget">Budget*</label>
    <select class="flex-2" name="idBudget" required>

<?php

foreach ($budgets as $budget) {
    echo "<option value='" . $budget['idBudget'] . ">";
    echo $budget['nomBudget'] . "</option>";
}

?>
    </select>
</div>

<button type="submit">
    ➜
</button>

</form>
