<?php require "../layout.php"; ?>


<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/fondAnime.css">


<!--- DÉBUT FORMULAIRE --->

<div class="voiture">
    <div class="container formulaire" style="background-color:transparent;">

    <form class="form-signin" method="POST">
     
      <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      
      <h1 class="h3 mb-3 font-weight-normal">S'inscrire</h1>
      
      <label for="inputEmail" class="sr-only">Nom</label>
      <input type="text" id="nom" class="form-control" placeholder="Nom" required autofocus>
      
      <label for="inputEmail" class="sr-only">Prénom</label>
      <input type="text" id="prenom" class="form-control" placeholder="Prénom" required autofocus>
      
      <label for="inputEmail" class="sr-only">Adresse mail</label>
      <input type="email" id="mail" class="form-control" placeholder="Mail" required autofocus>
      
      <label for="inputPassword" class="sr-only">Confirmation de l'adresse mail</label>
      <input type="email" id="password" class="form-control" placeholder="Confirmation Mail" required>
      
      <br>
      
      <button class=" btn-lg btn-primary btn-block" type="submit">Sign in</button>
      
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