<?php
    // Appel de la fonction de connexion à la BDD
include("include/fonction.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
	<!--Menu-->
	<?php   
		include("include/header.php");
	?>

		<main>
		  <section class="peinture-links">
		    <div class="wrapper">
		       <h2>Toutes les oeuvres</h2>
			   <h3>Critères de recherche</h3>
					<div class="row">
					 <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"><!--afficher sur même page résultat de filtre-->
					 <div class="col-lg-2 col-md-6">
        			<td>
        				<div>Categories</div>
						<select class="choix" name="Cat_Oeuvre" id="Cat_Oeuvre" placeholder="Toutes">
							<option value="Toutes">Toutes</option>
							</select>
       				</td>
					</div>
					<div class="col-lg-2 col-md-6">
        			<td>
        				<div>Thèmes</div>
             			<select class="choix" name="PaysOrigine" id="PaysOrigine" placeholder="Tous">
							<option value="Tous">Tous</option>
						</select>
					</td>
					</div>
					</div>
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
				//Appel fonction ListeTab pour récupérer les données dans BDD
				$Tab = ListeTab("oeuvre","*");
				$Tab=$Tab->fetchAll();
				foreach($Tab as $num => $UneOeuvre)
  				{
  				
  				$ID_Oeuvre = $UneOeuvre['ID_Oeuvre'];
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
