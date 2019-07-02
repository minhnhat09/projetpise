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
		       <h2>jusqu'à 30 €</h2>
		       <!--try-->
				  <div class="peinture-link">
				    <img src="img/301.jpg">
				    <p class="p1">Patterns</p>
				    <p class="p2">Anne Burk</p>
				    <p class="p3">25.00 €</p>
				      
				  </div>
				  <div class="peinture-link">
				    <img src="img/302.jpg">
				    <p class="p1">Étoile</p>
				    <p class="p2">Keanu Hoang</p>
				    <p class="p3">30.00 €</p>
				      
				  </div>
				  
			</div>
		  </section>
		 
		    </main>
		  </div>
		
		<!-- Pied de la page -->
		<?php include ("include/footer.php");?>