<?php $page="demonstration"; ?>
<?php include 'variable.php';?>
<?php include 'header.php';?>

<link rel="stylesheet" href="TemplateData/style.css">
<script src="TemplateData/UnityProgress.js"></script>
    <script src="Build/UnityLoader.js"></script>
    <script>
      var gameInstance = UnityLoader.instantiate("gameContainer", "Build/build.json", {onProgress: UnityProgress});
    </script>

<body class="home">                       
	<!-- container -->
	<div class="container">
		<div class="row">
			<div class="webgl-content" style="position: relative;margin-top:430px">
              <div id="gameContainer" style="width: 960px; height: 600px"></div>
              <div class="footer">
                <div class="webgl-logo"></div>
                <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div>
                <div class="title">MBANv2</div>
              </div>
            </div>
		</div> <!-- /row -->

		
    </div>	
    <!-- /container -->
	
	<!-- Social links. @TODO: replace by link/instructions in template -->
	<section id="social">
		<div class="container">
			<div class="wrapper clearfix">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_linkedin_counter"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
				</div>
				<!-- AddThis Button END -->
			</div>
		</div>
	</section>
	<!-- /social links -->
    
    <?php include 'footer.php';?>

