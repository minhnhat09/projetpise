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
									<a href="EspaceMembre.php"><?php echo $_SESSION['pseudo'] ?></a>
								</li>
								<li id="menu-item-92" class="col2 menu-item menu-item-type-custom menu-item-object-custom menu-item-92">
									<a href="Deconnexion.php?source=LogIn.php">Se deconnecter</a>
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
        <div class="row centered-form">
        <div class="col-4 login">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Se connecter</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			    				<div>
			    					<div class="form-group">
			    						<input type="text" name="Pseudo" id="Pseudo" class="form-control input-sm" placeholder="Pseudo">
			    					</div>
			    				</div>
			    			
			    				<div>
			    					<div class="form-group">
			    						<input type="password" name="Mdp" id="Mdp" class="form-control input-sm" placeholder="Mot de passe">
			    					</div>
			    				</div>
				    		
				    		</br>		    			
			    			
			    			<input name ="connection" type="submit" value="Se connecter" class="btn btn-info btn-block">
			    			
			    			</br>
			    			
			    			<a href="CreationCompte.php">Pas encore de compte ?</a>
			    			</br>
			    			<a href="Modifmdp.php">Mot de passe oublié ?</a>
			    			
			    			
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
     </div>
     
     <?php
      	// --- Traitement ---
      	if (!empty($_POST['connection']))
      	{
      		
       		$Pseudo = $_POST['Pseudo']; 
       		$Mdp = $_POST['Mdp'];
       		
       		$Message = Connection($Pseudo,$Mdp); 
       		
       		?>
       			<script type="text/javascript">
       				var nom = '<?php echo $Message; ?>';
                	reponse =  resultat(nom);
        		</script> 
       		<?php
       		
       		if($Message == 'Vous êtes connecté !')
       		{
       		?>
       			<script type="text/javascript">
					document.location.href="EspaceMembre.php"
				</script>
			<?php
        	}    		       		           
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