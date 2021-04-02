<?php include 'variable.php';?>
<script src="jquery.js"></script>

<?php 
if (!isset($_SESSION)){
  session_start();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Contact us - Progressus Bootstrap template</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

</head>

	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" style="padding-top: 20px">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img style="height: 60px;" src="Datas/logo.PNG" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right" style="margin-right:10%">
					<li <?php if($page=="index") echo "class='active'" ?>><a href="index.php">Accueil</a></li>
					<li <?php if($page=="demonstration") echo "class='active'" ?>><a href="demonstration.php">Démonstration</a></li>
					<li <?php if($page=="about") echo "class='active'" ?>><a href="about.php">A propos de nous</a></li>
					<li <?php if($page=="help") echo "class='active'" ?>><a href="help.php">Aide</a></li>
                   
                    <?php 
                    if($_SESSION['isAdmin']==true) { ?>
							<li <?php if($page=="contact") echo "class='active'" ?>><a href="AddVisitor.php">Ajout Visiteur</a></li>
							<li <?php if($page=="contact") echo "class='active'" ?>><a href="showvisiteur.php">Voir les Visiteurs</a></li>
                    <?php } ?>
                                        
					<li <?php if($page=="contact") echo "class='active'" ?>><a href="contact.php">Contact</a></li>
                    <?php 
                    if(isset($_SESSION['isConnect'])) { ?>
                        <li><a class="btn" onclick="sessionDown();">déconnexion</a></li>
                    <?php

                    }  else{
                        ?>
                        <li <?php if($page=="signin") echo "class='active'" ?>><a class="btn" href="signin.php">Connexion</a></li>
                    <?php
                    }                 
                      ?>
                     <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="flag-icon flag-icon-fr"> </span> français</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#fr"><span class="flag-icon flag-icon-us"> </span>  English</a></li>
                                <li><a class="dropdown-item" href="#it"><span class="flag-icon flag-icon-it"> </span>  Italian</a></li>
                                <li><a class="dropdown-item" href="#ru"><span class="flag-icon flag-icon-ru"> </span>  Russian</a></li>
                            </ul>
                        </li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->
    <script>
    function sessionDown(){
        $.ajax({
                  url: "<?php echo $requestPath; ?>",
                  type: "post",
                  data: {action: "deconnexion"},
                  datatype: 'json',
                  success: function(data){
                        window.location.href="index.php"; 
                                },
                  error:function(){
                      alert("notOk");
                  }   
                }); 
    }
    </script>
