<?php
// On démarre la session AVANT d'écrire du code HTML
// afin de conserver l'information indiquant si c'est le premier accès
if (session_status() != PHP_SESSION_ACTIVE) session_start();
include 'PHP/BaseDonnees.php';
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
									<a href="Deconnexion.php?source=Contact.php">Se deconnecter</a>
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
  			</br>
			<h2>Contact</h2>
			une suggestion ? Une remarque ? N'hésitez pas à nous contacter via ce formulaire
			<hr>
		</div>
		<div class="container">
            <form action="" method="post">
            <table border="0" cellspacing="0">
                <tr>
                    <td align="left"><label for="civilite">Civilité</label></td>
                    <td align="left">
                        <select name="civilite" id="civilite" placeholder="M.">
                            <option value="france">M.</option>
                            <option value="espagne">F.</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td align="left"> <label for="nom">Nom</label></td>
                    <td align="left">
                        <input id="nom" name="nom" type="text" placeholder="indiquez votre nom">
                    </td>
                </tr>

                <tr>
                    <td align="left"><label for="email">Email</label></td>
                    <td align="left">
                         <input id="email" name="email" type="email" placeholder="indiquez votre email">
                    </td>
                </tr>
                <tr>
                    <td align="left">                    
                        <label for="date">Date</label>
                    </td>
                    <td align="left">
                        <input id="date" name="date" type="date">
                                            
                    </td>
                </tr>
                <tr>
                    <td align="left">                    
                        <label for="sujet">Sujet</label>
                    </td>
                    <td align="left">
                    	<select name="sujet" id="sujet" placeholder="demande de renseignements">
                        	<option value="france">Suggestion</option>
                            <option value="espagne">Remarque</option>
                            <option value="espagne">autre</option>
                        </select>
                   	</td>
                </tr>
                
            </table>

            	<label for="textarea">Message</label><br>
                    <textarea style="margin-bottom:10px" name="textarea" id="textarea" cols="50" rows="10" placeholder="Entrez votre message ici"></textarea><br>
                    
            	<input type="reset" value="Effacer">
            	<input type="submit" value="Envoyer">
            
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