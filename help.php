<?php $page="help"; ?>
<?php include 'variable.php';?>
<?php include 'header.php';?>

<body>
	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">
		
		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">aide</li>
		</ol>

		<div class="row">
			
			<!-- Sidebar -->
			<aside class="col-md-4 sidebar sidebar-left">

				<div class="row widget">
					<div class="col-xs-12">
						<h3>COMMANDES</h3>
					</div>
				</div>
				<div class="row widget">
					<div class="col-xs-12">
						<h4>Se déplacer</h4>
						<p><img src="Datas/clavier.png" alt=""></p>
					</div>
				</div>
				<div class="row widget">
					<div class="col-xs-12">
						<h4>Inspecter un tableau</h4>
						<p><img src="Datas/souris.png" alt="" style="height: 300px"></p>
					</div>
				</div>

			</aside>
			<!-- /Sidebar -->

			<!-- Article main content -->
			<article class="col-md-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Aide concernant l'utilisation de la simulation du musé</h1>
				</header>
				<p>Il est necessaire de se connecter avec un compte Administrateur afin d'accèder à l'application</p>
				<p>Cet administrateur pourra proposer à un compte visiteur de se balader et visiter le musé</p>
                <br>
				<h4>Plan en 3D</h4>
                <p><img src="Datas/map.png" alt="" style="height: 350px"></p>
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	

<?php include 'footer.php';?>
