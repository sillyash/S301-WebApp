<?php

$titre = $proposition['titreProposition'];
$desc = $proposition['descProposition'];
$theme = $proposition['nomTheme'];
$popularity = $proposition['popularite'];
$groupe = $proposition['nomGroupe'];
$cout = $proposition['cout'];

echo "<div class='pageTitleBar'>$titre</div>";
echo "<div class='bg-white rounded-md w-1/2 p-4'>";
echo "<p>$theme</p><hr><p>$desc</p></div>";

?>