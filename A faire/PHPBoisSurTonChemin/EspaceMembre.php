<?php
// On démarre la session AVANT d'écrire du code HTML
// afin de conserver l'information indiquant si c'est le premier accès
if (session_status() != PHP_SESSION_ACTIVE) session_start();
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
  	<title>Bois Sur Ton Chemin - Espace Membre</title>
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
								
								<?php
									if($_SESSION['droits'] == 1)
									{
									?>
										<a href="EspaceMembre.php"><?php echo $_SESSION['pseudo'] ?></a>
									<?php
									}
									else if ($_SESSION['droits'] == 2)
									{
									?>
										<a href="Admin.php"><?php echo $_SESSION['pseudo'] ?></a>
									<?php
									}
									?>
								</li>
								<li id="menu-item-92" class="col2 menu-item menu-item-type-custom menu-item-object-custom menu-item-92">
									<a href="Deconnexion.php?source=Bars.php">Se deconnecter</a>
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
  	
  	<?php	
  		if(isset ($_SESSION['droits']))
  			if($_SESSION['droits'] == 1)
  			{
  	?>
  	<div class="container">
      <div>
        <h2>Bienvenue dans votre espace, <?php echo $_SESSION['pseudo'] ?> </h2>
		<p>Cette page est la votre : Ici vous pouvez accéder à toutes vos adresses et toutes vos bières préférées. Vous pouvez aussi nous proposer des adresses ou des boissons à partir des pages Bars et Bières. N'hésitez pas !
		</p>
      </div>
      
      	<hr>
   	
    </div>
   		
    
    <div class="container">
		<fieldset class="encadreResultats scheduler-border">
    		<legend class="scheduler-border">Vos adresses préférées</legend>
    		
    		<?php 
    		
    		$BarsFavoris = ListeBarsFavoris($_SESSION['ID_Membre']);
    		$TousBars = ListeTab("Bars");
    		
    		$NumBarsFavoris=0;
    		
    		foreach($TousBars as $num => $UnBar)
  			{
  				foreach($BarsFavoris as $num => $UnBarFavori)
  				{
  					if($UnBarFavori == $UnBar['ID_Bar'])
  					{
  						$NumBarsFavoris++;
  						
  						$ID_bar = $UnBar['ID_Bar'] ;
      					$Nom = $UnBar['Nom_Bar'];
      					$Presentation = $UnBar['Presentation_Bar'];
      					$Image = $UnBar['Image_Bar'];

      					
      			$TexteAfficher = $Presentation;
        			
        		$max_length = 300;
    
    			if (strlen($TexteAfficher) > $max_length)
    			{
        			$offset = ($max_length - 3) - strlen($TexteAfficher);
        			$TexteAfficher = substr($TexteAfficher, 0, strrpos($TexteAfficher, ' ', $offset)) . '...';
    			}

  						
  				?>
  				<div class="resultats row">
  					<div class="col-4">
  						<img class="img-bars" src="<?php echo "$Image" ?>">
  					</div>
  					<div class="col-8">
        				<p>
    						<h3><?php echo "$Nom" ?></h3>					
    					</p>
    					<p><?php echo "$TexteAfficher" ?></p>
    						
    						<div class="row">
    							<div class="col-3 rating-block jumbotron notesindex jumbotron-note">
									<?php 
										$NoteBar = AVG_Note($ID_bar);
															
										$CompteTours = 0;
										$Note = $NoteBar[0]['AVG(Note)'];
						
										while($Note	>= 1)
										{
											$Note--;
											$CompteTours++;
											?>
												<img  class="bieresnote" src="images/BonneNote.png">
											<?php
										}
						
										$Reste = 5 - $CompteTours;
						
										while($Reste > 0)
										{
											$Reste--;
											?>
												<img  class="bieresnote" src="images/MauvaiseNote.png">
											<?php					
										}
										?>
								</div>
								<div class="btn-voirplus">
    								<a class="btn btn-warning btn-voirplus" onclick="location.href='Bar.php?ID=<?php echo "$ID_bar" ?>&action=null'">
										Voir plus
									</a>
								</div>
							</div>
    				</div>
        			
        			<?php
  					}
  				}
  			
  			}
			
  			if($NumBarsFavoris == 0)
  			{
  				echo "Aucun bar favori ! Il va falloir remédier à ça";
  			}
        		
        	?>
    		
    		
    	</fieldset>
	</div>
	<div class="container">
		<fieldset class="encadreResultats scheduler-border">
    		<legend class="scheduler-border">Vos bières préférées, à consommer avec modération évidemment</legend>
    			<div class="container">
    		<?php 		
    		
    			$BieresFavorites = ListeBieresFavorites($_SESSION['ID_Membre']);
				$TousBieres = ListeTab("Bieres");
				
				$NumBieresFavorites=0;
		
			foreach($TousBieres as $num => $UneBiere)
  			{
  				foreach($BieresFavorites as $num => $UneBiereFavorite)
  				{
  					if($UneBiereFavorite == $UneBiere['ID_Biere'])
  					{
  						$NumBieresFavorites++;
  				
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
        							<img style="width: 30%; float:left" class="img-bieres" src="<?php echo "$Image" ?>">
        							<div style="width: 70%; float:right">
        	 							<h3><?php echo "$Nom" ?></h3>
										<p><?php echo "$TexteAfficher" ?></p>
										<div class="ensavoirplus">
				
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
        			} 	
        		}        	
        	} 
        	
        	if($NumBieresFavorites == 0)
  			{
  				echo "Aucunes bieres favorites ! Il va falloir remédier à ça";
  			}
        	
        	?>

      	</div>
    		
    	</fieldset>
	</div>
	<?php
		}
		else if($_SESSION['droits'] == 2)
		{
		?>
			<div class="container">
        		<h2>Bienvenue dans votre espace de modération, <?php echo $_SESSION['pseudo'] ?> </h2>
      		</div>
      		
      		<div class="container">				
				<div class="dropdown col-4">
				<a href="EspaceMembre.php?action=bars" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
					Modérer les bars
				</a>
  					<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    					<li><a href="EspaceMembre.php?action=modifierbar">Modifier un bar</a></li>
    					<li><a href="EspaceMembre.php?action=creerbar">Créer bar</a></li>
    					<li><a href="EspaceMembre.php?action=supprimerbar">Supprimer bar</a></li>
  					</ul>
				</div>
				
				<div class="dropdown col-4">
				<a href="EspaceMembre.php?action=bars" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
					Modérer les bières
				</a>
  					<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    					<li><a href="EspaceMembre.php?action=modifierbieer">Modifier une bière</a></li>
    					<li><a href="EspaceMembre.php?action=creerbiere">Créer bière</a></li>
    					<li><a href="EspaceMembre.php?action=supprimerbiere">Supprimer une bière</a></li>
  					</ul>
				</div>
				
				<div class="dropdown col-4">
				<a href="EspaceMembre.php?action=bars" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
					Modérer les membres
				</a>
  					<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    					<li><a href="EspaceMembre.php?action=supprimermembre">Supprimer un membre</a></li>
    					<li><a href="EspaceMembre.php?action=supprimercommentaires">Supprimer des commentaires </a></li>
  					</ul>
				</div>
				
				</br>
				</br>
			</div>
      		
      		<?php
      			
      		
      		if(isset ($_GET['action']))
      		{
      			if($_GET['action'] == 'creerbar')
      			{
      			?>
      		<div class="container">
      		<fieldset class="encadreResultats scheduler-border">
      		 <legend class="scheduler-border">Nouveau bar</legend>
    		<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        		
        		<div class="row entree">
    				<div class="container">
						<div class=" jumbotron">
    						<h4>Adresse</h4>
    						<div class="row">
        						<div class="col-2">Numero</div>
        						<div class="col-2">Tye de voie</div>
        						<div class="col-2">Nom voie</div>
        						<div class="col-2">Complément</div>
        						<div class="col-2">Arrondissement</div>
      						</div>
							
							<div class="row">
        						<input class="col-2" id="Numero" type="text" name="Numero" placeholder="Numero">

      							<select class="choix col-2" name="TypeVoie" id="TypeVoie">
									<?php 

										$TabVoie = array();
							
										$TabVoie = ListeFiltres("Types_Voie","ID_Type","Voie");
									
							
										foreach($TabVoie as $num => $UneVoie)
										{
											$ID_Voie = $UneVoie['ID_Type'];
											$TypeVoie = $UneVoie['Voie'];
								
									?>
										<option value="<?php echo $ID_Voie;?>"><?php echo "$TypeVoie" ?></option> 
									<?php
								
										}
							
									?>
								</select>
							
								<input class="col-2" id="Numero" type="text" name="Numero" placeholder="Numero">
							
								<select class="choix col-2" name="Complement" id="Complement">
									<?php 

										$TabComplement = array();
							
										$TabComplement = ListeFiltres("Complements_adresse","ID_Complement","Complement");
									
							
										foreach($TabComplement as $num => $UnComplement)
										{
											$ID_Complement = $UnComplement['ID_Complement'];
											$Complement = $UnComplement['Complement'];
								
									?>
										<option value="<?php echo $ID_Complement;?>"><?php echo "$Complement" ?></option> 
									<?php
								
										}
							
									?>
								</select> 
							 
        						<select class="choix col-2" name="Arrondissement" id="Arrondissement" placeholder="Ier">
									<?php 

										$TabArrondissement = array();
							
										$TabArrondissement = ListeFiltres("Arrondissements","ID_Arrondissement", "Arrondissement");
									
							
										foreach($TabArrondissement as $num => $UnArrondissement)
										{
											$ID_Arrondissement = $UnArrondissement['ID_Arrondissement'];
											$Arrondissement = $UnArrondissement['Arrondissement'];
										
											$TexteAfficher = $Arrondissement;
  				
  											$max_length = 7;

											if (strlen($TexteAfficher) > $max_length)
											{
    											$TexteAfficher = substr($TexteAfficher, 0, strrpos($TexteAfficher, ' ', $offset));
											}
								
									?>
										<option value="<?php echo $ID_Arrondissement;?>"><?php echo "$TexteAfficher" ?></option> 
									<?php
								
										}
							
									?>
								</select> 
							</div>      		
        				</div>
					</div>        		
        		</div> 
        		
        		<div class="row entree">
        			<div class="col-3">
      					Dans quelle echelle de prix situez-vous cet établissement ?
      				</div>
        			<div class="col-3">
        				<select class="choix col-2" name="Prix" id="Prix" placeholder="Tous">
							<?php 
								$TabPrix = array();
							
								$TabPrix = ListeFiltres("Prix","ID_Prix","Prix");
							
								foreach($TabPrix as $num => $UnPrix)
								{
									$ID_Prix = $UnPrix['ID_Prix'];
									$Prix = $UnPrix['Prix'];
								
									?>
									<option value="<?php echo $ID_Prix;?>"><?php echo "$Prix" ?></option> 
									<?php
								
								}
							?>
                		</select>
        			</div>
        		</div> 
        		
        		<div class="row entree">
        			<div class="col-3">
      					Entrer le nom du bar à ajouter
      				</div>
        			<div class="col-3">
        				<input id="NomBar" type="text" name="NomBiere" placeholder="Nom">
        			</div>
        		</div>
        		
        		<div class="row entree">
        			<div class="col-3">
      					Entrer le site internet du bar
      				</div>
        			<div class="col-3">
        				<input id="SiteBar" type="text" name="SiteBar" placeholder="www.binouze.fr">
        			</div>
        		</div> 
        		
        		<div class="row entree">
        			<div class="col-3">
      					Quels sont les horaires d'ouverture du bar ? Jours d'ouvertures, horaires en semaine, en week end, que pouvez-vous nous dire ? 
      				</div>
        			<div class="col-3">
        				<textarea style="margin-bottom:10px" name="textarea" id="textarea" cols="40" rows="5" placeholder="Horaires du bar"></textarea>
        			</div>
        		</div>     	
        	
        		<div class="row entree">
        			<div class="col-3">
      					Un petit descriptif de l'établissement : Donnez-nous ici un bref descriptif du lieu : ambiance, cadre, déco...
      				</div>
        			<div class="col-3">
        				<textarea style="margin-bottom:10px" name="textarea" id="textarea" cols="40" rows="5" placeholder="Description du bar"></textarea>
        			</div>	       		
        		</div>
        		
        	<input name ="creation" type="submit" value="Entrer ce nouveau bar" class="col-3 ajout btn btn-warning btn-block">
    	</form>
    	</fieldset>
    		<?php	
    		}
    		
    		else if($_GET['action'] == 'modifierbar')
      			{
      			$Bars = ListeTab("Bars");
     			
     			?>
     		<div class="container">
      		<fieldset class="encadreResultats scheduler-border">
      		 <legend class="scheduler-border">Modification de bar</legend>
      		 
      		 <div>
      		 	<div class="col-6">Nom du bar à modifier :</div>
    			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
     			
      				<select class="choix" name="NomBarModif" id="NomBarModif">
      				<?php
      			
      			foreach($Bars as $num => $Bar)
				{
					$ID_Bar = $Bar['ID_Bar'];
					$NomBar = $Bar['Nom_Bar'];
								
				?>
					<option value="<?php echo $ID_Complement;?>"><?php echo "$NomBar" ?></option> 
				<?php
				}
				?>
					</select>
				<?php
      			
      			?>
      		</div>
        		
        		<div class="row entree">
    				<div class="container">
						<div class=" jumbotron">
    						<h4>Adresse</h4>
    						<div class="row">
        						<div class="col-2">Numero</div>
        						<div class="col-2">Tye de voie</div>
        						<div class="col-2">Nom voie</div>
        						<div class="col-2">Complément</div>
        						<div class="col-2">Arrondissement</div>
      						</div>
							
							<div class="row">
        						<input class="col-2" id="Numero" type="text" name="Numero" placeholder="Numero">

      							<select class="choix col-2" name="TypeVoie" id="TypeVoie">
									<?php 

										$TabVoie = array();
							
										$TabVoie = ListeFiltres("Types_Voie","ID_Type","Voie");
									
							
										foreach($TabVoie as $num => $UneVoie)
										{
											$ID_Voie = $UneVoie['ID_Type'];
											$TypeVoie = $UneVoie['Voie'];
								
									?>
										<option value="<?php echo $ID_Voie;?>"><?php echo "$TypeVoie" ?></option> 
									<?php
								
										}
							
									?>
								</select>
							
								<input class="col-2" id="Numero" type="text" name="Numero" placeholder="Numero">
							
								<select class="choix col-2" name="Complement" id="Complement">
									<?php 

										$TabComplement = array();
							
										$TabComplement = ListeFiltres("Complements_adresse","ID_Complement","Complement");
									
							
										foreach($TabComplement as $num => $UnComplement)
										{
											$ID_Complement = $UnComplement['ID_Complement'];
											$Complement = $UnComplement['Complement'];
								
									?>
										<option value="<?php echo $ID_Complement;?>"><?php echo "$Complement" ?></option> 
									<?php
								
										}
							
									?>
								</select> 
							 
        						<select class="choix col-2" name="Arrondissement" id="Arrondissement" placeholder="Ier">
									<?php 

										$TabArrondissement = array();
							
										$TabArrondissement = ListeFiltres("Arrondissements","ID_Arrondissement", "Arrondissement");
									
							
										foreach($TabArrondissement as $num => $UnArrondissement)
										{
											$ID_Arrondissement = $UnArrondissement['ID_Arrondissement'];
											$Arrondissement = $UnArrondissement['Arrondissement'];
										
											$TexteAfficher = $Arrondissement;
  				
  											$max_length = 7;

											if (strlen($TexteAfficher) > $max_length)
											{
    											$TexteAfficher = substr($TexteAfficher, 0, strrpos($TexteAfficher, ' ', $offset));
											}
								
									?>
										<option value="<?php echo $ID_Arrondissement;?>"><?php echo "$TexteAfficher" ?></option> 
									<?php
								
										}
							
									?>
								</select> 
							</div>      		
        				</div>
					</div>        		
        		</div> 
        		
        		<div class="row entree">
        			<div class="col-3">
      					Dans quelle echelle de prix situez-vous cet établissement ?
      				</div>
        			<div class="col-3">
        				<select class="choix col-2" name="Prix" id="Prix" placeholder="Tous">
							<?php 
								$TabPrix = array();
							
								$TabPrix = ListeFiltres("Prix","ID_Prix","Prix");
							
								foreach($TabPrix as $num => $UnPrix)
								{
									$ID_Prix = $UnPrix['ID_Prix'];
									$Prix = $UnPrix['Prix'];
								
									?>
									<option value="<?php echo $ID_Prix;?>"><?php echo "$Prix" ?></option> 
									<?php
								
								}
							?>
                		</select>
        			</div>
        		</div> 
        		
        		<div class="row entree">
        			<div class="col-3">
      					Entrer le nom du bar à ajouter
      				</div>
        			<div class="col-3">
        				<input id="NomBar" type="text" name="NomBiere" placeholder="Nom">
        			</div>
        		</div>
        		
        		<div class="row entree">
        			<div class="col-3">
      					Entrer le site internet du bar
      				</div>
        			<div class="col-3">
        				<input id="SiteBar" type="text" name="SiteBar" placeholder="www.binouze.fr">
        			</div>
        		</div> 
        		
        		<div class="row entree">
        			<div class="col-3">
      					Quels sont les horaires d'ouverture du bar ? Jours d'ouvertures, horaires en semaine, en week end, que pouvez-vous nous dire ? 
      				</div>
        			<div class="col-3">
        				<textarea style="margin-bottom:10px" name="textarea" id="textarea" cols="40" rows="5" placeholder="Horaires du bar"></textarea>
        			</div>
        		</div>     	
        	
        		<div class="row entree">
        			<div class="col-3">
      					Un petit descriptif de l'établissement : Donnez-nous ici un bref descriptif du lieu : ambiance, cadre, déco...
      				</div>
        			<div class="col-3">
        				<textarea style="margin-bottom:10px" name="textarea" id="textarea" cols="40" rows="5" placeholder="Description du bar"></textarea>
        			</div>	       		
        		</div>
        		
        	<input name ="creation" type="submit" value="Entrer ce nouveau bar" class="col-3 ajout btn btn-warning btn-block">
    	</form>
    	</fieldset>
    		<?php	
    		}
    		
    		else if($_GET['action'] == 'supprimerbar')
      			{
      			$Bars = ListeTab("Bars");
     			
     			?>
     		<div class="container">
      		<fieldset class="encadreResultats scheduler-border">
      		 <legend class="scheduler-border">Suppression de bar</legend>
      		 
      		 <div>
      		 	<div class="col-6">Nom du bar à modifier :</div>
    			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
     			
      				<select class="choix" name="NomBarModif" id="NomBarModif">
      				<?php
      			
      			foreach($Bars as $num => $Bar)
				{
					$ID_Bar = $Bar['ID_Bar'];
					$NomBar = $Bar['Nom_Bar'];
								
				?>
					<option value="<?php echo $ID_Complement;?>"><?php echo "$NomBar" ?></option> 
				<?php
				}
				?>
					</select>
					
					<a href="#" class="btn btn-warning">
						Supprimer
					</a>
				</fieldset>
				<?php
				}
    		
			
			}
			
		}
	?>

	</section>
	<footer>
		<div id="footer">
      		<div>
        		<p class="muted">Développé par <a href="https://www.linkedin.com/in/lucas-steedman-6a0404129/">Lucas Steedman</a> and <a href="https://www.linkedin.com/in/paul-galons-022b73158/">Paul Galons</a>.</p>
      		</div>
    	</div>
	</footer>
	</body>
</html>