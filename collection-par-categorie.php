<?php
    // Appel de la fonction de connexion à la BDD
include("include/fonction.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>
<!DOCTYPE html>
<html>
	<!--Menu-->
	<?php   
		include("include/header.php");
	?>

		<main>
		  <section class="peinture-links">
		    <div class="wrapper">
		       
			  
		       
		       <div class="peinture-drop">
				   <button class="dropdown">Tier par</button>
					<div class="drop-menu">
					  <li><a href="#">Prix croissant</a> </li>
					  <li><a href="#">Prix décroissant</a> </li>
					  <li><a href="#">Le plus récent</a> </li>
					</div>
				</div>

				<?php
				//--------------------------------- TRAITEMENTS PHP ---------------------------------//
				//--- DES CATEGORIES ---//
				//Appel fonction ListeTab pour récupérer les données dans BDD
				$Tab = ListeTab("oeuvre","DISTINCT Cat_Oeuvre");
				
				while($dataCategorie = $Tab->fetch())
{
	$contenu = "<a href='?categorie=". $dataCategorie['Cat_Oeuvre'] . "'>" . $dataCategorie['Cat_Oeuvre'] . "</a>";
}
				//--- AFFICHAGE DES OEUVRES ---//
				if(isset($_GET['categorie']))
{				
				$dataOeuvre=ListeParID("oeuvre","Cat_Oeuvre",$_GET['categorie']);
				
				foreach($dataOeuvre as $num => $UneOeuvre)
  				{
  				
				?>
		       <a href="fiche-oeuvre.php?ID_Oeuvre=<?php echo $UneOeuvre['ID_Oeuvre'] ?>">
				  <div class="peinture-link">
				    <img src="<?php echo $UneOeuvre['Img_Oeuvre']?>">
				    <p class="p1"><?php echo $UneOeuvre['Nom_Oeuvre'] ?></p>
					<p class="p1"><?php echo $UneOeuvre['Prix'] ?> €</p>
 
				  </div>
			   </a>
			  <?php
				}
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