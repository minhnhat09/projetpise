<?php include("include/fonction.php");
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
?>

	<!--Menu-->
	<?php include("include/header.php");?>
		<main>
		  <section class="artiste-links">
		    <div class="wrapper">
		       <h2>NOS ARTISTES</h2>
		   
				  <div class="artiste-link">
				  <a href="#modalWindow"><img src="img/a1.jpg"> </a>
				    <p class="p1">Marie Rose</p>
				    <p class="p2">français</p>
				    <p class="p3">4 œuvres</p>
				  </div>
					<div id="container-a">
					
					</div>
 						
					<div id="modalWindow">
						<div>
							<a href="#" class="model-close">&times;</a><br>
							<h3>Marie Rose</h3>
							<p>
							    <img src="img/a1.jpg">
								Née en France à Paris, Marie Rose passe sa jeunesse à Toulouse. Après le BAC, elle part en Allemagne suivre les cours de l'École supérieure d'état de photographie de Cologne pendant 3 ans.

								Après un bref séjour de formation à Paris comme assistant photographe. 
								Elle s'installe à Barcelone en tant que photographe de natures mortes publicitaire et travaille de longues années avec des agences de pub internationales : Saatchi, McCann Ericson, Walter Thompson, Publicis, TBWA Etc…
								<br><br>
								
							</p>
						</div>
					</div>

					

				   <div class="artiste-link">
				    <a href="#modalWindow1"><img src="img/a2.jpg"> </a>
				    <p class="p1">Rene Asmus</p>
				    <p class="p2">français</p>
				    <p class="p3">2 œuvres</p>  
				  </div>
			      <div id="container-a">
					
					</div>
 						
					<div id="modalWindow1">
						<div>
							<a href="#" class="model-close">&times;</a><br>
							<h3>Rene Asmus</h3>
							<p>
							    <img src="img/a2.jpg">
								Née en France à Paris. Après le college, elle part en asie suivre les cours de l'École supérieure d'état de dessin de Beijing pendant 5 ans.
								Après un bref séjour de formation à Paris comme peintre. 
								Elle s'installe à Toulouse en tant que peinture de natures mortes publicitaire et travaille de longues années avec des agences de pub internationales.
								
							</p>
						</div>
					</div>
			         <div class="artiste-link">
				    <a href="#modalWindow2"><img src="img/a3.jpg"> </a>
				    <p class="p1">Florence Paris</p>
				    <p class="p2">français</p>
				    <p class="p3">4 œuvres</p>   
				  </div>
			      <div id="container-a">
					
					</div>
 						
					<div id="modalWindow2">
						<div>
							<a href="#" class="model-close">&times;</a><br>
							<h3>Florence Paris</h3>
							<p>
							    <img src="img/a3.jpg">
								Née en France à Paris. Florence Paris est une artiste peintre formée à l'école des Beaux-Arts d'Orléans. 
								Initiée à la décoration d'intérieur dans une école parisienne, elle a également enrichi ses connaissances techniques à Vin dans un centre de formation de peintres en décors. 
								Anciennement en auto-entreprise, elle a quitté les chantiers pour se consacrer exclusivement à la peinture.
								
							</p>
						</div>
					</div>
				   <div class="artiste-link"> 
				   <a href="#modalWindow3">  <img src="img/a6.jpg"></a>
				   <p class="p1">Adam Smith</p>
				    <p class="p2">anglais</p>
				    <p class="p3">3 œuvres</p>  
				  </div>
				  <div id="container-a">
					
					</div>
 						
					<div id="modalWindow3">
						<div>
							<a href="#" class="model-close">&times;</a><br>
							<h3>Adam Smith</h3>
							<p>
							    <img src="img/a6.jpg">
								Adam Smith travaille entre la France et l'Angleterre, pays de résidence de sa compagne. 
								Ancré dans la culture hip-hop et particulièrement le graffiti, qu'il pratique encore légalement, la bombe de peinture et l'acrylique sur toile restent ses médiums de prédilection.
								
								
							</p>
						</div>
					</div>
			  
				  <div class="artiste-link">
				     <a href="#modalWindow4"><img src="img/a5.jpg"> </a>
				    <p class="p1">Mike Dupont</p>
				    <p class="p2">français</p>
				    <p class="p3">3 œuvres</p>  
				  </div>
			      <div id="container-a">
					
					</div>
 						
					<div id="modalWindow4">
						<div>
							<a href="#" class="model-close">&times;</a><br>
							<h3>Mike Dupont</h3>
							<p>
							    <img src="img/a5.jpg">
								Mike Dupont, dit MDT, est ferronnier d’art sculpteur. 
								Passionné par les volumes et le travail des métaux, il marie dans ses réalisations la sculpture et la forge.
								
							</p>
						</div>
					</div>
			  
				 <div class="artiste-link">
				    <a href="#modalWindow5"> <img src="img/a4.jpg"> </a>
				    <p class="p1">Mali Maeder </p>
				    <p class="p2">américain</p>
				    <p class="p3">4 œuvres</p> 
				  </div>
				   <div id="container-a">
					
					</div>
 						
					<div id="modalWindow5">
						<div>
							<a href="#" class="model-close">&times;</a><br>
							<h3>Mali Maeder</h3>
							<p>
							    <img src="img/a4.jpg">
								Mali Maeder né à New York peint depuis une vingtaine d’années. Il vit à Paris. Il étudie à ses débuts l’aquarelle et la technique de la peinture à l’huile à l’ancienne. 
								Il peint désormais essentiellement à l'encaustique depuis environ 5 ans et plus récemment à l'encre et acrylique sur plexiglas . 
								Ses thèmes de prédilection sont : la foule, les paysages urbains, les scènes de rue, les paysages marins, les portraits.
								
							</p>
						</div>
					</div>
			  
			</div>
		  </section>
		 
		    </main>
		  </div>
		<!-- Pied de la page -->
		<?php include ("include/footer.php");?>