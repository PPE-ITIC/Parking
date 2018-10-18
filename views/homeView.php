<?php require "../layout.php"; ?>
<script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
<div class="container-fluid banniere">
    <h1 id="titre" class="titre titreAnimate"><b>Votre place de parking<br>à porté de main</b></h1>
    <br>
    <input type="button" class="btn btnAnimate" value="C'est parti !">
</div>

<div id="section1" class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h1>Le concept</h1>
            <p>Votre place de parking à porté de main !</p>
            <br>
            <p>
                Nous prenons en charge votre stationnement en vous trouvant la place de parking gratuite la plus proche de votre destination !
            </p>

        </div>
        <div class="col-md-6 imgAnimate">
            <img src="../images/voiture.jpg" style="height:250px;width:500px;">
        </div>
    </div>
</div>
<div id="section2" class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="card block">
                <div class="card-body block">
                    <img src="../images/logoVoiture.jpg" style="height:120px;width:120px;">
                    <br><br>
                    <p class="card-text">Ensemble, trouvons la place idéale pour votre véhicule !</p>
                    <a href="#" class="btn-section-3">S'incrire</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card block">
                <div class="card-body block" style="height:400px;width:350px;color:white;background-color:#fff; ">
                    <img src="../images/logoConfiance.jpg" style="height:120px; width:120px;">
                    <br><br>
                    <p class="card-text">Vous nous faîtes déjà confiance ?</p>
                    <a href="#" class="btn-section-3">Connexion</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../js/lib/greensock/plugins/ScrollToPlugin.min.js"></script>
<script src="js/app.js"></script>
<script src="../js/app.js"></script>
