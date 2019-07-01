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
      <div>
        <h2>accueil</h2>
        
		<p>Bienvenue sur Bois Sur Ton Chemin, site dédié aux amateurs de bières !</br> 
		   C'est parfois difficile de trouver la bonne adresse qui sert la marque de bière que l'on veut.
		   Parfois aussi on veut se laisser tenter par une nouvelle aventure dans le monde du houblon et 
		   du malt en essayant de nouvelles boissons. Pour tout ceci, bois sur ton chemin est ta maison !		
		</p>
      </div>
      
      	</br>
      	<hr>
      	</br>
   	
    </div>  		

    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-12">
        	<iframe class="carte" src="https://www.google.com/maps/d/u/0/embed?mid=1ARv-e6o_bunqKdxOAtHJuSKunUqMD1Ee"></iframe>
        </div>
        
        <?php 
				$Tab = ListeTab("Anecdotes");
				
				$Histoirehasard = array_rand($Tab, 1);
				
				$Histoire = $Tab[$Histoirehasard];
				
				$Description = $Histoire['Histoire'];
  				$Image = $Histoire['Image_Anecdote'];
				
		?>
		
        <div class="col-lg-3 col-md-12 jumbotron">
        	<h3>Histoire de bière</h3>
			<img src="<?php echo "$Image" ?>" class="img-bars"/></br></br>
			<p><?php echo "$Description" ?><p/>
        </div>
        
      </div>
      <hr>
    </div>
    
    <p class="container">
    	Nous vous proposons ici de faire une recherche de bars en fonction de vos envies. 
    	Vous pouvez chercher une adresse par tranche de prix et par arrondissement. Si vous cherchez également des bars
    	qui servent un type de bière ou une nationalité de bière, c'est possible !
    </p>
    
    <div  class="container">
		<h3>Critères de Recherche</h3>
    	<div class="container">
    	    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      		<div class="row">
        		<div class="criteres col-lg-2 col-md-6">
        			<td>
        				<div>Robe</div>
						<select class="choix" name="TypesBieres" id="TypesBieres" placeholder="Toutes">
							<option value="Toutes">Toutes</option>
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
        		<div class="criteres col-lg-2 col-md-6">
        			<td>
        				<div>Pays d'origine</div>
             			<select class="choix" name="PaysOrigine" id="PaysOrigine" placeholder="Tous">
							<option value="Tous">Tous</option>
						<?php 
							$TabOrigines = array();
							
							$TabOrigines = ListeFiltres("Origines_Bieres","ID_Origine","Origine");
							
								foreach($TabOrigines as $num => $UneOrigine)
								{
									$ID_Origine = $UneOrigine['ID_Origine'];
									$Origine = $UneOrigine['Origine'];
								
									?>
									<option value="<?php echo $ID_Origine;?>"><?php echo "$Origine" ?></option> 
									<?php
								
								}
							?>  
                		</select>
            		</td>        
        		</div>
        
        		<div class="criteres col-lg-2 col-md-6">
        			<td>
        				<div>Prix</div>
						<select class="choix" name="Prix" id="Prix" placeholder="Tous">
							<option value="Tous">Tous</option>
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
            		</td>      
        		</div>
        
        		<div class="criteres col-lg-2 col-md-6">
        			<td>
        				<div>Arrondissement</div>
						<select class="choix" name="Arrondissement" id="Arrondissement" placeholder="Tous">
							<option value="Tous">Tous</option>
						<?php 
							$TabArrondissement = array();
							
							$TabArrondissement = ListeFiltres("Arrondissements","ID_Arrondissement", "Arrondissement");
							
								foreach($TabArrondissement as $num => $UnArrondissement)
								{
									$ID_Arrondissement = $UnArrondissement['ID_Arrondissement'];
									$Arrondissement = $UnArrondissement['Arrondissement'];
								
									?>
									<option value="<?php echo $ID_Arrondissement;?>"><?php echo "$Arrondissement" ?></option> 
									<?php
								
								}
						?> 
                		</select>
            		</td>
        		</div>   
        		<input name ="filtres" type="submit" value="Rechercher" class="col-lg-2 col-md-6 btn btn-info btn-warning"> 
    		</div>
    	</form>
    </div>
    
   	</br>
   	
   	</div>
    
    <div class="container">
		<fieldset class="encadreResultats scheduler-border">
    		<legend class="scheduler-border">Bars correspondants</legend>
    		
    		<?php
    		$rechercheOK =false ;
			if (isset($_POST['filtres']))
			{
				$f_robe=$_POST['TypesBieres'];
				$f_OrigineBi=$_POST['PaysOrigine'];
				$f_Prix=$_POST['Prix'];
				$f_Arrondissement=$_POST['Arrondissement'];
				
				$tabBarFil = Affichage_bar($f_robe,$f_OrigineBi,$f_Prix,$f_Arrondissement);
				$rechercheOK =true ;
			}
			else if (!isset($_POST['filtres']))
			{
				$tabBarFil=Affichage_bar("Toutes","Tous","Tous","Tous");
				$rechercheOK =true ;
			}

    		foreach($tabBarFil as $num => $UnBar)
      		{
      			$ID_bar = $UnBar['ID_Bar'] ;
      			$Nom = $UnBar['Nom_Bar'];
    			$Num_voie = $UnBar['Num_Voie'] ;
    			$Complement = $UnBar['Complement'] ;
    			$Voie = $UnBar['Voie'];
    			$NomVoie = $UnBar['Nom_Voie'];
    			$Arrondissement = $UnBar['Arrondissement'] ;
    			$Ville = $UnBar['Ville'] ;
    			$Prix = $UnBar['Prix'] ;
      			$Presentation = $UnBar['Presentation_Bar'];
      			$Image = $UnBar['Image_Bar'];
      				
      			$adresse = $Num_voie." ".$Complement." ".$Voie." ".$NomVoie.", ".$Arrondissement ;
      					
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
    						<?php echo "$adresse" ?>					
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
    							<a class="btn btn-warning btn-voirplus" onclick="location.href='Bar.php?ID=<?php echo "$ID_bar" ?>&action=null'">
									Voir plus
								</a>
							</div>
    				</div>
        			
        			<?php      	
        	
        		} ?>

    		
    	</fieldset>
	</div>


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