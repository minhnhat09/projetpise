<!DOCTYPE html>
<html>
<head>
	<mega charset='UTF-8'>
	<title>T&T </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap|Cormorant+Garamond&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script>
		function resultat(texte) {
    		confirm(texte);
		}
	</script>
</head>
	<body>
	 <div id="container">
	  <div id="main">
	    <header>
	     <a href="index.php" class="header-brand"><img src="img/logo2.jpg" alt="Flo"></a>
		  <nav>  
			<ul>
			<li><a href="index.php">accueil</a> </li>
			   <li><a href="collection-par-categorie.php?categorie=Peinture">peinture</a> </li>
			   <li><a href="collection-par-categorie.php?categorie=Sculpture">sculpture</a> </li>
			   <li><a href="collection-par-categorie.php?categorie=Photographie">photographie</a> </li>
			   <li><a href="artistes.php">artistes</a> </li>
			 </ul> 
			 
			 <?php
                    if(membreEstConnecteEtEstAdmin())
                    {
                        echo '<a href="gestion-membre.php">Gestion des membres</a>';
						echo '<a href="gestion-oeuvres.php">Gestion des produits</a>';
					}
                    if(membreEstConnecte())
                    {
                        echo '<a href="profil.php">Voir votre profil</a>';
                        echo '<a href="panier.php">Voir votre panier</a>';
                        echo '<a href="connexion.php?action=deconnexion" class="header-signup">Se déconnecter</a>';
					}
					else
                    {	
						echo '<a href="inscription.php" class="header-signup">S\' inscrire/ Se connecter</a>';
						echo '<a href="panier.php" class="header-signup">Mon panier</a>';
			 			
					}
			?>
			
			</nav>
		</header>		
    </html>