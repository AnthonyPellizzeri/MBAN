<?php $page="signin"; ?>
<?php include 'variable.php';?>
<?php include 'header.php';?>

<body>

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Connexion</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Se connecter</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<div>
								<div class="top-margin">
									<label>Pseudo/Email <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="mail">
								</div>
								<div class="top-margin">
									<label>Mot de passe <span class="text-danger">*</span></label>
									<input type="password" class="form-control" id="mdp">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<b><a href="">Mot de passe oublié?</a></b>
									</div>
									<div class="col-lg-4 text-right">
										<button onclick="signin()" class="btn btn-action" >Connexion</button>
									</div>
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
        
    function signin(){
        var mail=document.getElementById("mail").value;
        var mdp=document.getElementById("mdp").value;
        if(mail && mdp){
            $.ajax({
          url: "<?php echo $bddPath; ?>",
          type: "post",
          data: {action: "logIn", username:mail,password:mdp },
          datatype: 'json',
          success: function(data){
                //alert(data); 
              if(data.length>1){
                  // connexion
                  $.ajax({
                  url: "<?php echo $requestPath; ?>",
                  type: "post",
                  data: {action: "connexion", id:data.split("|")[0], name:data.split("|")[1], role:data.split("|")[2] },
                  datatype: 'json',
                  success: function(data){
                        window.location.href="index.php"; 
                                },
                  error:function(){
                      alert("notOk2");
                  }   
                }); 
              }
          },
          error:function(){
              alert("notOk1");
          }   
        }); 
        }
    }
</script>
    
<?php include 'footer.php';?>
