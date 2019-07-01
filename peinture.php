<?php
    // Appel de la fonction de connexion à la BDD
include("include/fonction.php");   
include("include/header.php");

?>

		<main>
		  <section class="peinture-links">
		    <div class="wrapper">
		       <h2>Notre sélection de Peintures</h2>
		       <!--try-->
		       <div class="peinture-drop">
				   <button class="dropdown">Tier par</button>
					<div class="drop-menu">
					  <li><a href="#">Prix croissant</a> </li>
					  <li><a href="#">Prix décroissant</a> </li>
					  <li><a href="#">Le plus récent</a> </li>
					</div>
				</div>
				<?php
				//Appel fonction ListeParCategorie pour récupérer les données dans BDD
				$Tab = ListeParCategorie("oeuvre","Cat_Oeuvre","peinture");
				
				foreach($Tab as $num => $UneOeuvre)
  				{
  				
  				$ID_Biere = $UneOeuvre['ID_Oeuvre'];
  				$Nom = $UneOeuvre['Nom_Oeuvre'];
    			$Categorie = $UneOeuvre['Cat_Oeuvre'];
    			$Taille = $UneOeuvre['Taille'];
				$Prix = $UneOeuvre['Prix'];
    			$Artiste = $UneOeuvre['Artiste'];
    			$Image = $UneOeuvre['Img_Oeuvre'];				
				
				?>
		       <a href="peinture1.html">
				  <div class="peinture-link">
				    <img src="<?php echo "$Image" ?>">
				    <p class="p1"><?php echo "$Nom" ?></p>
					<p class="p1"><?php echo "$Prix" ?> €</p>
				    <p class="p2"><?php echo "$Categorie" ?> </p>
				    <p class="p3"><?php echo "$Artiste" ?></p>  
				  </div>
			   </a>
			  <?php
				}
				?>
				
			</div>
		  </section>
		 
		    </main>
		  </div>
		</div>
		<!-- Pied de la page -->
		<?php
			include ("include/footer.php");
		?>
       </body>
    </html>