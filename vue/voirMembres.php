<div class="pageTitleBar">
    CE GROUPE > Membres
</div>

<div>
    <ul class="w-full">
        <?php if (!empty($membres) && is_array($membres)): ?>
            <?php foreach ($membres as $membre): ?>
                <li class="w-full">
                    <div class="flex items-center justify-between w-full">
                        <div><?php echo htmlspecialchars($membre['login']); ?></div>
                        <div>[ <?php echo htmlspecialchars($membre['role']); ?> ]</div>
                        <a href="<?php echo ROOT_URL.'controleur/modifierRole.php?idMembre='.urlencode($membre['id']); ?>">
                            <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Changer rôle</button>
                        </a>
                        <a href="<?php echo ROOT_URL.'controleur/supprimerMembre.php?idMembre='.urlencode($membre['id']); ?>">
                            <button class="m-4 !bg-white !text-red-500 hover:!text-orange-500">Supprimer</button>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="w-full">
                <div class="text-center">Aucun membre trouvé.</div>
            </li>
        <?php endif; ?>
    </ul>
    <a href="<?php echo ROOT_URL.'controleur/inviterMembre.php?groupe='.urlencode($idGroupe); ?>">
        <button class="w-full">Inviter un nouveau membre</button>
    </a>
</div>