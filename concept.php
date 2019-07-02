<?php include("include/fonction.php");
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
?>

	<!--Menu-->
	<?php include("include/header.php");?>
		<main>
		 <section class="concept-banner">
		   
			 <h2>Le Concept</h2>
			  
			 
		 </section>
		 <div class="wrapper">
		     <section class="concept-links">
				  
					  <div class="concept-linkbox-squre1">
						<img src="img/co3.jpg">
						
					  </div>
					  
					  <div class="concept-linkbox-squre2">
						<h3>LE FONCTIONNEMENT</h3><br>
						<p>T&T est un concept inédit de galerie d’art contemporain.
						   La plateforme numérique propose plus de 20 oeuvres dans l’univers de l’abstraction, parmi un panel d'une centaine artistes rigoureusement sélectionnés par nous.</p><br> 
						<p> Une proposition différente qui donne un nouveau souffle aux galeries traditionnelles souvent perçues par les amateurs d’art comme trop intimidantes.</p>
					  </div>
					  <div class=".concept-linkbox-squre3">
						<img src="img/co4.jpg">
						
					  </div>
					  
					  <div class="concept-linkbox-squre2">
						<h3>Découvrir des artistes de talent</h3>
						<p>L’équipe de T&T est en perpétuelle prospection de nouveaux artistes.</p><br>
						<p> Nos têtes chercheuses sont sur le qui-vive dans les salons, les foires, les expositions, mais aussi sur le Web, pour dénicher des talents pour les accompagner et les faire connaître. Peintures, photographies, sculptures,....</p> 
					  </div>
					  
				</section>
				
				</main>
		<!-- Pied de la page -->
		<?php include ("include/footer.php");?>