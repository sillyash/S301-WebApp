<div class="pageTitleBar">
    Créer une proposition
</div>
<?php
$idGroupe = $_GET["idGroupe"];
?>
<form class="flex flex-col justify-space-between align-center w-200" method="post" 
      action="<?php echo ROOT_URL . 'controleur/createPropo.php?idGroupe=' . $idGroupe; ?>">
<div class="formRow">
    <label class="flex-1" for="titre">Titre*</label>
    <input class="flex-2" type="text" name="titre" required>
</div>

<div class="formRow">
    <label class="flex-1" for="description">Description*</label>
    <input class="flex-2" type="text" name="description" required>
</div>

<div class="formRow">
    <label class="flex-1" for="coutProposition">Cout*</label>
    <input class="flex-2" type="number" name="coutProposition" required>
</div>

<div class="formRow">
    <label class="flex-1 my-2" for="idTheme">Theme*</label>
        <select class="flex-2" name="idTheme" required>
        <?php
        foreach ($themes as $theme) {
            $idTheme = $theme['idTheme'];
            $nomTheme = $theme['nomTheme'];
            echo "<option value='$idTheme'>$nomTheme</option>";
        }
        ?>
        </select>
</div>

<div class="formRow">
    <label class="flex-1 my-2" for="idBudget">Budget*</label>
        <select class="flex-2" name="idBudget" required>
        <?php
        foreach ($budgets as $budget) {
            $idBudget = $budget['idBudget'];
            $nomBudget = $budget['titreBudget'];
            $limite = $budget['limiteBudgetGlobal'];
            echo "<option value='$idBudget'>$nomBudget : limite $limite</option>";
        }
        ?>
        </select>
</div>

<button type="submit">
    ➜
</button>

</form>
