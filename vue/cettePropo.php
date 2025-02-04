<?php

$idProp = $proposition['idProposition'];
$titre = $proposition['titreProposition'];
$desc = $proposition['descProposition'];
$theme = $proposition['nomTheme'];
$popularity = $proposition['popularite'];
$groupe = $proposition['nomGroupe'];
$cout = $proposition['cout'];
$resultat = $proposition['resultatScrutin'];

$voteDeclenche = ($resultat == "En cours");
$hrefVotePour = ROOT_URL . "/controleur/vote?valeurVote=1&idProposition=$idProp";
$hrefVoteContre = ROOT_URL . "/controleur/vote?valeurVote=-1&idProposition=$idProp";

echo "
<div class='container mx-auto p-4'>
    <div class='pageTitleBar'>$titre</div>
    <div class='bg-white shadow-md rounded-lg p-6'>
        <div class='flex flex-row mb-4 text-gray-700'>
            <p class='flex-1 mx-5 font-bold mr-2'>Description</p>
            <p class='flex-3 mx-5'>$desc</p>
        </div>
        <div class='flex flex-row mb-4 text-gray-700'>
            <p class='flex-1 mx-5 font-bold mr-2'>Theme</p>
            <p class='flex-3 mx-5'>$theme</p>
        </div>
        <div class='flex flex-row mb-4 text-gray-700'>
            <p class='flex-1 mx-5 font-bold mr-2'>Popularite</p>
            <p class='flex-3 mx-5'>$popularity</p>
        </div>
        <div class='flex flex-row mb-4 text-gray-700'>
            <p class='flex-1 mx-5 font-bold mr-2'>Groupe</p>
            <p class='flex-3 mx-5'>$groupe</p>
        </div>
        <div class='flex flex-row mb-4 text-gray-700'>
            <p class='flex-1 mx-5 font-bold mr-2'>Cout</p>
            <p class='flex-3 mx-5'>$cout</p>
        </div>
        <div class='flex flex-row mb-4 text-gray-700'>
            <p class='flex-1 mx-5 font-bold mr-2'>Resultat</p>
            <p class='flex-3 mx-5'>$resultat</p>
        </div>
    </div>
";

echo "<div class='flex flex-row justify-center align-middle w-full my-4'>";

if ($voteDeclenche) {
    echo "
    <a class='flex-1 mt-6 mx-10 w-full' href='$hrefVotePour'>
        <button class='w-full bg-blue-500! hover:bg-blue-700! text-white font-bold py-2 px-4 rounded'>
            Voter pour
        </button>
    </a>
    <a class='flex-1 mt-6 mx-10 w-full' href='$hrefVoteContre'>
        <button class='w-full bg-red-500! hover:bg-red-700! text-white font-bold py-2 px-4 rounded'>
            Voter contre
        </button>
    </a>
    ";
} elseif ($isAdmin) {
    echo "
    <a class='flex-1 mt-6 mx-10 w-full' href='$hrefVotePour'>
        <button class='w-full bg-blue-500! hover:bg-blue-700! text-white font-bold py-2 px-4 rounded'>
            Declencher vote
        </button>
    </a>
    ";
}

echo "</div></div>";

?>