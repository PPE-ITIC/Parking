<?php include_once 'header.phtml'; ?>

    
<div class="container">   

<?php echo 'Bonjour '.$data['personne']->getPrenom().' '.$data['personne']->getNom(); ?>
<?php echo 'Statut '.$data['personne']->getStatut()->getLibelle(); ?>


<!-- TABLEAU DE FONCTION : DÉBUT --->

<div class="col-md-9">  
<ul class="nav nav-tabs">
 
  <li class="active"><a data-toggle="tab" href="#DEMANDE">DEMANDE</a></li>
  <li><a data-toggle="tab" href="#HISTORIQUE">MON HISTORIQUE</a></li>
  <li><a data-toggle="tab" href="#PARAMETRES">PARAMÈTRES</a></li>

</ul>

<div class="tab-content">

<!-- ESPACE DEMANDE DE PLACE : DÉBUT --->
 
  <div id="DEMANDE" class="tab-pane fade in active">
    <h3>Faire une demande de place</h3>
    <p>Remplissez le formulaire pour effectuer votre demande.</p>
    <form>
        <input type="text" value="date">
        <input type="text" value="durée">
        <input type="text" value="">
        <input type="button" value="Valider">
    </form>
  </div>
  
<!-- ESPACE DEMANDE DE PLACE : FIN ; ESPACE HISTORIQUE : DÉBUT --->
  
  <div id="HISTORIQUE" class="tab-pane fade">
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

<!-- TABLEAU DE FONCTION : FIN --->


<!-- ESPACE À GAUCHE : DÉBUT -->

<div class="col-md-3">
  
   <!-- CAS OÙ L'USER À UNE PLACE ATTRIBUÉE -->
   
    <p>Ma place</p>
    <p>NuméroPlace</p>
    
   <!-- - CAS OÙ L'USER EST EN LISTE D'ATTENTE -->
   
   <p>Mon rang dans la file d'attente</p>
   <p>NumRang</p>
   
</div>

<!-- ESPACE À GAUCHE : FIN -->

<a href="">Se déconnecter</a>

</div> 

<?php include_once 'footer.phtml'; ?>
