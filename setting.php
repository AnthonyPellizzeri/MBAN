<?php $page="setting"; ?>
<?php include 'variable.php';?>
<?php include 'header.php';?>

<?php
    if($_SESSION['isConnect']<>true){
        header("Location: signin.php");
        die();
    }
    
?>
	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Paramètres</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Changer de mot de passe</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<div>
								<div class="top-margin">
									<label>Pseudo/Email <span class="text-danger">*</span></label>
									<input readonly type="text" class="form-control" id="mail" value="<?php echo $_SESSION['name'] ?>">
								</div>
								<div class="top-margin">
									<label>Nouveau mot de passe <span class="text-danger">*</span></label>
									<input type="password" class="form-control" id="mdp">
								</div>
                                <div class="top-margin">
									<label>Confirmation du mot de passe<span class="text-danger">*</span></label>
									<input type="password" class="form-control" id="mdpOk">
								</div>
							</div>
                            <hr>

								<div class="row">
									<div class="col-lg-4 text-right">
										<button onclick="change()" class="btn btn-action" >Changer</button>
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
    function change(){
        var mdp=document.getElementById("mdp").value;
        var mdpOk=document.getElementById("mdpOk").value;
        if(mdp && mdpOk && mdpOk==mdp){
           $.ajax({
            url: "<?php echo $bddPath; ?>",
            type: "post",
            data: {action: "changePwd", id:<?php echo $_SESSION['id'] ?>,mdp:mdpOk },
            datatype: 'json',
            success: function(data){
                //alert(data);
                window.location.href="index.php"; 
                },
            error:function(){
                alert("notOk");
            }   
            });
        } 
    }
</script>
<?php include 'footer.php';?>
