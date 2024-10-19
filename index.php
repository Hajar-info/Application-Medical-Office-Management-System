
<?php
  // Initialiser la session
  session_start();


  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(isset($_SESSION["username"])){
    header("Location: home.php");
    exit();
  }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Gestion d'un cabinet Médicale</title>

		<link href="css_au/styleIndex.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js_au/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 1600,
			        speed: 600
			      });
			});
		  </script>
	</head>
	<body>
		<!--start-wrap-->
		
			<!--start-header-->
			<div class="header">
				<div class="wrap" >
				<!--start-logo-->
				<div class="logo">
					<strong><h1 style="color:#0F4D67">Gestion d'un cabinet Médicale</h1></strong>
				</div>
				<!--end-logo-->
			</div>
			<!--end-header-->
		</div>
	<div class="clear" > </div>
			<!--start-image-slider---->
			        <div class="image-slider" >
						<!-- Slideshow 1 -->
					    <ul class="rslides" id="slider1">
					      <li><img src="img/slider-image1.jpg" alt=""></li>
					      <li><img src="img/slider-image2.jpg" alt=""></li>
					      <li><img src="img/slider-image1.jpg" alt=""></li>
					    </ul>
						 <!-- Slideshow 2 -->
					</div>
					<!--End-image-slider---->
		    <div class="clear"> </div>
		    <div class="content-grids">
		    	<div class="wrap">
		    	<div class="section group">
								
							
				<div class="listview_1_of_3 images_1_of_3">
					<div class="listimg listimg_1_of_2">
						  <img src="img/SEC.png">
					</div>
					<div class="text list_1_of_2">
						  <a href="login.php?role=secretaire"><h3>Secrétaire</h3></a>
				    </div>
				</div>	

				<div class="listview_1_of_3 images_1_of_3">
					<div class="listimg listimg_1_of_2">
						  <img src="img/DOCTORR.png">
					</div>
					<div class="text list_1_of_2">
						  <a href="login.php?role=medecin"><h3>Médecin</h3></a>
					</div>
				</div>


					<div class="listview_1_of_3 images_1_of_3">
					<div class="listimg listimg_1_of_2">
						  <img src="img/man.png">
					</div>
					<div class="text list_1_of_2">
						  <a href="login.php?role=admin"><h3>Admin</h3></a>
				     </div>
				</div>			
			</div>
		    </div>
		   </div>
		   <div class="wrap">
		   <div class="content-box">
		   <div class="section group">
				<div class="col_1_of_3 span_1_of_3 frist">
				
				</div>
				<div class="col_1_of_3 span_1_of_3 second">
					
				</div>
				<div class="col_1_of_3 span_1_of_3 frist">
					
					
				</div>
			</div>
		   </div>
		   </div>
		<!--end-wrap-->
	</body>
</html>