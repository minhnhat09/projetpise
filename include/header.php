<!DOCTYPE html>
<html>
<head>
	<mega charset='UTF-8'>
	<title>T&T </title>
	<meta name="language" content="fr">
  	<meta name="description" content="gallerie d'art en ligne">
  	<meta name="keywords" content="art,peinture,artiste">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap|Cormorant+Garamond&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
	
</head>
	<body>
	 <div id="container">
	  <div id="main">
	    <header>
	     <a href="index.php" class="header-brand"><img src="img/logo2.jpg" alt="Flo"></a>
		  <nav>  
			<ul>
			   <li><a href="index.php">Accueil</a> </li>
			   <li><a href="collection-par-categorie.php?categorie=Peinture">peinture</a> </li>
			   <li><a href="collection-par-categorie.php?categorie=Sculpture">sculpture</a> </li>
			   <li><a href="collection-par-categorie.php?categorie=Photographie">photographie</a> </li>
			   <li><a href="artistes.php">artistes</a> </li>
			 </ul> 
			 </nav>
			
			
			 <?php
                    
                    if(membreEstConnecte()||membreEstConnecteEtEstAdmin())
                    {
						echo '<pre></pre><a href="profil.php" class="ad">Mon profil</a>';
						echo '<a href="panier.php" class="header-signup">Mon panier</a>';
                        echo '<a href="connexion.php?action=deconnexion" class="header-signup">Se déconnecter</a>';
					}
					else
                    {	
						echo '<a href="inscription.php" class="header-signup">S\' inscrire/ Se connecter</a>';
			 			echo '<a href="panier.php" class="header-signup">Mon panier</a>';
					}
			?>
			
		</header>		
    </html>