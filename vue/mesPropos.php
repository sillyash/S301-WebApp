
<div class="pageTitleBar">
    Mes Propositions
</div>
<div>
    <!-- TODO add for loop to get all propos an internaute has done -->
    <!-- TODO if there are no propos, display "Pas de propositions!" or smt -->
    <ul class="w-full">
        <li class="w-full">
            <div class="flex items-center justify-between w-full">
                <div>PROPO 1</div>
                <a href= "<?php echo ROOT_URL.'controleur/cettePropo.php'?>">➜</a>
            </div>
        </li>
        <li class="w-full">
            <div class="flex items-center justify-between w-full">
                <div>PROPO 2</div>
                <a href= "<?php echo ROOT_URL.'controleur/cettePropo.php'?>">➜</a>
            </div>
        </li>
        <li class="w-full">
            <div class="flex items-center justify-between w-full">
                <div>PROPO 3</div>
                <a href= "<?php echo ROOT_URL.'controleur/cettePropo.php'?>">➜</a>
            </div>
        </li>
    </ul>
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

