<!-- TODO add get group name and propo title from DB -->
<div class="pageTitleBar">
    CE GROUPE > CETTE PROPO
</div>

<div class="flex items-center justify-between w-1/2 mt-4">
    <!-- TODO fix form action -->
    <form class="bg-white rounded-md p-4" action="<?php echo ROOT_URL.'/controleur/modifRole.php'?>">
        <div class="flex">
            <div class="mr-4">
                <label for="pourContre">
                    Pour / Contre
                </label>
                <input id="pourContre" name="scrutin" type="radio">
            </div>
            <div>
                <label for="majDbTour">
                    Majoritaire à double tour
                </label>
                <input id="majDbTour" name="scrutin" type="radio">
            </div>
        </div>
        <div class="flex mt-2">
            <div class="mr-4">
                <label for="majSimple">
                    Majoritaire simple
                </label>
                <input id="majSimple" name="scrutin" type="radio">
            </div>
            <div>
                <label for="majList">
                    Majoritaire avec liste d'évaluation
                </label>
                <input id="majList" name="scrutin" type="radio">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit">
                Lancer vote ➜
            </button>
        </div>
    </form>
</div>