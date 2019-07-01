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
									<a href="Deconnexion.php?source=CreationCompte.php">Se deconnecter</a>
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
        <div class="col-8 login">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Créez votre compte</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			    			<h4></br>Coordonnées :</br></h4>
			    			<div class="row">
			    				<div class="col-6">
			    					<div class="form-group">
			                			<input type="text" name="Prenom" class="form-control input-sm" placeholder="Prenom">
			    					</div>
			    				</div>
			    				<div class="col-6">
			    					<div class="form-group">
			    						<input type="text" name="Nom" class="form-control input-sm" placeholder="Nom">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="col-12">
			    				<div class="form-group">
			    					<input type="text" name="Mail" class="form-control input-sm" placeholder="Mail">
			    				</div>
			    			</div>

							<h4></br>Pseudo et Mot de passe :</br></h4>
							<div class="row">
			    				<div class="col-12">
			    					<div class="form-group">
			    						<input type="text" name="Pseudo" class="form-control input-sm" placeholder="Pseudo">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-6">
			    					<div class="form-group">
			    						<input type="password" name="MotDePasse" class="form-control input-sm" placeholder="Mot de passe">
			    					</div>
			    				</div>
			    				<div class="col-6">
			    					<div class="form-group">
			    						<input type="password" name="MotDePasse2" class="form-control input-sm" placeholder="Confirmer Mot de Passe">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			
			    			<h4></br>Bière préférée (Cette information vous sera demandée en cas d'oubli de mot de passe) : </br></h4>
			    			<div class="form-group">
			    				<input type="text" name="BierePref" iclass="form-control input-sm" placeholder="Biere préférée">
			    			</div>
				    		
				    		</br>		    			
			    			
			    			<input name ="valider" type="submit" value="Créer compte" class="btn btn-warning btn-block">
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
    
    
    	<?php
      	// --- Traitement ---
      	if (!empty($_POST['valider']))
      	{
       		$Nom = $_POST['Nom']; 
       		$Prenom = $_POST['Prenom'];
       		$Pseudo = $_POST['Pseudo'];
       		$MotDePasse = $_POST['MotDePasse'];
       		$MotDePasse2 = $_POST['MotDePasse2'];
       		$BierePreferee = $_POST['BierePref'];
       		$Mail = $_POST['Mail'];      		
       		$Unique = VerifPseudo($Pseudo);
       		
       		
       		if (filter_var($Mail, FILTER_VALIDATE_EMAIL) == false)
       		{
    			$Message = "Adresse mail non valide";
			}
       		else if(strlen($Pseudo)<6)
       		{
       			$Message = "Votre pseudo doit faire au moins 6 caractères";
       		}
       		else if(strlen($MotDePasse)<8)
       		{
       			$Message = "Votre mot de passe doit faire au minimum 8 caractères de long";     		
       		}
       		else if($MotDePasse != $MotDePasse2)
       		{
       			$Message = "Les 2 mots de passes saisies ne sont pas identiques";     		
       		}
       		else if ($Unique == false)
       		{
       			$Message = "identifiant déjà existant";
       		}
       		else
       		{    
       			$MotDePasse = password_hash($MotDePasse, PASSWORD_DEFAULT);      		   		
       			CreationCompte($Nom,$Prenom,$Pseudo,$MotDePasse,$BierePreferee,$Mail);
       			$Message = "Compte créé !";
       		}  

       		?>
       			<script type="text/javascript">
       				var nom = '<?php echo $Message; ?>';
                	reponse =  resultat(nom);
        		</script> 
       		<?php
       		
       		if($Message == 'Compte créé !')
       		{
       			$Connection = Connection($Pseudo,$MotDePasse2);
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