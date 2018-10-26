<?php include_once 'header.phtml'; ?>


<div class="container">
    <ul class="nav nav-tabs">
        <li id="inscriptions" class="active"><a data-toggle="tab" href="#INSCRIPTIONS">INSCRIPTIONS</a></li>
        <li id="utilisateurs"><a data-toggle="tab" href="#UTILISATEURS">UTILISATEURS</a></li>
        <li id="liste_attente"><a data-toggle="tab" href="#LISTE_ATTENTE">LISTE D'ATTENTE</a></li>
        <li id="historique"><a data-toggle="tab" href="#HISTORIQUE">HISTORIQUE</a></li>
    </ul>

    <div class="tab-content">

        <!-- ESPACE VALIDATION INSCRIPTIONS : DÉBUT --->

        <div id="INSCRIPTIONS" class="tab-pane fade in active">
            <h3>Validation des inscriptions</h3>
            <?php if (empty($data['personnes'])) : ?>
                <h4>Aucune validation à effectuer</h4>
            <?php else : ?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['personnes'] as $personne) : ?>
                            <tr>
                                <td><?= $personne->getNom()?></td>
                                <td><?= $personne->getPrenom()?></td>
                                <td><?= $personne->getMail()?></td>
                                <td>
                                    <a href="<?= BASE_URL.'valider/'.$personne->getId() ?>" style="text-decoration:none;">
                                        <input type="button" value="Valider">
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL.'refuser/'.$personne->getId() ?>" style="text-decoration:none;">
                                        <input type="button" value="Refuser">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- ESPACE VALIDATION INSCRIPTIONS : FIN ; ESPACE UTILISATEURS : DÉBUT --->

        <div id="UTILISATEURS" class="tab-pane fade">
            <h3>Consulte et édite les utilisateurs de ton site</h3>
            <?php if (empty($data['users'])) : ?>
                <h4>Aucun utilisateur</h4>
            <?php else : ?>
                <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Statut</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['users'] as $personne) : ?>
                    <tr>
                        <td><?= $personne->getNom()?></td>
                        <td><?= $personne->getPrenom()?></td>
                        <td><?= $personne->getMail()?></td>
                        <td><?= $personne->getStatut()->getLibelle()?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- ESPACE UTILISATEURS : FIN ; ESPACE LISTE D'ATTENTE : DÉBUT --->

        <div id="LISTE_ATTENTE" class="tab-pane fade">
            <h3>Consulte et édite la liste d'attente</h3>
            <?php if (empty($data['attentes'])) : ?>
                <h4>Aucune personne en liste d'attente</h4>
            <?php else : ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Rang</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Mail</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php $len = count($data['attentes']); ?>
                <?php foreach ($data['attentes'] as $personne) : ?>
                    <tr>
                        <td><?= $personne->getAttente()->getOrdre() ?></td>
                        <td><?= $personne->getNom()?></td>
                        <td><?= $personne->getPrenom()?></td>
                        <td><?= $personne->getMail()?></td>
                        <td>
                            <?php if ($personne->getAttente()->getOrdre() > 1) : ?>
                            <a href="<?= BASE_URL.'monter/'.$personne->getId() ?>" style="text-decoration:none;">
                                <input type="button" value="Monter">
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($personne->getAttente()->getOrdre() != $len) : ?>
                            <a href="<?= BASE_URL.'descendre/'.$personne->getId() ?>" style="text-decoration:none;">
                                <input type="button" value="Descendre">
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL.'attribuer/'.$personne->getId() ?>" style="text-decoration:none;">
                                <input type="button" value="Attribuer">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>

        <!-- ESPACE LISTE D'ATTENTE : FIN ; ESPACE HISTORIQUE : DÉBUT --->

        <div id="HISTORIQUE" class="tab-pane fade">
            <h3>Consulte l'historique des demandes</h3>
            <?php if (empty($data['reservation'])) : ?>
                <h4>Aucun Historique</h4>
            <?php else : ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Place</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Date Début</th>
                    <th scope="col">Date Fin</th>
                </tr>
                </thead>
                <tbody>  
                <?php foreach ($data['reservation'] as $reservation) : ?>
                <?php //var_dump($reservation);die; ?>
                    <tr>
                        <td><?= $reservation->getPlace()->getNumero()?></td>
                        <td><?= $reservation->getPersonne()->getNom()?></td>
                        <td><?= $reservation->getPersonne()->getPrenom()?></td>
                        <td><?= $reservation->getDebut()?></td>
                        <td><?= $reservation->getFin()?></td>
                    </tr>
                <?php endforeach; ?>    
                </tbody>
            </table>
            <?php endif; ?>
        </div>

        <!-- ESPACE HISTORIQUE : FIN --->

    </div>
</div>


<?php include_once 'footer.phtml'; ?>