<?php $page="about"; ?>
<?php include 'variable.php';?>
<?php include 'header.php';?>

<body>
	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Nous</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Qui sommes-nous?</h1>
				</header>
				<h3>MBANv2</h3>
				<p style="text-align:justify"><img src="Datas/logo.PNG" alt="" class="img-rounded pull-right" width="300" > 
                    La plateforme MBANv2 a été développée par l’équipe BIRD du laboratoire LORIA (Université de Lorraine), en
collaboration avec le musée des Beaux-Arts de Nancy et la métropole du Grand Nancy. Les chercheurs de
cette équipe travaillent dans le domaine de l’héritage culturel et développent des algorithmes de
recommandation de parcours pour des visites de musée. Afin de répondre au mieux aux attentes des
visiteurs, ces algorithmes d'Intelligence Artificielle nécessitent d’être entraînés sur de grandes quantités
de données.
</p>
<p style="text-align:justify"> 
Construire un simulateur muséal permet de faciliter la mise en œuvre de tests utilisateurs dans différentes
situations et configurations (performances des algorithmes, expérience de visite...), tout en diffusant
plus largement un cadre d'évaluation commun. La plateforme MBANv2 s'adresse donc à tous les acteurs
publics du secteur de l'héritage culturel (intelligence artificielle, psychologie, sociologie, muséologie,
sciences de l'éducation, ludologie, médiation numérique...) désireux de réaliser des études hors les
murs. Elle sera diffusée sous licence CC-BY-NC-SA 4.0 pour une utilisation non commerciale et à des fins de
recherche.
</p>
                <p style="text-align:justify"> 
Vous pouvez trouver une courte vidéo de présentation de notre projet sur Youtube : https://youtu.be/wqg6VIMy05k <br>
- Coordinateur du projet : Sylvain Castagnos (LORIA, IDMC Université de Lorraine)<br>
- Contributeurs : Florian Marchal (LORIA), Yohann Fransot (LORIA), Sophie Mouton (Nancy-Musées), Sophie Toulouze (Nancy-Musées), Charles Villeneuve de Janti (Nancy-Musées), Michèle Leinen (Nancy-Musées), Jean-Paul Darada (Métropole du Grand Nancy), Gabriel Daubenfeld (IDMC), Jérémy Germain (IDMC), Julien Hans (IDMC), Julie Cunin (IDMC), Mathias Rihet (IDMC), Titouan Boudard (IDMC), Alexandre Remiatte (IDMC), Juliette Kratz (IDMC), Anthony Pellizzeri (IDMC), Alix Delannoy (Mines Nancy), Violaine Ferrandez (Mines Nancy), Loïc Jimenez (IDMC), Martin Lemaitre (IDMC), Robin Sevillano (IDMC), Alexandre Bertrand (IDMC), Djalila Mahmoudi (IDMC), Morgane Colle (IDMC), Loane Didierjean (Université de Lorraine), Kevin Degiorgio (Université de Lorraine), Yann Richard (Université de Lorraine)
                <br>
Contact : bird-studies at loria.fr<br>
BIRD Team (LORIA) : http://bird.loria.fr/fr/<br>
IDMC (Université de Lorraine) : https://idmc.univ-lorraine.fr/<br>
Musée des Beaux-Arts de Nancy : https://musee-des-beaux-arts.nancy.fr/<br>
Métropole du Grand Nancy : https://www.grandnancy.eu/accueil/<br>
Mines Nancy (Université de Lorraine) : https://mines-nancy.univ-lorraine.fr/
                </p>
				
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-sm-4 sidebar sidebar-right">

				<div class="widget">
					<h4>Informations</h4>
					<ul class="list-unstyled list-spaces">
						<li><a href="">Projet M2 MIAGE - ACSI</a><br><span class="small text-muted">Passage de l'application Unity vers un site web</span></li>
						<li><a href="">Projet M2 MIAGE - SID</a><br><span class="small text-muted">Création d'un algorithme de recommandations</span></li>
						<li><a href="">Projet M1 Sciences Cognitives</a><br><span class="small text-muted">Faire un audit ergonomique de la solution et réaliser un travail prospectif sur des fonctionnalités, des modes d’interactions et des écrans à implémenter</span></li>
					</ul>
				</div>

			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	

<?php include 'footer.php';?>