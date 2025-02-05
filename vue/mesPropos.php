
<div class="pageTitleBar">
    Mes Propositions
</div>
<div class="bg-blue-500 rounded-md">
    <?php
    foreach ($propositions as $proposition) {
        $idProposition = $proposition['idProposition'];
        $titreProposition = $proposition['titreProposition'];
        $descProposition = $proposition['descProposition'];

        echo "<a class='!bg-white !text-red-500 hover:!text-orange-500 rounded-md' ";
        echo "href='" . ROOT_URL . "controleur/cettePropo.php?idProposition=$idProposition'>";
        echo "<li class='flex items-center justify-between w-full p-2 m-2'>$titreProposition : $descProposition";
        echo "</a></li>";
    }
    ?>
</div>

