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
		       <h2>30€-50€</h2>
		       <!--try-->
				  <div class="peinture-link">
				    <img src="img/1.jpg">
				    <p class="p1">Dix-huit avril</p>
				    <p class="p2">Anne Baudequin</p>
				    <p class="p3">35.00 €</p>
				      
				  </div>
				  <div class="peinture-link">
				    <img src="img/color.jpg">
				    <p class="p1">Entre toi et moi</p>
				    <p class="p2">Nicola Paris</p>
				    <p class="p3">45.00 €</p>  
				  </div>
			   
			</div>
		  </section>
		 
		    </main>
		  </div>
		
				<footer id="footer">
				      <ul class="footer-links-tt">
						<li><p>À PROPOS DE T&T</P></li>
						<li><a href="concept.html">Le concept</a> </li>
						<li><a href="artist.html">Artistes</a> </li>
						
						
						 
					  </ul> 
					  <ul class="footer-links-main">
						<li><p>ENTRE VOUS ET NOUS</P></li>
						<li><a href="retour.html">Livraison et remboursement</a> </li>
						<li><a href="paiement.html">Paiement</a> </li> 
					  </ul> 
					  
					  <ul class="footer-links-ouvre">
						<li><p>LES OEUVRES</P></li>
						<li><a href="peinture.html">Peinture</a> </li>
						<li><a href="sculpture.html">Sculpture</a> </li>
						<li><a href="photography.html">Photographies</a> </li>
						
					  </ul> 
		   
					  <div class="footer-sm">
					   <a href=" ">
						<img src="img/facebook.png" alt="facebook icon">
					   </a>
					   <a href=" ">
						<img src="img/instagram.png" alt="instagram icon">
					   </a>
					   <a href=" ">
						<img src="img/linkedin.png" alt="linkedin icon">
					   </a>
					   </div>	 
				</footer>
       </body>
    </html>