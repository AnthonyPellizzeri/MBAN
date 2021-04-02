<?php $page="admin"; ?>
<?php include 'variable.php';?>
<?php include 'header.php';?>

<?php
    if($_SESSION['isAdmin']<>true){
        header("Location: signin.php");
        die();
    }
    
?>

<body>
	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Inscription</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Inscription</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Ajouter un nouveau visiteur</h3>
							<hr>

								<div class="top-margin">
									<label>Nom</label>
									<input type="text" class="form-control" id="name">
								</div>
								<div class="top-margin">
									<label>Email<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="mail">
								</div>

								<div class="row top-margin">
									<div class="col-sm-6">
										<label>Mot de passe <span class="text-danger">*</span></label>
										<input type="password" class="form-control" id="mdp">
									</div>
                                    <div class="col-sm-6">
										<label>Confirmation mot de passe<span class="text-danger">*</span></label>
										<input type="password" class="form-control" id="mdpOk">
									</div>
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox" id="check"> 
											J'ai lu et j'accepte <a href="page_terms.html">les termes et conditions</a>
										</label>                        
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" onclick="signup()">Inscription</button>
									</div>
								</div>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	
<script type="text/javascript"> 
        
    function signup(){
        var check=document.getElementById("check");
        var name=document.getElementById("name").value;
        var mail=document.getElementById("mail").value;
        var mdp=document.getElementById("mdp").value;
        var mdpOk=document.getElementById("mdpOk").value;
        if(check.checked && name && mail && mdp && mdpOk==mdp){
            $.ajax({
          url: "<?php echo $bddPath; ?>",
          type: "post",
          data: {action: "signUp", username:name, email:mail, password:mdp },
          datatype: 'json',
          success: function(data){
               window.location.href="signin.php"; 
          },
          error:function(){
              alert("notOk");
          }   
        }); 
        }
    }
</script>
<?php include 'footer.php';?>
