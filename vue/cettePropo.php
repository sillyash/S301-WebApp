<?php

$titre = $proposition['titreProposition'];
$desc = $proposition['descriptionProposition'];
$theme = $proposition['theme'];
$popularity = $proposition['popularite'];
$groupe = $proposition['groupe'];
$cout = $proposition['cout'];

echo "<div class='pageTitleBar'>$titre</div>";
echo "<div class='bg-white rounded-md w-1/2 p-4'>";
echo "<p>$theme</p><hr><p>$desc</p></div>";

?>