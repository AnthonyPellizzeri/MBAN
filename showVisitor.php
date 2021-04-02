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
					<h1 class="page-title">Les visiteurs</h1>
				</header>
				
				<table id="test" style="width: 100%;"></table>				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	
<script type="text/javascript"> 
    window.onload = function() {
   $.ajax({
          url: "<?php echo $bddPath; ?>",
          type: "post",
          data: {action: "ShowAllVisitor" },
          datatype: 'json',
          success: function(data){
              var tab=JSON.parse(data);
             //alert(tab.length);
             var body = document.getElementById("test");
            var tbl = document.createElement("table");
            tbl.className="table";

              var tblBody = document.createElement("tbody");
              // header
              for (var i = 0; i < 1; i++) {
                var row = document.createElement("tr");
                var cell = document.createElement("th");
                var cellText = document.createTextNode("Mail");
                cell.appendChild(cellText);
                row.appendChild(cell);
                var row1 = document.createElement("tr");
                var cell1 = document.createElement("th");
                var cellText1 = document.createTextNode("NOM");
                cell1.appendChild(cellText1);
                row.appendChild(cell1);
                var row2 = document.createElement("tr");
                var cell2 = document.createElement("th");
                var cellText2 = document.createTextNode("Visible");
                cell2.appendChild(cellText2);
                row.appendChild(cell2);
                tblBody.appendChild(row);
                var row3 = document.createElement("tr");
                var cell3 = document.createElement("th");
                var cellText3 = document.createTextNode("Action");
                cell3.appendChild(cellText3);
                row.appendChild(cell3);
                tblBody.appendChild(row);
              }
              
              for (var i = 0; i < tab.length; i++) {
                var row = document.createElement("tr");
                var ligne=tab[i].split("|");
                for (var j = 0; j < 4; j++) {
                  var cell = document.createElement("td");
                    if(j==3){
                        if(ligne[j-1]==1){
                            var input = document.createElement("input");
                            var btn = document.createElement("BUTTON");   // Create a <button> element
                            btn.innerHTML = "Rendre inactif"; 
                        }else{
                            var input = document.createElement("input");
                            var btn = document.createElement("BUTTON");   // Create a <button> element
                            btn.innerHTML = "Rendre actif";  
                        }
                        cell.appendChild(btn)
                    }
                    else{
                        var cellText = document.createTextNode(ligne[j]);
                        cell.appendChild(cellText)
                    }
                  ;
                  row.appendChild(cell);
                }
                tblBody.appendChild(row);
              }
              tbl.appendChild(tblBody);
              body.appendChild(tbl);
          },
          error:function(){
              alert("notOk");
          }   
        }); 
};
</script>
<?php include 'footer.php';?>
