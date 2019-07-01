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
									<a href="EspaceMembre.php"><?php echo $_SESSION['pseudo'] ?></a>
								</li>
								<li id="menu-item-92" class="col2 menu-item menu-item-type-custom menu-item-object-custom menu-item-92">
									<a href="Deconnexion.php?source=AjouterBar.php">Se deconnecter</a>
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
			<h2>Ajouter une adresse</h2>
				Tu veux rajouter un bar à notre liste ? Ça se passe ici
			<hr>
		</div>
    
    	<div class="container">
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
        	
        	</br>
        	
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