<?php

$image = $groupe['imgGroupe'] ?? "https://picsum.photos/200/200";
$desc = $groupe['descGroupe'];
$nom = $groupe['nomGroupe'];

echo "<div class='flex items-center justify-around w-full p-5 my-5'>";
echo "<img src='$image' alt='groupe' class='mx-20 rounded-full w-30 h-30 object-contain'>";
echo "<p class='mx-5 text-xl underline h-full align-middle text-left text-black p-5'>$nom</p>";
echo "<div class='mx-10 w-100 h-full align-middle justify-center bg-gray-500 rounded-md text-white p-5'>";
echo "$desc</div></div>";

echo "<div class='flex space-x-4'><div class='bg-blue-500 text-white rounded-md p-4 m-4'>";
echo "<p><strong>VOTES EN COURS</strong></p><hr><ul class='w-full'>";

foreach ($votes as $vote) {
    $idVote = $vote['idVote'];
    $titre = $vote['titreVote'];
    $pour = $vote['pour'];
    $contre = $vote['contre'];

    echo "<li class='w-full'><div class='flex flex-col items-start w-full'>";
    echo "<div>$titre</div><div>POUR: $pour | CONTRE: $contre</div></div></li>";
}

echo "</ul></div>";
echo "<div class='flex space-x-4'><div class='bg-blue-500 text-white rounded-md p-4 m-4'>";
echo "<p><strong>VOTES EN COURS</strong></p><hr><ul class='w-full'>";

foreach ($propositions as $proposition) {
    $idProposition = $proposition['idProposition'];
    $titre = $proposition['titreProposition'];

    echo "<li class='w-full'><div class='flex items-center justify-between w-full'>";
    echo "<div>$titre</div>";
    echo "<a href='".ROOT_URL."controleur/lancerVote.php'>";
    echo "<button class='m-4 !bg-white !text-red-500 hover:!text-orange-500'>Déclencher vote</button></a></div></li>";
}

echo "</ul></div></div>";

?>

<a href="<?php echo ROOT_URL.'controleur/voirMembres.php'?>">
    <button class="m-4">Voir membres</button>
</a>
