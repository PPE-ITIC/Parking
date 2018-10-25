<?php include_once 'header.phtml'; ?>

    
<div class="container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#INSCRIPTIONS">INSCRIPTIONS</a></li>
        <li><a data-toggle="tab" href="#UTILISATEURS">UTILISATEURS</a></li>
        <li><a data-toggle="tab" href="#LISTE_ATTENTE">LISTE D'ATTENTE</a></li>
        <li><a data-toggle="tab" href="#HISTORIQUE">HISTORIQUE</a></li>
    </ul>

    <div class="tab-content">

        <!-- ESPACE VALIDATION INSCRIPTIONS : DÉBUT --->

        <div id="INSCRIPTIONS" class="tab-pane fade in active">
            <h3>Validation des inscriptions</h3>
            <p>...</p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NomUser</td>
                        <td>PrénomUser</td>
                        <td>MailUser</td>
                        <td><input type="button" value="Valider"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ESPACE VALIDATION INSCRIPTIONS : FIN ; ESPACE UTILISATEURS : DÉBUT --->

        <div id="UTILISATEURS" class="tab-pane fade">
            <h3>Consulte et édite les utilisateurs de ton site</h3>
            <p>...</p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>NomUser</td>
                        <td>PrénomUser</td>
                        <td>MailUser</td>
                        <td><input type="button" value="Éditer"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ESPACE UTILISATEURS : FIN ; ESPACE LISTE D'ATTENTE : DÉBUT --->

        <div id="LISTE_ATTENTE" class="tab-pane fade">
            <h3>Consulte et édite la liste d'attente</h3>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Rang</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>RangUser</td>
                        <td>NomUser</td>
                        <td>PrénomUser</td>
                        <td>MailUser</td>
                        <td><input type="button" value="Éditer"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ESPACE LISTE D'ATTENTE : FIN ; ESPACE HISTORIQUE : DÉBUT --->

        <div id="HISTORIQUE" class="tab-pane fade">
            <h3>Consulte l'historique des demandes</h3>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Rang</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Mail</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>RangUser</td>
                        <td>NomUser</td>
                        <td>PrénomUser</td>
                        <td>MailUser</td>
                        <td><input type="button" value="Réinitialiser mdp"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ESPACE HISTORIQUE : FIN --->

    </div>
</div>


<?php include_once 'footer.phtml'; ?>
