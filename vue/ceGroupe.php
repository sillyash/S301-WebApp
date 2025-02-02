<div class="pageTitleBar">
    CE GROUPE
</div>
<a href="<?php echo ROOT_URL.'/controleur/navigation.php/?membres'?>">
    <button class="m-4">Voir membres</button>
</a>

<!-- TODO add get nb votes from DB -->
<div class="flex space-x-4">
    <div class="bg-blue-500 text-white rounded-md p-4 m-4">
        <p><strong>VOTES EN COURS</strong></p>
        <hr>
        <ul class="w-full">
            <li class="w-full">
                <div class="flex flex-col items-start w-full">
                    <div>Vote 1</div>
                    <div>POUR: [nb] | CONTRE: [nb]</div>
                </div>
            </li>
            <li class="w-full">
                <div class="flex flex-col items-start w-full">
                    <div>Vote 2</div>
                    <div>POUR: [nb] | CONTRE: [nb]</div>
                </div>
            </li>
            <li class="w-full">
                <div class="flex flex-col items-start w-full">
                    <div>Vote 3</div>
                    <div>POUR: [nb] | CONTRE: [nb]</div>
                </div>
            </li>
        </ul>
    </div>    

    <div class="bg-blue-500 text-white rounded-md p-4 m-4">
        <p><strong>LISTE PROPOSITIONS</strong></p>
        <hr>
        <ul class="w-full">
            <li class="w-full">
                <div class="flex items-center justify-between w-full">
                    <div>PROPO 1</div>
                    <a href="index.php">
                        <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Déclencher vote</button>
                    </a>
                </div>
            </li>
            <li class="w-full">
                <div class="flex items-center justify-between w-full">
                    <div>PROPO 2</div>
                    <a href="index.php">
                        <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Déclencher vote</button>
                    </a>
                </div>
            </li>
            <li class="w-full">
                <div class="flex items-center justify-between w-full">
                    <div>PROPO 3</div>
                    <a href="index.php">
                        <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Déclencher vote</button>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
