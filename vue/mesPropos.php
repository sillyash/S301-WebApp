
<div class="pageTitleBar">
    Mes Propositions
</div>
<div class="flex flex-col justify-center align-middle w-full my-4 mx-2 p-1">

<?php
foreach ($propositions as $proposition) {
    $idProposition = $proposition['idProposition'];
    $titreProposition = $proposition['titreProposition'];
    $descProposition = $proposition['descProposition'];
    $href = ROOT_URL . "controleur/cettePropo.php?idProposition=$idProposition'";

    echo "<a class='text-white hover:text-red-500' href='$href'>";
    echo "<div class='flex flex-row align-middle bg-blue-500 rounded-md mx-1 my-2 p-2 justify-end h-20 items-center'>";
    echo "<span class='flex-2 text-lg mx-4'>$titreProposition : $descProposition</span>";
    echo "<span class='flex-2 text-right text-2xl mx-4'>➜</span>";
    echo "</div></a>";
}
?>

</div>

