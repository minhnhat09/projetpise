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
		       <h2>70€-90€</h2>
		       <!--try-->
				   <div class="peinture-link">
				    <img src="601.jpg">
				    <p class="p1">Un Chat</p>
				    <p class="p2">Rene Asmus</p>
				    <p class="p3">€110.00</p>  
				  </div>
				  <div class="peinture-link">
				    <img src="602.jpg">
				    <p class="p1">Peace</p>
				    <p class="p2">Rene Asmus</p>
				    <p class="p3">€1500.00</p>  
				  </div>
			     
			   
			</div>
		  </section>
		 
		    </main>
		  </div>
		
		<!-- Pied de la page -->
		<?php include ("include/footer.php");?>