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
		       <h2>Plus de 150 €</h2>
		       <!--try-->
				   <div class="peinture-link">
				    <img src="img/151.jpg">
				    <p class="p1">Amour</p>
				    <p class="p2">Mali Maeder</p>
				    <p class="p3">200.00 €</p>  
				  </div>
				  <div class="peinture-link">
				    <img src="img/152.jpg">
				    <p class="p1">Chez Moi</p>
				    <p class="p2">Marie Rose</p>
				    <p class="p3">450.00 €</p>  
				  </div>
			      <div class="peinture-link">
				    <img src="img/153.jpg">
				    <p class="p1">Entre toi et moi</p>
				    <p class="p2">Mike Dupont</p>
				    <p class="p3">680.00 €</p>  
				  </div>
			   
			</div>
		  </section>
		 
		    </main>
		  </div>
		
		<!-- Pied de la page -->
		<?php include ("include/footer.php");?>