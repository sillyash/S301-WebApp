<?php

$titre = $proposition['titreProposition'];
$desc = $proposition['descProposition'];
$theme = $proposition['nomTheme'];
$popularity = $proposition['popularite'];
$groupe = $proposition['nomGroupe'];
$cout = $proposition['cout'];

echo "
<div class='container mx-auto p-4'>
    <div class='pageTitleBar'>$titre</div>
    <div class='bg-white shadow-md rounded-lg p-6'>
        <p class='text-gray-700 mb-2'><strong>Description:</strong> $desc</p>
        <p class='text-gray-700 mb-2'><strong>Theme:</strong> $theme</p>
        <p class='text-gray-700 mb-2'><strong>Popularity:</strong> $popularity</p>
        <p class='text-gray-700 mb-2'><strong>Group:</strong> $groupe</p>
        <p class='text-gray-700 mb-2'><strong>Cost:</strong> $cout</p>
    </div>
</div>
";

?>