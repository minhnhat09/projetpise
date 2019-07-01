<?php
// On démarre la session AVANT d'écrire du code HTML
// afin de conserver l'information indiquant si c'est le premier accès
include 'PHP/BaseDonnees.php';
include 'PHP/Fonctions.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!DOCTYPE html>
<html>

<head>
  	<title>Bois Sur Ton Chemin - Accueil</title>
  	<meta name="language" content="fr">
  	<meta name="description" content="Ou trouver sa biere préférée à Paris ? C'est ici avec Bois Sur Ton Chemin">
  	<meta name="keywords" content="biere,bar,paris,sortir">
  	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.css">
  	<link rel="stylesheet" href="css/bootstrap-responsive.css">
  	
  	<link rel="stylesheet" href="css/style.css">
  	
  	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	
	<script>
		function resultat(texte) {
    		confirm(texte);
		}
	</script>
	
  	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  	<meta charset="UTF-8">
</head>

<body>
  	  	<header class="container-fluid">
  			<a href="index.php" class="mx-auto" ><img class="banniere" src="images/banniere3.png"></a>
	</header>
	
	<nav id="site-navigation" class="main-navigation sticky-top" role="navigation">
		<div class="container">
			<div class="menu-contact-container">
				<ul id="menu-contact" class="menu nav-menu">
					<li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-16">
						<a class="active" href="index.php">Accueil</a>
					</li>
					<li id="menu-item-17" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-17">
						<a href="Bieres.php">Bieres</a>
					</li>
					<li id="menu-item-18" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-18">
						<a href="Bars.php">Bars</a>
					</li>
					<li id="menu-item-92" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-92">
						<a href="Contact.php">Contact</a>
					</li>
					<?php
					if (isset($_SESSION['connecte']))
					{
						?>
							<div class="pseudo">
								<li id="menu-item-92" class="col2 menu-item menu-item-type-custom menu-item-object-custom menu-item-92">
									<a href="EspaceMembre.php"><?php echo $_SESSION['pseudo'] ?></a>
								</li>
								<li id="menu-item-92" class="col2 menu-item menu-item-type-custom menu-item-object-custom menu-item-92">
									<a href="Deconnexion.php?source=Bieres.php">Se deconnecter</a>
								</li>
							</div>
						<?php								
					}
					else
					{
						?>
							<div>
								<div class="pseudo">
									<li id="menu-item-92" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-92">
										<a href="LogIn.php?source=index.php">Se Connecter</a>
									</li>	
								</div>
							</div>
						<?php
					}
				?>
				</ul>
			</div>
		</div>	
	</nav>
  	<section>
  	
  	
  		<div class="container">			
			<h2>Bières</h2>
			<p>
				Ici sont répertoriées toutes nos bières. Donec id elit non mi porta gravida at eget metus. 
				Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa 
				justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
				
				</br>
				</br>
				<?php
					if (isset($_SESSION['droits']))
					{
						if($_SESSION['droits'] == 1)
						{
							?>
								Tu trouves qu'une bière exceptionnelle manque à la liste?
								<a href="AjouterBiere.php" class="btn btn-warning">
									J'ajoute une bière !
								</a>
							<?php			
						}
					}
				?>
			</p>		
			<hr>
					
		</div>
			
		<div class="container">
		<?php 
				$Tab = ListeTab("Bieres");
		
				foreach($Tab as $num => $UneBiere)
  				{
  				
  				$ID_Biere = $UneBiere['ID_Biere'];
  				$Nom = $UneBiere['Nom_Biere'];
    			$Presentation = $UneBiere['Presentation_Biere'];
    			$Degre = $UneBiere['Degre'];
    			$Image = $UneBiere['Image_Biere'];
    		
    		
  				if(($num % 3) == 0)
  				{
  					?>
  					<div class="row">
  					<?php	
  				}
  				
  				$TexteAfficher = $Presentation;
  				
  				$max_length = 150;

				if (strlen($TexteAfficher) > $max_length)
				{
    				$offset = ($max_length - 3) - strlen($TexteAfficher);
    				$TexteAfficher = substr($TexteAfficher, 0, strrpos($TexteAfficher, ' ', $offset)) . '...';
				}
  						
  				?>
        			<div class="col-lg-4 col-md-12 bieres">	
        				<div class="row">
        					<img class="img-bieres" src="<?php echo "$Image" ?>">
        					<div class="describiere" style="width: 70%; float:right">
        	 					<h3><?php echo "$Nom" ?></h3>
								<p><?php echo "$TexteAfficher" ?></p>
								<div class="ensavoirplus">
									
									<?php
         	 			
         	 				if (isset($_SESSION['connecte']))
         	 				{
         	 					$ListeFavori = ListeBieresFavorites($_SESSION['ID_Membre']);
         	 					$BiereFavorite = false;
         	 					
         	 					foreach($ListeFavori as $Biere)
         	 					{
         	 						if($Biere == $ID_Biere)
         	 						{
         	 							$BiereFavorite = true;
         	 						}
         	 					}
         	 					
         	 					if($BiereFavorite == true)
         	 					{
         	 						?>
         	 						<div class="col-6">
         	 							<a onclick="location.href='FavoriBiere.php?action=supprime&ID=<?php echo "$ID_Biere" ?>'">
         	 								<img class="likebiere" src="images/liked.png">
         	 							</a>
         	 							<div class="favoris">
         	 								Favoris !		
         	 							</div>
         	 						</div>
         	 						<?php
         	 					}
         	 					else
         	 					{
         	 					
         	 						?>
         	 						<div class="col-6">
         	 							<a onclick="location.href='FavoriBiere.php?action=ajout&ID=<?php echo "$ID_Biere" ?>'">
         	 								<img class="likebiere" src="images/like.png">
         	 							</a>
         	 							<div class="favoris">
         	 								Liker		
         	 							</div>
         	 						</div>
         	 						<?php
         	 					}
         	 					
         	 				}
         	 				else
         	 				{
         	 					?>
         	 						<div class="col-6">
         	 							<a onclick="location.href='LogIn.php'">
         	 								<img class="likebiere" src="images/like.png">
         	 							</a>
         	 							<div class="favoris">
         	 								Liker		
         	 							</div>
         	 						</div>
         	 					<?php	
         	 				}
         	 					
         	 			?>				
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-warning modalbiere" data-toggle="modal" data-target="#exampleModal<?php echo $num;?>">
  									Voir plus
									</button>
								</div>
							</div>
							
						</div>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal<?php echo $num;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  							<div class="modal-dialog" role="document">
    							<div class="modal-content">
      								<div class="modal-header">
        								<h5 class="modal-title" id="exampleModalLabel"><?php echo "$Nom" ?></h5>
        								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          									<span aria-hidden="true">&times;</span>
        								</button>
      								</div>
      								<div class="modal-body">
        								<img class="image-modal" src="<?php echo "$Image" ?>">
        								<div>
        									<p><?php echo "$Presentation" ?></p>
        									<hr>
        									<p>Degré : <?php echo "$Degre" ?></p>
        								</div>        									
      								</div>
      								<div class="modal-footer">
        								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        								<button type="button" class="btn btn-primary">Voir où cette bière est dispo</button>
      								</div>
    							</div>
  							</div>						
         	 			</div>
        			</div>      			
        			
        			
        	<?php 
        		if((($num -2)% 3) == 0)
  				{
  					?>
  					</div>
  					<?php	
  				}
        	
        	if(isset($_SESSION['Message'])) 
         	 {
         	 	$changement = $_SESSION['Message'];
         	 	?>
         	 		<script type="text/javascript">
       					var alerte = '<?PHP echo $changement; ?>';
                		reponse =  resultat(alerte);
        			</script>
         	 	<?php
         	 	unset($_SESSION['Message']);
         	 }
        	
        	} ?>

      	</div>
	</section>
	<footer>
		<div id="footer">
      		<div>
        		<p class="muted">Développé par <a href="https://www.linkedin.com/in/lucas-steedman-6a0404129/">Lucas Steedman</a> and <a href="http://www.universal-soundbank.com/pets-page3.htm">Paul Galons</a>.</p>
      		</div>
    	</div>
	</footer>
	</body>
</html>