<?php $page="signin"; ?>
<?php include 'variable.php';?>
<?php include 'header.php';?>

<body>

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">User access</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Sign in</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Sign in to your account</h3>
							<p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signup.html">Register</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
							<hr>
							
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
										<b><a href="">Forgot password?</a></b>
									</div>
									<div class="col-lg-4 text-right">
										<button onclick="signin()" class="btn btn-action" >Sign in</button>
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
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

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
                  data: {action: "connexion", username:mail,password:mdp },
                  datatype: 'json',
                  success: function(data){
                        window.location.href="index.php"; 
                                },
                  error:function(){
                      alert("notOk");
                  }   
                }); 
              }
          },
          error:function(){
              alert("notOk");
          }   
        }); 
        }
    }
</script>
    
<?php include 'footer.php';?>