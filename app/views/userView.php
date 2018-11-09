<?php include_once 'header.phtml'; ?>

    
<div class="container">   


<!-- TABLEAU DE FONCTION : DÉBUT --->

<div class="col-md-9">  
<ul class="nav nav-tabs">
 
  <li id="place" class="active"><a data-toggle="tab" href="#PLACE">MA PLACE</a></li>
  <li id="historique_user"><a data-toggle="tab" href="#HISTORIQUE_USER">MON HISTORIQUE</a></li>
  <li id="parametres"><a data-toggle="tab" href="#PARAMETRES">PARAMÈTRES</a></li>

</ul>

<div class="tab-content">

<!-- ESPACE DEMANDE DE PLACE : DÉBUT --->

  <div id="PLACE" class="tab-pane fade in active">
      <?php if ($data['personne']->getStatut()->getId() == IOK_ID) : ?>
          <h3>Vous possédez une place</h3>
          <p><?= $data['personne']->getReservation(0)->getPlace()->getNumero() ?></p>
      <?php else: ?>
          <?php if ($data['personne']->getStatut()->getId() == IA_ID) : ?>
              <h3>Votre rang dans la liste d'attente</h3>
              <p><?= $data['personne']->getAttente()->getOrdre() ?></p>
          <?php else: ?>
              <h3>Demandez votre place</h3>
              <a href="<?= BASE_URL ?>demander" style="text-decoration:none;">
                  <input type="button" value="C'est içi">
              </a>
          <?php endif; ?>
      <?php endif; ?>
  </div>
  
<!-- ESPACE DEMANDE DE PLACE : FIN ; ESPACE HISTORIQUE : DÉBUT --->
  
  <div id="HISTORIQUE_USER" class="tab-pane fade">
    <h3>Mon historique personnel</h3>
    <p>Voici l'historique des places qui vont ont été attriubées depuis votre inscription.</p>
    <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Numéro</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DatePlace</td>
                        <td>NumPlace</td>
                    </tr>
                </tbody>
            </table>
  </div>
  
<!-- ESPACE HISTORIQUE : FIN ; ESPACE PARAMÈTRES : DÉBUT --->  
  
  <div id="PARAMETRES" class="tab-pane fade">
    <h3>Paramètres de mon compte</h3>
    <p>Dans cet espace vous pouvez consulter votre fiche utilisateur et changer votre mot de passe.</p>
    <p>NomUser PrénomUser</p>
    <p>Mail User</p>
    <input type="password" placeholder="votre mdp actuel">
    <br><br>
    <input type="password" placeholder="nouveau mdp">
    <br><br>
    <input type="password" placeholder="confirmer mdp">
    <br><br>
    <input type="button" value="valider">
  </div>
</div>

<!-- ESPACE PARAMÈTRES : FIN --->

</div>


<?php include_once 'footer.phtml'; ?>
