<div class="pageTitleBar">
    CETTE PROPOSITION
</div>
<!-- TODO retrieve data from BDD -->
<!-- TODO change form action -->
<!-- TODO handle reactions here -->
<div class="bg-white rounded-md w-1/2">
    <p>[TITRE]</p>
    <p>[THEMES]</p>
    <hr>
    <p>Description</p>
</div>
<!-- TODO maybe this should be a seperate component? -->
<div class="w-1/2">
    <p>ESPACE COMMENTAIRES</p>
    <form>
        <div>
            <label class="flex-1" for="comment">[USERNAME]</label>
            <input class="flex-2" type="text" name="comment" required>
        </div>
        <button class="!bg-white !text-blue-500 hover:!text-blue-600" type="submit">
            Ajouter un commentaire
        </button>
    </form>
</div>