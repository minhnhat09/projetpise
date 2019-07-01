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
	
	
	<?php
		
		if( isset($_GET['ID']))
		{
		    $UnBar = Info_Bar($_GET['ID']);
		    $_SESSION['bar'] = $_GET['ID'];
		}
		else
		{
		    $UnBar = Info_Bar($_SESSION['bar']);
		}
		
		
		$ID_bar = $UnBar[0]['ID_Bar'] ;
      	$Nom = $UnBar[0]['Nom_Bar'];
    	$Num_voie = $UnBar[0]['Num_Voie'] ;
		$Complement = $UnBar[0]['Complement'] ;
		$Voie = $UnBar[0]['Voie'];
    	$NomVoie = $UnBar[0]['Nom_Voie'];
    	$Arrondissement = $UnBar[0]['Arrondissement'] ;
    	$Ville = $UnBar[0]['Ville'] ;
    	$Prix = $UnBar[0]['Prix'] ;
      	$Presentation = $UnBar[0]['Presentation_Bar'];
      	$Image = $UnBar[0]['Image_Bar'];
      	$Horaires = $UnBar[0]['Horaires_Bar'];
      				
      	$adresse = $Num_voie." ".$Complement." ".$Voie." ".$NomVoie.", ".$Arrondissement ;
		
		$NoteBar = AVG_Note($_SESSION['bar']);
		
		$lesBieres = BieresDispo($_SESSION['bar']);	
			
		$Evaluations = Comment_Bar($_SESSION['bar']);		
		
		foreach ($NoteBar as $laCase)
		{
		    $lanote = $laCase['AVG(Note)'];
		}
		
		
		
    ?>
	
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="NomBar" ><?php echo $Nom ?></h2>
			</div>
		</div>
		<hr>
	</div>
			
	<div class="container">
		<div class="row">			
			<div class="col-5">
      			<img class="img-barsolo" src="<?php echo"$Image" ?>">
			</div>
			
			<div class="col-7">
				<div class="row">
				
				
				</div>
				<div class="row">
					<div class="col-6">
						<p class="infosbar"><?php echo"$Presentation" ?></p>				
					</div>	
					<div class="col-6">
						<div>
							<div class="row">
								<h5 class="col-5"> Adresse : </h4>
								<p  class="col-7"><?php echo "$adresse" ?></p>
							</div>
							<div class="row">
								<h5 class="col-5"> Horaires : </h5>
								<p class="col-7"> <?php echo"$Horaires" ?> </p>
							</div>
						</div>
					</div>							
				</div>
				
				<hr>
				<div class="row">
					<div class="col-6 jumbotron">
						<h4>Note des utilisateurs :</h4>
						<?php 
					
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
					<div class="col-6">
						<h5 class="infosbar col-5">Prix :</h5>
						<h3 class="infosbar"><?php echo"$Prix" ?></h3>
					</div>
				</div>
			</div>			
		</div>
		<hr>		
	</div>
	
	
	<div class=" container jumbotron">
		<h3> Ce bar vous propose </h3>		
		<?php 
		
			foreach($lesBieres as $num => $UneBiere)
  			{
  				
  				$ID_Biere = $UneBiere['ID_Biere'];
  				$Nom = $UneBiere['Nom_Biere'];
    			$Presentation = $UneBiere['Presentation_Biere'];
    			$Degre = $UneBiere['Degre'];
    			$Image = $UneBiere['Image_Biere'];
    			
    			echo"- $Nom </br>";  	
        	} ?>	
	</div>
	
		<?php
	
	if (isset($_SESSION['connecte']))
	{
		if($_SESSION['droits'] == 1)
		{
			?>
			<div class=" container">
				<fieldset class="encadreResultats scheduler-border">
      		 		<legend class="scheduler-border">Laissez votre appréciation de ce bar</legend>
						<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
							
							<div class="row">
                				<textarea class="col-5 commentaire" style="margin-bottom:10px" name="textarea" id="textarea">
                				</textarea>
                				<div class="col-3 jumbotron commentaire">
                					<legend class="scheduler-border">Note : </legend>
                					<select class="choix col-2" name="note" id="Prix" placeholder="Tous">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option> 
                					</select>
                					<a class="bouton"><img class="bieresnote" src="images/BonneNote.png"></a>
                				</div>
                				<input name ="creation" type="submit" value="Soumettre" class="col-3 ajout btn btn-warning btn-block">			
							</div>
							
                		</form>
                </fieldset>
			</div>
			<?php
		}
	}
	
	?>
	
	<div class="container">
		<?php
		foreach ($Evaluations as $Evaluation)
		{
		    $Note = $Evaluation['Note'];
		    $Commentaire = $Evaluation['Commentaire'];
		    $Pseudo = $Evaluation['Pseudo_Membre'];
		    
		    ?>
		    <div class="row">
			<div class="col-sm-2 avatar">
				<img class="compte" src="images/Compte.png">
				<div class="review-block-name"><a href="#"><?php echo "$Pseudo" ?></a></div>
			</div>
			<div class="col-sm-9">
				<div class="row">
					<div class="col-3 jumbotron">
						<?php 
					
							$CompteTours = 0;
						
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
				<div class=" col-6 review-block-description"><?php echo "$Commentaire" ?></div>
				</div>
			</div>
		</div>
		<hr/>
		
		<?php
		    
		}
	?>
    <?php
	if(isset($_POST['creation']))
	{
	    $commentaire = $_POST['textarea'];
	    $note = $_POST['note'];
	    $IDMembre = $_SESSION['ID_Membre'];
	    
	    
	    $message = INSERT_EVAL ($IDMembre, $ID_bar,  $note, $commentaire) ;
	    
	    echo $message ;
	}
  	
  	?>
  	
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