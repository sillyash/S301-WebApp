<a class="flex w-full align-middle justify-center" href="<?php echo ROOT_URL.'controleur/voirMembres.php'?>">
    <button class="w-full m-4">Voir membres</button>
</a>

<?php

function getContrastColor($hexcolor) {               
    $r = hexdec(substr($hexcolor, 1, 2));
    $g = hexdec(substr($hexcolor, 3, 2));
    $b = hexdec(substr($hexcolor, 5, 2));
    $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
    return ($yiq >= 128) ? '#000000' : '#ffffff';
}

$image = $groupe['imgGroupe'] ?? "https://picsum.photos/200/200";
$desc = $groupe['descGroupe'];
$nom = $groupe['nomGroupe'];
$color = $groupe['couleurGroupe'];
$contrastColor = getContrastColor($color);

echo "<div class='flex items-center justify-around w-full p-5 my-5'>";
echo "<img src='$image' alt='groupe' class='mx-20 rounded-full w-30 h-30 object-contain'>";
echo "<p class='mx-5 text-2xl font-bold underline h-full align-middle text-left p-5' style='color:$color;'>$nom</p>";
echo "<div class='mx-10 w-100 h-full align-middle justify-center rounded-md p-5'";
echo "style='color:$contrastColor;background-color:$color;'>";
echo "$desc</div></div>";

echo "<div class='flex flex-1'><div class='bg-blue-500 text-white rounded-md p-4 m-4'>";
echo "<p><strong>VOTES EN COURS</strong></p><hr><ul class='w-full'>";

foreach ($scrutins as $scrutin) {
    $idScrutin = $scrutin['idScrutin'];
    $titre = $scrutin['titreProposition'];
    $nature = $scrutin['natureScrutin'];
    $pour = $scrutin['Pour'];
    $contre = $scrutin['Contre'];

    echo "<a class='!bg-white !text-red-500 hover:!text-orange-500 rounded-md'";
    echo "href='".ROOT_URL."controleur/cettePropo.php?idScrutin=$idScrutin'>";
    echo "<li class='flex items-center justify-between w-full p-2 m-2'>$titre : $nature";
    echo "</a></li>";
}

echo "</ul></div>";
echo "<div class='flex flex-1'><div class='bg-blue-500 text-white rounded-md p-4 m-4'>";
echo "<p><strong>PROPOSITIONS</strong></p><hr><ul class='w-full'>";

foreach ($propositions as $proposition) {
    $idProposition = $proposition['idProposition'];
    $titre = $proposition['titreProposition'];

    echo "<a class='!bg-white !text-red-500 hover:!text-orange-500 rounded-md'";
    echo "href='".ROOT_URL."controleur/cettePropo.php?idProposition=$idProposition'>";
    echo "<li class='flex items-center justify-between w-full p-2 m-2'>$titre";
    echo "</a></li>";
}

echo "</ul></div></div>";

?>

</div>
