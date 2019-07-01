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
  <section>

			<div class="container">		
        			<h2>Bienvenue dans votre espace de modération, <?php echo $_SESSION['pseudo'] ?> </h2>      		
      		<div class="container">	
      			<div class="row">			
				<div class="dropdown col-3">
				<a href="Admin.php?action=bars" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
					Modérer les bars
				</a>
  					<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    					<li><a href="Admin.php?action=modifierbar">Modifier un bar</a></li>
    					<li><a href="Admin.php?action=creerbar">Créer bar</a></li>
    					<li><a href="Admin.php?action=supprimerbar">Supprimer bar</a></li>
  					</ul>
				</div>
				
				<div class="dropdown col-3">
				<a href="Admin.php?action=bars" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
					Modérer les bières
				</a>
  					<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    					<li><a href="Admin.php?action=modifierbiere">Modifier une bière</a></li>
    					<li><a href="Admin.php?action=creerbiere">Créer bière</a></li>
    					<li><a href="Admin.php?action=supprimerbiere">Supprimer une bière</a></li>
  					</ul>
				</div>
				<div class="dropdown col-3">
				<a href="Admin.php?action=bars" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
					Modérer les membres
				</a>
  					<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    					<li><a href="Admin.php?action=supprimermembre">Supprimer un membre</a></li>
    					<li><a href="Admin.php?action=modifierdroits">Modifier droits membre</a></li>
  					</ul>
				</div>
				
				</br>
				</br>
				</div>
			</div>
			
			<?php
			
			if(isset ($_GET['action']))
      		{
      			if($_GET['action'] == 'creerbar')
      			{
      				?>
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
							
								<input class="col-2" id="Numero" type="text" name="NomVoie" placeholder="NomVoie">
							
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
        				<input id="NomBar" type="text" name="NomBar" placeholder="Nom">
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
      					Entrer le numéro de téléphone
      				</div>
        			<div class="col-3">
        				<input id="NumTel" type="text" name="NumTel" placeholder="www.binouze.fr">
        			</div>
        		</div> 
        		
        		<div class="row entree">
        			<div class="col-3">
      					Quels sont les horaires d'ouverture du bar ? Jours d'ouvertures, horaires en semaine, en week end, que pouvez-vous nous dire ? 
      				</div>
        			<div class="col-3">
        				<textarea style="margin-bottom:10px" name="horaires" id="textarea" cols="40" rows="5" placeholder="Horaires du bar"></textarea>
        			</div>
        		</div>     	
        	
        		<div class="row entree">
        			<div class="col-3">
      					Un petit descriptif de l'établissement : Donnez-nous ici un bref descriptif du lieu : ambiance, cadre, déco...
      				</div>
        			<div class="col-3">
        				<textarea style="margin-bottom:10px" name="description" id="textarea" cols="40" rows="5" placeholder="Description du bar"></textarea>
        			</div>	       		
        		</div>
        		
        	<input name ="creationbar" type="submit" value="Entrer ce nouveau bar" class="col-3 ajout btn btn-warning btn-block">
    	</form>
    			<?php
      			}
      			
      			else if($_GET['action'] == 'modifierbar')
      			{
      				?>
     				<div class=" jumbotron container"> 
     					<div class="row"> 		 
      		 				<div class="col-3">
      		 					Bar à modifier :
      		 				</div>
      		 				<div class="col-3">
    							<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">   			
      							<select class="choix" name="NomBarModif" id="NomBarModif">
      							<?php
      						
      							$Bars = ListeTab("Bars");
      			
      							foreach($Bars as $num => $Bar)
								{
									$ID_Bar = $Bar['ID_Bar'];
									$NomBar = $Bar['Nom_Bar'];
								
								?>
									<option value="<?php echo "$ID_Bar"?>"><?php echo "$NomBar" ?></option> 
								<?php
								}
								?>
								</select>
							</div>

						</div>						
     					<div class="row"> 		 
      		 				<div class="col-3">
      		 					Colonne à modifier :
      		 				</div>
      		 				<div class="col-3"> 			
      							<select class="choix" name="NomColonneModif" id="NomColonneModif">
      							<?php
      							
      							$Table ="'Bars'";
      						
      							$NomColonnes = SELECT_COL_ADMIN($Table) ; // controoll pour voir si la requete est ok
      			
      							foreach($NomColonnes as $num => $Colonne)
								{
									if(($num > 0) && ($num < 14))
									{
										$NomColonne = $Colonne['COLUMN_NAME'];																
									?>
										<option value="<?php echo "$NomColonne"?>"><?php echo "$NomColonne" ?></option> 
									<?php
									}
								}
								?>
								</select>
							</div>
								<input name ="barmodification" type="submit" value="Modifier" class="col-2 btn btn-warning btn-block">
						</div>
						</form>
      			<?php
					
      			}
      			
      			else if($_GET['action'] == 'supprimerbar')
      			{
      			?>
      				<div class=" jumbotron container"> 
     					<div class="row"> 		 
      		 				<div class="col-3">
      		 					Bar à supprimer :
      		 				</div>
      		 				<div class="col-3">
    							<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">   			
      							<select class="choix" name="NomBarModif" id="NomBarModif">
      							<?php
      						
      							$Bars = ListeTab("Bars");
      			
      							foreach($Bars as $num => $Bar)
								{
									$ID_Bar = $Bar['ID_Bar'];
									$NomBar = $Bar['Nom_Bar'];
								
								?>
									<option value="<?php echo "$ID_Bar"?>"><?php echo "$NomBar" ?></option> 
								<?php
								}
								?>
								</select>	
							</div>
						<div>
						<input name ="barsuppression" type="submit" value="Supprimer" class="btn btn-warning btn-block">
					</div>
				<?php	
											
      			}
      			
		
      			if($_GET['action'] == 'creerbiere')
      			{
      				?>
      			<div class="container">
    				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    					<div class="row entree">
        					<div class="col-3">
      							Entrer le nom de la bière à ajouter
      						</div>
        					<div class="col-3">
        						<input id="NomBiere" type="text" name="NomBiere" placeholder="Nom">
        					</div>
        				</div>
      					<div class="row entree">
      						<div class="col-3">
      							Quelle est sa robe ?
      						</div>
        					<div class="col-3">
        					<td>
							<select class="choix" name="TypesBieres" id="TypesBieres">
							<?php
								$TabRobes = array();
								
								$TabRobes = ListeFiltres("Robes","ID_Robe","Robe"); 
								
								foreach($TabRobes as $num => $UneRobe)
								{
									$ID_Robe = $UneRobe['ID_Robe'];
									$Robe = $UneRobe['Robe'];
								
									?>
									<option value="<?php echo $ID_Robe;?>"><?php echo "$Robe" ?></option>  // il faut voir ce qu'on met dans value puisque c'est ce qu'on récupère en post.
									<?php
								
								}
							
							?>
                			</select>
       						</td>
        				</div>
        			</div>
        		<div class="row entree">
        		<div class="col-3">
      				Son pays d'origine
      			</div>
        		<div class="col-3">
        			<td>
						<select class="choix" name="OrigineBiere" id="OrigineBiere">
							<?php
								$TabOrigines = array();
								
								$TabOrigines = ListeFiltres("Origines_Bieres","ID_Origine","Origine"); 
								
								foreach($TabOrigines as $num => $UneOrigine)
								{
									$ID_Robe = $UneOrigine['ID_Origine'];
									$Robe = $UneOrigine['Origine'];
								
									?>
									<option value="<?php echo $ID_Robe;?>"><?php echo "$Robe" ?></option>  // il faut voir ce qu'on met dans value puisque c'est ce qu'on récupère en post.
									<?php
								
								}
							
							?>
                		</select>
       				</td>
        		</div>
        	</div>
        	<div class="row entree">
        		<div class="col-3">
      				Le degré d'alcool
      			</div>
        		<div class="col-3">
        			<input id="Degre" name="Degre" type="text" placeholder="Degre">
        		</div>
        	</div>
        	<div class="row entree">
        		<div class="col-3">
      				Un petit descriptif
      			</div>
        		<div class="col-3">
        			<textarea style="margin-bottom:10px" name="description" id="description" cols="40" rows="8" placeholder="Texte qui servira de description sur le site"></textarea>
        		</div>       		
        	</div>
        	<input name ="creationbiere" type="submit" value="Entrer cette nouvelle bière" class="col-3 ajout btn btn-warning btn-block">
    	</form>
    				<?php   
      			}
      			
      			else if($_GET['action'] == 'modifierbiere')
      			{    				
      				?>
     				<div class=" jumbotron container"> 
     					<div class="row"> 		 
      		 				<div class="col-3">
      		 					Biere à modifier :
      		 				</div>
      		 				<div class="col-3">
    							<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">   			
      							<select class="choix" name="NomBiereModif" id="NomBiereModif">
      							<?php
      						
      							$Bieres = ListeTab("Bieres");
      			
      							foreach($Bieres as $num => $Biere)
								{
									$ID_Biere = $Biere['ID_Biere'];
									$NomBiere = $Biere['Nom_Biere'];
								
								?>
									<option value="<?php echo "$ID_Biere"?>"><?php echo "$NomBiere" ?></option> 
								<?php
								}
								?>
								</select>
							</div>

						</div>						
     					<div class="row"> 		 
      		 				<div class="col-3">
      		 					Colonne à modifier :
      		 				</div>
      		 				<div class="col-3"> 			
      							<select class="choix" name="NomColonneModif" id="NomColonneModif">
      							<?php
      							
      							$Table ="'Bieres'";
      						
      							$NomColonnes = SELECT_COL_ADMIN($Table) ; // controoll pour voir si la requete est ok
      			
      							foreach($NomColonnes as $num => $Colonne)
								{
									if(($num > 0) && ($num < 6))
									{
										$NomColonne = $Colonne['COLUMN_NAME'];																
									?>
										<option value="<?php echo "$NomColonne"?>"><?php echo "$NomColonne" ?></option> 
									<?php
									}
								}
								?>
								</select>
							</div>
								<input name ="bieremodification" type="submit" value="Modifier" class="col-2 btn btn-warning btn-block">
						</div>
						</form>
      			<?php  			
      			}
      			
      			else if($_GET['action'] == 'supprimerbiere')
      			{
      				?>
      				<div class=" jumbotron container"> 
     					<div class="row"> 		 
      		 				<div class="col-3">
      		 					Biere à supprimer :
      		 				</div>
      		 				<div class="col-3">
    							<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">   			
      							<select class="choix" name="NomBiereModif" id="NomBiereModif">
      							<?php
      						
      							$Bieres = ListeTab("Bieres");
      			
      							foreach($Bieres as $num => $Biere)
								{
									$ID_Biere = $Biere['ID_Biere'];
									$NomBiere = $Biere['Nom_Biere'];
								
								?>
									<option value="<?php echo "$ID_Biere"?>"><?php echo "$NomBiere" ?></option> 
								<?php
								}
								?>
								</select>	
							</div>
						<div>
						<input name ="bieresuppression" type="submit" value="Supprimer" class="btn btn-warning btn-block">
					</div>
				<?php
				
      			}
      			
      			if($_GET['action'] == 'supprimermembre')
      			{
      				?>
      				<div class=" jumbotron container"> 
     					<div class="row"> 		 
      		 				<div class="col-3">
      		 					Membre à supprimer :
      		 				</div>
      		 				<div class="col-3">
    							<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">   			
      							<select class="choix" name="NomMembreModif" id="NomMembreModif">
      							<?php
      						
      							$Membres = ListeTab("Membres");
      			
      							foreach($Membres as $num => $Membre)
								{
									$ID_Membre = $Membre['ID_Membre'];
									$PseudoMembre = $Membre['Pseudo_Membre'];								
								?>
									<option value="<?php echo "$ID_Membre"?>"><?php echo "$PseudoMembre" ?></option> 
								<?php
								}
								?>
								</select>	
							</div>
						<div>
						<input name ="membresuppression" type="submit" value="Supprimer" class="btn btn-warning btn-block">
					</div>
				<?php
      			}
      			
      			else if($_GET['action'] == 'modifierdroits')
      			{
      				
      			}
      			
      			
			}
			
			
			if (!empty($_POST['barmodification']))
      		{	
      			$ID_Bar = $_POST['NomBarModif'];
      			$Nom_Colonne = $_POST['NomColonneModif'];
      			
				$_SESSION['ID_Bar'] = $_POST['NomBarModif'];
				$_SESSION['Nom_Colonne'] = $_POST['NomColonneModif'];
      			
      			?>
      			
      			<div class="container">
    				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

						<?php 
					
						if($Nom_Colonne == "Nom_Bar")
						{
						?>
							<div class="row entree">
        						<div class="col-3">
      								Nouveau nom du bar :
      							</div>
        						<div class="col-3">
        							<input id="NomBar" type="text" name="NomModif" placeholder="Nouveau nom">
        						</div>  
						<?php
						
						}
						
						if($Nom_Colonne == "Num_Tel")
						{
						?>
							<div class="row entree">
        						<div class="col-3">
      								Nouveau numéro de téléphone:
      							</div>
        						<div class="col-3">
        							<input id="NumTel" type="text" name="NomModif" placeholder="Nouveau numéro">
        						</div>       						
						<?php
						
						}
						
						if($Nom_Colonne == "Num_Voie")
						{
						?>
							<div class="row entree">
        						<div class="col-3">
      								Nouveau numéro de rue :
      							</div>
        						<div class="col-3">
        							<input id="NumVoie" type="text" name="NomModif" placeholder="Nouvelle adresse">
        						</div>       						
						<?php
						
						}	
						
						if($Nom_Colonne == "Type_Voie_fk")
						{
						?>
							<div class="row entree">
        						<select class="choix col-2" name="NomModif" id="TypeVoie">
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
						<?php
						
						}	
						
						if($Nom_Colonne == "Complement_adresse_fk")
						{
						?>
							<div class="row entree">
        						<select class="choix col-2" name="NomModif" id="Complement">
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
						<?php
						
						}	
						
						if($Nom_Colonne == "Nom_Voie")
						{
						?>
							<div class="row entree">
        						<div class="col-3">
      								Nom de la voie :
      							</div>
        						<div class="col-3">
        							<input id="NomVoie" type="text" name="NomModif" placeholder="Nom de la voie">
        						</div>       						
						<?php
						
						}
						
						if($Nom_Colonne == "ID_Arrondissement_fk")
						{
						?>
							<div class="row entree">
							<select class="choix col-2" name="NomModif" id="Arrondissement" placeholder="Ier">
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
						<?php
						
						}
						
						if($Nom_Colonne == "ID_Ville_fk")
						{
							echo "Notre site ne propose à l'heure actuelle que des adresses sur Paris";   						
						}
						
						if($Nom_Colonne == "Site_Bar")
						{
						?>
							<div class="row entree">
        						<div class="col-3">
      								Site du bar :
      							</div>
        						<div class="col-3">
        							<input id="NomVoie" type="text" name="NomVoie" placeholder="">
        						</div>       						
						<?php
						
						}
						
						if($Nom_Colonne == "Prix_fk")
						{
						?>
							<div class="row entree">
        						<select class="choix col-2" name="NomModif" id="Prix" placeholder="Tous">
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
						<?php
						
						}
						
						if($Nom_Colonne == "Horaires_Bar")
						{
						?>
							<div class="row entree">
        						<div class="col-6">
        							<textarea style="margin-bottom:10px" name="NomModif" id="NomModif" cols="40" rows="5" placeholder=""></textarea>
        						</div>    						
						<?php
						
						}
						
						if($Nom_Colonne == "Horaires_HH")
						{
						?>
							<div class="row entree">
        						<div class="col-6">
        							<textarea style="margin-bottom:10px" name="NomModif" id="NomModif" cols="40" rows="5" placeholder=""></textarea>
        						</div>    						
						<?php
						
						}
						
						if($Nom_Colonne == "Presentation_Bar")
						{
						?>
							<div class="row entree">
        						<div class="col-6">
        							<textarea style="margin-bottom:10px" name="NomModif" id="NomModif" cols="40" rows="5" placeholder=""></textarea>
        						</div>   						
						<?php
						
						}
						
					if($Nom_Colonne != "ID_Ville_fk")
						{						
						?>				
						<div>
        					<input name ="barmodiffinale" type="submit" value="Valider cette modif" class="btn btn-warning btn-block">						
        				</div> 
        				<?php
        				}
        				?>
        			</div> 					
					</form>
				</div>
			<?php	    				
        }   		
      		
        
        if (!empty($_POST['bieremodification']))
      	{
      		$ID_Biere = $_POST['NomBiereModif'];
      		$Nom_Colonne = $_POST['NomColonneModif'];
      			
			$_SESSION['ID_Biere'] = $_POST['NomBiereModif'];
			$_SESSION['Nom_Colonne'] = $_POST['NomColonneModif'];
			
			?>
			<div class="container">
    	<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    		<div class="row entree">
    		
    		<?php
    		if($Nom_Colonne == "Nom_Biere")
			{
			?>
			
        		<div class="col-3">
      				Entrer le nom de la bière à modifier
      			</div>
        		<div class="col-3">
        			<input id="NomBiere" type="text" name="NomModif" placeholder="Nom">
        		</div>
        	<?php
        	}
        	
        	if($Nom_Colonne == "Origine_fk")
			{
			?>
				<div class="col-3">
      				Son pays d'origine
      			</div>
        		<div class="col-3">
        			<td>
						<select class="choix" name="NomModif" id="OrigineBiere">
							<?php
								$TabOrigines = array();
								
								$TabOrigines = ListeFiltres("Origines_Bieres","ID_Origine","Origine"); 
								
								foreach($TabOrigines as $num => $UneOrigine)
								{
									$ID_Robe = $UneOrigine['ID_Origine'];
									$Robe = $UneOrigine['Origine'];
								
									?>
									<option value="<?php echo $ID_Robe;?>"><?php echo "$Robe" ?></option>  // il faut voir ce qu'on met dans value puisque c'est ce qu'on récupère en post.
									<?php
								
								}
							
							?>
                		</select>
       				</td>
        		</div>
        	<?php
        	}
        	if($Nom_Colonne == "Robe_fk")
			{
			?>
				<div class="col-3">
      				Quelle est sa robe ?
      			</div>
        		<div class="col-3">
        			<td>
						<select class="choix" name="NomModif" id="TypesBieres">
							<?php
								$TabRobes = array();
								
								$TabRobes = ListeFiltres("Robes","ID_Robe","Robe"); 
								
								foreach($TabRobes as $num => $UneRobe)
								{
									$ID_Robe = $UneRobe['ID_Robe'];
									$Robe = $UneRobe['Robe'];
								
									?>
									<option value="<?php echo $ID_Robe;?>"><?php echo "$Robe" ?></option>  // il faut voir ce qu'on met dans value puisque c'est ce qu'on récupère en post.
									<?php
								
								}
							
							?>
                		</select>
       				</td>
        		</div>
			<?php
			}
			if($Nom_Colonne == "Degre")
			{
			?>
				<div class="col-3">
      				Le degré d'alcool
      			</div>
        		<div class="col-3">
        			<input id="Degre" name="NomModif" type="text" placeholder="Degre">
        		</div>			
			<?php
			}
			if($Nom_Colonne == "Presentation_Biere")
			{
			?>
        		<div class="col-3">
      				Un petit descriptif
      			</div>
        		<div class="col-3">
        			<textarea style="margin-bottom:10px" name="NomModif" id="textarea" cols="40" rows="8" placeholder="Texte qui servira de description sur le site"></textarea>
        		</div>  
        		
        		     		
        	</div>
			<?php
			}
			?>       		        	
        	<input name ="modifbierefinale" type="submit" value="Confirmer modification" class="col-3 ajout btn btn-warning btn-block">
    	</form>
        </div>
     	<?php
      	}
      	
      	
      	//Modifs finales
      	
      	if (!empty($_POST['modifbierefinale']))
        {
        	$NvelleValeur = $_POST['NomModif'];
      			
      		UPDATE_ADMIN("Bieres",$_SESSION['Nom_Colonne'],$NvelleValeur,$_SESSION['ID_Biere']);      		
      	} 
      	
      	if (!empty($_POST['barmodiffinale']))
    	{
        	$NvelleValeur = $_POST['NomModif'];
      			
      		UPDATE_ADMIN("Bars",$_SESSION['Nom_Colonne'],$NvelleValeur,$_SESSION['ID_Bar']);
      	}  
      	
      	if (!empty($_POST['bieresuppression']))
      	{
      		$ID_Biere = $_POST['NomBiereModif'];
      		$Table = "Bieres";
      					
      		$Message = DELETE_ADMIN ($Table, $ID_Biere);
      					
      		echo"$Message";	
      				
      	}
      	
      	if (!empty($_POST['barsuppression']))
      	{
      		$ID_Bar = $_POST['NomBarModif'];
      		$Table = "Bars";
      					
      		$Message = DELETE_ADMIN ($Table, $ID_Bar);
      					
      		echo"$Message";	
      				
      	}
      	
      	if (!empty($_POST['membresuppression']))
      	{
      		$ID_Membre = $_POST['NomMembreModif'];
      		$Table = "Membres";

      		$Message = DELETE_ADMIN ($Table, $ID_Membre);
      					
      		echo"$Message";	
      				
      	}
      	
      	if (!empty($_POST['creationbar']))
      	{
      		$NomBar = $_POST['NomBar'];
      		$NumTel = $_POST['NumTel'];
      		$NumVoie = $_POST['Numero'];
      		$TypeVoie = $_POST['TypeVoie'];
      		$Complement = $_POST['Complement'];
      		$Nomvoie = $_POST['NomVoie'];
      		$Arrondissement = $_POST['Arrondissement'];
      		$Ville = 1;
      		$Site = $_POST['SiteBar'];
      		$Prix = $_POST['Prix'];
      		$Horaires = $_POST['horaires'];
      		$HorairesHH = "inconnues";
      		$Description = $_POST['description'];
      		$Image = "images/Bars/DefaultBar.jpg";  		
      		
      		
      		$Message = ADMIN_CREA_BAR ($NomBar, $NumTel, $NumVoie, $TypeVoie, $Complement, $Nomvoie, $Arrondissement, $Ville, $Site, $Prix, $Horaires, $HorairesHH, $Description, $Image);
      		
      		echo "$Message";
      	 
      	}
      	
      	if (!empty($_POST['creationbiere']))
      	{
      		$NomBiere = $_POST['NomBiere'];
      		$Origine = $_POST['OrigineBiere'];
      		$Robe = $_POST['TypesBieres'];
      		$Degre = $_POST['Degre'];
      		$Description = $_POST['description'];
      		$Image = "images/Bieres/DefaultBeer.png";
      		
      		$Message = ADMIN_CREA_BIERE ($NomBiere, $Origine, $Robe, $Degre, $Description, $Image);
      		
      		echo "$Message";
      		
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