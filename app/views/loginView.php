<?php include_once 'header.phtml'; ?>


<!--- DÉBUT FORMULAIRE --->

<div class="voiture">
    <div class="container formulaire" style="background-color:transparent;">

    <form class="form-signin" method="POST" action="<?= BASE_URL.'connexion'?>">
     
      <img class="mb-4" src="<?= IMG_PATH ?>LogoLoveCar-Blanc.jpg" alt="" width="72" height="72" style="border-radius:90%;margin-left:35%;">
      <br>

      <?php if (isset($_SESSION['connexion_error'])): ?>
        <div id="connexion-error" class="alert alert-danger"><?= $_SESSION['connexion_error'] ?></div>
      <?php endif; ?>
      
      <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>

      <label for="inputEmail" class="sr-only">Adresse mail</label>
      <input type="email" id="mail" name="mail" class="form-control" placeholder="Mail" value="<?= isset($_SESSION['mail']) ? $_SESSION['mail'] : "" ?>" required autofocus>
      
      
      <label for="inputEmail" class="sr-only">Mot de passe</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required autofocus>
      
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      
      <button class=" btn-lg btn-primary btn-block" type="submit">Se connecter</button>
          <p>
        Pour se connecter en administrateur : 
        <br>
        mail : admin@admin.com  mdp : admin
    </p>
    </form>

</div>

<!--- FIN FORMULAIRE ---><!--- DÉBUT FOND ANIMÉ --->        
    
    
    <div class="moon"></div>

    <div class="skyline">
       <!--
        <div class="building1-shadow"></div>
        <div class="building1">

            <div class="building-left-half"></div>
            <div class="building-right-half"></div>
        </div>
        -->
    </div>
    <div class="road">
        <div class="road-top-half"></div>
        <div class="road-bottom-half"></div>
    </div>

    <div class="car-container">
        <div class="car-top1">
            <div class="window1"></div>
            <div class="window2"></div>

        </div>
        <div class="car-top2">
            <div class="door">
                <div class="door-knob"></div>
            </div>
        </div>
        <div class="car-bottom">
            <div class="wheel1-top"></div>
            <div class="wheel1">
                <div class="wheel-dot1"></div>
                <div class="wheel-dot2"></div>
                <div class="wheel-dot3"></div>
                <div class="wheel-dot4"></div>

            </div>

            <div class="wheel2-top"></div>
            <div class="wheel2">
                <div class="wheel-dot1"></div>
                <div class="wheel-dot2"></div>
                <div class="wheel-dot3"></div>
                <div class="wheel-dot4"></div>
            </div>
        </div>
    </div>
</div>




<!--- FIN FOND ANIMÉ --->
<?php include_once 'footer.phtml'; ?>