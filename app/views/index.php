<?php include_once 'header.phtml'; ?>
	<script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
	<div class="container-fluid banniere">
		<h1 id="titre" class="titre titreAnimate"><b>Votre place de parking<br>à porté de main</b></h1>
		<br>
		<input type="button" class="btn btnAnimate" value="C'est parti !">
	</div>

	<div id="section1" class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h1><b>Le concept</b></h1>
				<h2>Votre place de parking à porté de main !</h2>
				<br>
				<p>
					Nous prenons en charge votre stationnement en vous trouvant la place de parking gratuite la plus proche de votre destination !
					<br>
					Pour plus de renseignement <a href="<?= IMG_PATH ?>Documentation.pdf" target="_blank">cliquez ici</a> pour accéder à la documentation du site.
				</p>

			</div>
			<div class="col-md-6 imgAnimate">
				<img src="<?= IMG_PATH ?>voiture.jpg" style="height:250px;width:500px;">
			</div>
		</div>
	</div>
	<div id="section2" class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-md-offset-2">
				<div class="card block">
					<div class="card-body block" style="height:400px;width:350px;color: black;background-color:#fff; ">
						<img src="<?= IMG_PATH ?>logoVoiture.jpg" style="height:120px;width:120px;">
						<br><br>
						<p class="card-text" style="font-size:20px";>Ensemble, trouvons la place idéale pour votre véhicule !</p><br><br>
						<a href="#" class="btn-section-3">S'incrire</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card block">
					<div class="card-body block" style="height:400px;width:350px;color:black;background-color:#fff; ">
						<img src="<?= IMG_PATH ?>logoConfiance.jpg" style="height:120px; width:120px;">
						<br><br>
						<p class="card-text" style="font-size:20px">Vous nous faîtes déjà confiance ?</p>
						<br><br>
						<a href="#" class="btn-section-3">Connexion</a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include_once 'footer.phtml'; ?>