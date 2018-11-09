<?php include_once 'header.phtml'; ?>
    <div class="container">

        <ul class="nav nav-tabs">
            <li id="liste_attente"><a data-toggle="tab" href="#LISTE_ATTENTE">ATTRIBUTION</a></li>
        </ul>

        <div class="tab-content">

            <div id="LISTE_ATTENTE" class="tab-pane fade">
                <h3>Attribution d'une place pour <?= $data['personne']->getPrenom()." ".$data['personne']->getNom() ?></h3>
                <?php if (isset($data['attribution_error'])): ?>
                    <h4 style="color:red;"><?= $data['attribution_error'] ?></h4>
                <?php endif; ?>
                <form method="POST" action="<?= BASE_URL ?>attribuer/<?= $data['personne']->getId() ?>">
                    <input type="hidden" name="id" value="<?=$data['personne']->getId()?>"/>
                    Début :
                    <input type="date" name="debut" />
                    Fin :
                    <input type="date" name="fin" />
                    <input type="submit" value="Valider"/>
                </form>
                <br>
                <a href="<?= BASE_URL ?>admin" style="text-decoration:none;">
                    Retour
                </a>
            </div>

        </div>
    </div>

<?php include_once 'footer.phtml'; ?>