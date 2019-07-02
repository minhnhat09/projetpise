<?php include("include/fonction.php");
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
?>

	<!--Menu-->
	<?php include("include/header.php");?>
		<main>
		  <section class="peinture-links">
		    <div class="wrapper">
		       <h2>50 €-70 €</h2>
		       <!--try-->
				   <div class="peinture-link">
				    <img src="img/123.jpg">
				    <p class="p1">C'est toi</p>
				    <p class="p2">Florence Paris</p>
				    <p class="p3">70.00 €</p>  
				  </div>
				  <div class="peinture-link">
				    <img src="img/502.jpg">
				    <p class="p1">Unknown</p>
				    <p class="p2">Adam Smith</p>
				    <p class="p3">65.00 €</p>  
				  </div>
			      <div class="peinture-link">
				    <img src="img/503.jpg">
				    <p class="p1">Nature</p>
				    <p class="p2">Marie Rose</p>
				    <p class="p3">50.00 €</p>  
				  </div>
			   
			</div>
		  </section>
		 
		    </main>
		  </div>
		
		<!-- Pied de la page -->
		<?php include ("include/footer.php");?>