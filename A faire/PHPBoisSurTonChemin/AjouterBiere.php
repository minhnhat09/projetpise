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
  	<title>Bois Sur Ton Chemin - Ajouter Biere</title>
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
  		<div class="container">
			<h2>Ajouter une bière</h2>
				Tu veux rajouter une boisson à notre collection ? Ça se passe ici.
			<hr>
		</div>
    
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
        			<textarea style="margin-bottom:10px" name="description" id="textarea" cols="40" rows="8" placeholder="Texte qui servira de description sur le site"></textarea>
        		</div>       		
        	</div>
        	<input name ="creation" type="submit" value="Entrer cette nouvelle bière" class="col-3 ajout btn btn-warning btn-block">
    	</form>
        <?php
        if (isset($_POST['creation']))  // tester si des certaines variables sont pas set ?? on est ok pour certaine valeur null?
        {
        	$NomBiere = strip_tags($_POST['NomBiere']);
        	$Robe = $_POST['TypesBieres'] ;
        	$Origine = $_POST['OrigineBiere'] ;
        	$Degre = floatval($_POST['Degre']) ;
        	$Description = strip_tags($_POST['description']);
        	
        	$message = Insert_Biere($NomBiere, $Robe, $Origine, $Degre, $Description);
        	
        	?>
        	<script type="text/javascript">
       				var nom = '<?php echo $message; ?>';
                	reponse =  resultat(nom);
        	</script> 
        	<?php
        }
        ?>
        	</br>
        	
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