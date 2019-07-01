<?php


function ListeTab($Tabcherche)
{
  include "BaseDonnees.php";
  $Tabfinal = array();
  
  try
  {

   $bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));
   
   $bdd->exec("SET CHARACTER SET utf8");  

   $Requete_SQL = 'SELECT * FROM '.$Tabcherche ;
   $reponse = $bdd->query($Requete_SQL);   
   
   // --- traitement des erreurs de retour sur la requête ---
   if (!$reponse)
   {
     echo "Problème de requête sur la table";
   }
   // --- un tableau associatif ---
   $reponse->setFetchMode(PDO::FETCH_ASSOC); 
   $Tabfinal = $reponse->fetchAll() ;
  }
  catch(Exception $e)
  {
   echo 'Erreur de connexion avec la base : '.$BASE;
  }
  return  $Tabfinal ;
}

function CreationCompte($Nom,$Prenom,$Pseudo,$MotDePasse,$BierePreferee,$Mail)
{
  include "BaseDonnees.php";
  $InsertionOK = True;
  try
  {

   $bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));
   
   $bdd->exec("SET CHARACTER SET utf8");  

   $Requete_SQL = "INSERT INTO ".$MEMBRES." (ID_Membre, Nom_Membre, Prenom_Membre, Pseudo_Membre, Mdp_Membre, Biere_Preferee, Mail, Droit) VALUES (NULL,'".$Nom."','".$Prenom."','".$Pseudo."','".$MotDePasse."','".$BierePreferee."','".$Mail."',1)" ; // mise en forme de la requête d'insertion des données membres
   echo "$Requete_SQL";
   $reponse = $bdd->exec($Requete_SQL);
   // --- traitement des erreurs de retour sur la requête ---
   if (!$reponse)
   {
     throw new Exception('Problème de requête sur la table '.$MEMBRES);
   }
  }
  catch(Exception $e)
  {
   $InsertionOK = False;   
  }
  return $InsertionOK;
}

function VerifPseudo($Pseudo)  // permet de récupérer tous les pseudos et par la suite de tester si le nouveau pseudo est déjà existant
{ 
  	include "BaseDonnees.php";
  
	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");

	$Requete_SQL = 'SELECT * FROM '.$MEMBRES." WHERE Pseudo_Membre ='".$Pseudo."'";
	$reponse = $bdd->query($Requete_SQL);
	
	$data = $reponse->fetch();
	
	if($data)
	{
		$Unique = false;
	}
	else
	{
		$Unique = true;
	}

	return $Unique;
}

function Connection($Pseudo,$Mdp)
{ 
  	include "BaseDonnees.php";  	
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'SELECT ID_Membre,Mdp_Membre,Droit FROM '.$MEMBRES." WHERE Pseudo_Membre ='".$Pseudo."'";
		$reponse = $bdd->query($Requete_SQL);
	
		$data = $reponse->fetch();
		
		// Comparaison du pass envoyé via le formulaire avec la base
		
		$isPasswordCorrect = password_verify($Mdp, $data['Mdp_Membre']);

		if (!$data)
		{
    		$Message = "Mauvais identifiant ou mot de passe !";
		}
		else
		{
    		if ($isPasswordCorrect)
    		{
        		$_SESSION['droits'] = $data['Droit'];
        		$_SESSION['pseudo'] = $Pseudo;
        		$_SESSION['connecte'] = true;
        		$_SESSION['ID_Membre'] = $data['ID_Membre'];
        		
        		$Message = "Vous êtes connecté !";
    		}
    		else 
    		{
        		$Message = "Mauvais identifiant ou mot de passe !";
    		}
		}
		
		return $Message;
}

function ListeFiltres($Table,$ID,$Col)  // fonction de récupération des infos d'un champ pour les différents select html
{ 
  	include "BaseDonnees.php";  
  			
  		$TabFiltres = array();
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'SELECT '.$ID.','.$Col." FROM ".$Table."";
		$reponse = $bdd->query($Requete_SQL);
		
		$reponse->setFetchMode(PDO::FETCH_ASSOC); 
   		$TabFiltres = $reponse->fetchAll() ;
   		
   		return $TabFiltres;
		
}

function InfosBar($IDBar)  // récupère toute les infos d'un bar en fonction de son ID
{ 
  	include "BaseDonnees.php";  
  	$TabDonnees = array();
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'SELECT * FROM '.$BARS." WHERE ID_Bar ='".$IDBar."'";
		$reponse = $bdd->query($Requete_SQL);
		
		$TabDonnees = $reponse->fetch();
   		
   		return $TabDonnees;		
}

function AjoutBarFavori($ID_Membre,$ID_Bar)
{ 
  	include "BaseDonnees.php"; 
  	$TabDonnees = array(); 
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'INSERT INTO Bars_Favoris VALUES('.$ID_Bar.','.$ID_Membre.')';
		$reponse = $bdd->exec($Requete_SQL);	
}

function SuppressionBiereFavorite($ID_Membre,$ID_Biere)
{ 
  	include "BaseDonnees.php"; 
  	$TabDonnees = array(); 
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'DELETE FROM Bieres_Favorites Where ID_Biere='.$ID_Biere.' AND ID_Membre='.$ID_Membre.'';
		$reponse = $bdd->exec($Requete_SQL);	
}

function AjoutBiereFavorite($ID_Membre,$ID_Biere)
{ 
  	include "BaseDonnees.php"; 
  	$TabDonnees = array(); 
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'INSERT INTO Bieres_Favorites VALUES('.$ID_Biere.','.$ID_Membre.')';
		$reponse = $bdd->exec($Requete_SQL);	
}

function SuppressionBarFavori($ID_Membre,$ID_Bar)
{ 
  	include "BaseDonnees.php"; 
  	$TabDonnees = array(); 
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'DELETE FROM Bars_Favoris Where ID_Bar='.$ID_Bar.' AND ID_Membre='.$ID_Membre.'';
		$reponse = $bdd->exec($Requete_SQL);	
}

function ListeBarsFavoris($ID_Membre)
{
	include "BaseDonnees.php";
  	$Tabinter = array();
  	$Tabfinal = array();
  	
	$Tabinter = ListeTab("Bars_Favoris");
	
	foreach($Tabinter as $num => $Favori)
  	{
  		if(($Favori['ID_Membre'] == $ID_Membre))
  		{
  			$test = $Favori['ID_Membre'];
  			$Tabfinal[] = $Favori['ID_Bar'];
  		}		
  	}
  	
  	return 	$Tabfinal;
}

function ListeBieresFavorites($ID_Membre)
{
	include "BaseDonnees.php";
  	$Tabinter = array();
  	$Tabfinal = array();
  	
	$Tabinter = ListeTab("Bieres_Favorites");
	
	foreach($Tabinter as $num => $Favori)
  	{
  		if(($Favori['ID_Membre'] == $ID_Membre))
  		{
  			$test = $Favori['ID_Membre'];
  			$Tabfinal[] = $Favori['ID_Biere'];
  		}		
  	}
  	
  	return 	$Tabfinal;
}

function Affichage_Bar($robe,$origine,$prix,$arrondissement) // affichage en fonction des filtres sur la page accueil
{

include "BaseDonnees.php";

$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

$bdd->exec("SET CHARACTER SET utf8");


$INNER_JOIN_BAR = "SELECT ID_Bar, Nom_Bar, Num_Voie, Complement, Voie, Nom_Voie, Arrondissement, Ville, Prix, Presentation_Bar, Image_Bar
				   FROM Bars 
				   INNER JOIN Types_Voie ON Type_Voie_fk = ID_Type 
				   INNER JOIN Complements_adresse ON Complement_adresse_fk = ID_Complement
				   INNER JOIN Arrondissements ON ID_Arrondissement_fk = ID_Arrondissement
				   INNER JOIN Villes ON ID_Ville_fk = ID_ville
				   INNER JOIN Prix ON Prix_fk = ID_Prix
				   " ;  // recup de toutes les infos d'un bar pour l'affichage final

$SELECT_ID_Biere = "SELECT ID_Biere FROM Bieres " ;  // requete de récup des idBiere si filtre	

$SELECT_ID_Bar_fk = "SELECT ID_Bar_fk FROM Bieres_Par_Bars "; // requete de recup des IDBar correspondant aux bieres filtrées			   

$PasdeRes = false ;
$ZeroFiltre = false ;
$FiltreBiere = false ;
$FiltreBar = false ; 
$FiltreBar = false ;

// je crée les booléens 
if (($robe == "Toutes") && ($origine == "Tous") && ($prix == "Tous") && ($arrondissement == "Tous")) // tous les filtres sont à "0" 
{
	$ZeroFiltre = true ;
}
else if ((($robe != "Toutes") || ($origine != "Tous")) && ($prix == "Tous") && ($arrondissement == "Tous")) // filtre uniquement sur bière
{
	$FiltreBiere = true ;
}
else if ((($robe == "Toutes") && ($origine == "Tous")) && (($prix != "Tous") || ($arrondissement != "Tous"))) // filtre uniquement sur bar
{
	$FiltreBar = true ;
}
else  // filtre sur biere et bar
{
	$FiltreTous = true ;
}

// En fonction du booléen je fais les requêtes correspondantes

if ($ZeroFiltre)  // pas de filtre, je récupère tous les bars avec la requete inner join
{
	$reponse = $bdd->query($INNER_JOIN_BAR);
		
	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
   	$InfosBar = $reponse->fetchAll() ;
}
else if ($FiltreBiere) 
{
    // je construis la requête par rapport aux filtres (soit 1-0 ou 0-1 ou 1-1) puis je sélectionne les ID_bière correspondants
	if (($robe!="Toutes") && ($origine!="Tous"))  // les 2 filtres rengeignés
	{
		$SELECT_ID_Biere = $SELECT_ID_Biere." WHERE Robe_fk = ".$robe." AND Origine_fk = ".$origine ;
	}
	else if (($robe=="Toutes") && ($origine!="Tous")) //filtre sur origine
	{ 
		$SELECT_ID_Biere = $SELECT_ID_Biere." WHERE Origine_fk = ".$origine ;    	   
	}
	else if (($robe!="Toutes") && ($origine=="Tous"))  //filtre sur robe
	{
		$SELECT_ID_Biere = $SELECT_ID_Biere." WHERE Robe_fk = ".$robe ;  
	}
	$reponse = $bdd->query($SELECT_ID_Biere);
		
	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
	$TabIdBiere = $reponse->fetchAll() ;
	
	$compte = count($TabIdBiere) ;  
	
	if ($compte>0) // si la requête produit des résultats 
	{
		foreach ($TabIdBiere as $num => $uneCase)  /* je construis la requête pour aller chercher les ID_Bar correspondants aux ID_biere dans la table de jointure (seulement si la requête précédente à produit des res)*/
    	{
    		$ID = $uneCase['ID_Biere'] ;
    		if ($num == 0)
    		{
    			$SELECT_ID_Bar_fk = $SELECT_ID_Bar_fk." WHERE ID_Biere_fk = ".$ID ;
    		}
    		else 
    		{
    			$SELECT_ID_Bar_fk = $SELECT_ID_Bar_fk." OR ID_Biere_fk = ".$ID ;
    		}
    	} 
    	$reponse = $bdd->query($SELECT_ID_Bar_fk);
    		
    	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
    	$TabIdBar = $reponse->fetchAll() ;
	    
	    $indMax = (count($TabIdBar)) - 1; //(count d'un tableau de 2 case = 2 alors qu'indiceMax de l'array est 1)
    	 
    	if ($indMax + 1 > 1) // si il y a plus d'un res je dois vérifier les doublons (table de jointure peut créer doublon)
    	{
        	foreach ($TabIdBar as $num => $uneCase1) //je cherche les doublons
        	{
        
        		$ID_Bar1 = $uneCase1['ID_Bar_fk'];
        		 
        		foreach ($TabIdBar as $num2 => $uneCase2)
        		{
        			if (($num < $indMax) && ($num2 >= ($num+1))) /* je ne dois pas faire le dernier tour ==> je dois noter un NumMax et jouer sur NumMax -1 et je ne test que les cases supérieures à l'indice de ma 1ere boucle */
        			{
        				$ID_Bar2 = $uneCase2['ID_Bar_fk'];
        			 
        					if ( $ID_Bar1==$ID_Bar2) // si je trouve un doublon je mets $num2 dans mon tableau de doubons
        					{
        						$Tab_Doublons[]=array("Indice_D" => $num2);
        					}
        			}
        		}
        	}
        	foreach ($Tab_Doublons as $num => $unIndice) // je supprime les doublons de $Tab_id_bars (j'évite de supprimer des cases/indice dans ma double boucle de recherche..)
        	{
        		$indice=$unIndice['Indice_D'];
        		
        		foreach ($TabIdBar as $num2 => $uneID_Bar) 
        		{
        			if ($indice==$num2)
        			{
        				unset($TabIdBar[$num2]); 
        			}	
        		}
        		
        	}
    	}
    	// j'ai un tableau d'ID_bar propre.
	
		foreach ($TabIdBar as $num => $uneCase)  // je peux maintenant faire ma requête finale qui récupère les bars correspondants aux filtres
		{
			$ID = $uneCase['ID_Bar_fk'];
			if ($num==0)
			{
				$INNER_JOIN_BAR = $INNER_JOIN_BAR." WHERE ID_Bar = ".$ID  ;
			}
			else
			{
				$INNER_JOIN_BAR = $INNER_JOIN_BAR." OR ID_Bar = ".$ID  ; 
			}
		}
		$reponse = $bdd->query($INNER_JOIN_BAR);
    		
    	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
    	$InfosBar = $reponse->fetchAll() ;
		
	}
	else
	{
		$PasdeRes = true ; 
	}
}	
else if ($FiltreBar)  // je construis la requête en fonction des trois possibilités de combinaisons de filtres sur les bar
{
    if (($prix != "Tous") && ($arrondissement != "Tous"))  // les 2 filtres rengeignés
    {
		$INNER_JOIN_BAR = $INNER_JOIN_BAR." WHERE Prix_fk = ".$prix." AND ID_Arrondissement_fk = ".$arrondissement ;
    }
    else if (($prix == "Tous") && ($arrondissement != "Tous")) //filtre sur arrondissement
    {
		$INNER_JOIN_BAR = $INNER_JOIN_BAR." WHERE ID_Arrondissement_fk = ".$arrondissement ;
    }
    else if (($prix != "Tous") && ($arrondissement == "Tous"))  //filtre sur prix
    {
		$INNER_JOIN_BAR = $INNER_JOIN_BAR." WHERE Prix_fk = ".$prix ;
    }
	$reponse = $bdd->query($INNER_JOIN_BAR);
    		
    $reponse->setFetchMode(PDO::FETCH_ASSOC); 
    $InfosBar = $reponse->fetchAll() ;
    
	$compte = count($InfosBar);
	
	if($compte == 0)
	{
		$PasdeRes = true ; 
	}
}
else
{
    // 1-je refais la même démarche que pour les filtres sur biere
    
	if (($robe!="Toutes") && ($origine!="Tous"))  // les 2 filtres rengeignés
	{
		$SELECT_ID_Biere = $SELECT_ID_Biere." WHERE Robe_fk = ".$robe." AND Origine_fk = ".$origine ;
	}
	else if (($robe=="Toutes") && ($origine!="Tous")) //filtre sur origine
	{ 
		$SELECT_ID_Biere = $SELECT_ID_Biere." WHERE Origine_fk = ".$origine ;    	   
	}
	else if (($robe!="Toutes") && ($origine=="Tous"))  //filtre sur robe
	{
		$SELECT_ID_Biere = $SELECT_ID_Biere." WHERE Robe_fk = ".$robe ;  
	}
	$reponse = $bdd->query($SELECT_ID_Biere);
		
	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
	$TabIdBiere = $reponse->fetchAll() ;
	
	$compte = count($TabIdBiere) ;
	
	if ($compte>0) // si la requête produit des résultats
	{
		foreach ($TabIdBiere as $num => $uneCase)
    	{
    		$ID = $uneCase['ID_Biere'] ;
    		if ($num == 0)
    		{
    			$SELECT_ID_Bar_fk = $SELECT_ID_Bar_fk." WHERE ID_Biere_fk = ".$ID ;
    		}
    		else 
    		{
    			$SELECT_ID_Bar_fk = $SELECT_ID_Bar_fk." OR ID_Biere_fk = ".$ID ;
    		}
    	} 
    	$reponse = $bdd->query($SELECT_ID_Bar_fk);
    		
    	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
    	$TabIdBar = $reponse->fetchAll() ;
	    
	    $indMax = (count($TabIdBar)) - 1;
		
		if ($indMax + 1 > 1)
    	{ 
			foreach ($TabIdBar as $num => $uneCase1) //je cherche les doublons
			{
		
				$ID_Bar1 = $uneCase1['ID_Bar_fk'];
				 
				foreach ($TabIdBar as $num2 => $uneCase2)
				{
					if (($num < $indMax) && ($num2 >= ($num+1))) // je ne dois pas faire le dernier tour ==> je dois noter un NumMax et jouer sur NumMax -1
					{
						$ID_Bar2 = $uneCase2['ID_Bar_fk'];
					 
							if ( $ID_Bar1==$ID_Bar2) // si je trouve un doublon je mets $num2 dans mon tableau de doubons
							{
								$Tab_Doublons[]=array("Indice_D" => $num2);
							}
					}
				}
			}
			foreach ($Tab_Doublons as $num => $unIndice) // je supprime les doublons de $Tab_id_bars
			{
				$indice=$unIndice['Indice_D'];
				
				foreach ($TabIdBar as $num2 => $uneID_Bar) 
				{
					if ($indice==$num2)
					{
						unset($TabIdBar[$num2]); 
					}	
				}
				
			}
		}
		
	}
	else  // si la requête ne produit pas de res  je mets le booléen a true ce qui empêche de générer des erreurs car je saute certaines étapes
	{
		$PasdeRes = true ; 
	}
	
	if (!$PasdeRes) // je filtre maintenant les Bars récupérer à l'étape précédente avec les filtres bars renseigner (idem étape filtre bar)
	{
		if (($prix != "Tous") && ($arrondissement != "Tous"))  // les 2 filtres rengeignés
		{
			$INNER_JOIN_BAR = $INNER_JOIN_BAR." WHERE Prix_fk = ".$prix." AND ID_Arrondissement_fk = ".$arrondissement." AND (" ;
		}
		else if (($prix == "Tous") && ($arrondissement != "Tous")) //filtre sur arrondissement
		{
			$INNER_JOIN_BAR = $INNER_JOIN_BAR." WHERE ID_Arrondissement_fk = ".$arrondissement." AND (" ;
		}
	    else if (($prix != "Tous") && ($arrondissement == "Tous"))  //filtre sur prix
	    {
			$INNER_JOIN_BAR = $INNER_JOIN_BAR." WHERE Prix_fk = ".$prix." AND (" ;
	    }
		foreach ($TabIdBar as $num => $uneCase)
		{
			$ID = $uneCase['ID_Bar_fk'];
			if ($num==0)
			{
				$INNER_JOIN_BAR = $INNER_JOIN_BAR." ID_Bar = ".$ID  ;
			}
			else
			{
				$INNER_JOIN_BAR = $INNER_JOIN_BAR." OR ID_Bar = ".$ID  ; 
			}
		}
		$INNER_JOIN_BAR = $INNER_JOIN_BAR." )" ;
	}
	
	$reponse = $bdd->query($INNER_JOIN_BAR);
		
	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
	$InfosBar = $reponse->fetchAll() ;
	
	$compte = count($InfosBar);
	
	if($compte == 0)
	{
		$PasdeRes = true ; 
	}
	
}
if ($PasdeRes)  // si la combinaison de filtre ne produit aucun résultat j'affiche un message le stipulant et je retourne un tableau vide pour éviter l'erreur de lecture du tableau.
{
	echo "Aucun Bar ne correspond à la recherche, désolé ! <br> ";
   	echo "Si vous avez un bon tuyau à partager n'hésitez à cliquer sur \"Se Connecter\" en haut à droite de la page ! ";
   	$InfosBar = array();
   	return $InfosBar ;
}
else // sinon je retourne le tab de res pour traitement
{
	return $InfosBar ;
}
}

function Info_Bar($ID)
{
include "BaseDonnees.php";

$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

$bdd->exec("SET CHARACTER SET utf8");

$INNER_JOIN_BAR = "SELECT ID_Bar, Nom_Bar, Num_Voie, Complement, Voie, Nom_Voie, Arrondissement, Ville, Prix, Presentation_Bar, Image_Bar, Horaires_Bar
				   FROM Bars 
				   INNER JOIN Types_Voie ON Type_Voie_fk = ID_Type 
				   INNER JOIN Complements_adresse ON Complement_adresse_fk = ID_Complement
				   INNER JOIN Arrondissements ON ID_Arrondissement_fk = ID_Arrondissement
				   INNER JOIN Villes ON ID_Ville_fk = ID_ville
				   INNER JOIN Prix ON Prix_fk = ID_Prix
				   WHERE ID_Bar = ".$ID ;
				   
	$reponse = $bdd->query($INNER_JOIN_BAR);
		
	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
	$InfosBar = $reponse->fetchAll() ;
	
	return $InfosBar ;	
}

function BieresDispo($ID) // retourne les bieres dispo pour un bar donné
{
include "BaseDonnees.php";

$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

$bdd->exec("SET CHARACTER SET utf8");

$SELECT_ID_Biere_fk = "SELECT ID_Biere_fk 
					   FROM Bieres_Par_Bars
					   WHERE ID_Bar_fk = ".$ID ;
					   
$SELECT_INFOS_BIERE = "SELECT *
					   FROM Bieres ";
					   

					   
$reponse = $bdd->query($SELECT_ID_Biere_fk); // recup des ID biere pour le bar correspondant

$reponse->setFetchMode(PDO::FETCH_ASSOC); 
$IDBieres = $reponse->fetchAll() ;	

foreach ($IDBieres as $num => $uneCase) // retourne les infos bieres pour le ou les id biere recupérées étape précédente
{
	$uneID = $uneCase['ID_Biere_fk'] ;
	if ($num==0)
	{
		$SELECT_INFOS_BIERE = $SELECT_INFOS_BIERE."WHERE ID_Biere = ".$uneID  ;
	}
	else
	{
		$SELECT_INFOS_BIERE = $SELECT_INFOS_BIERE." OR ID_Biere = ".$uneID ; 
	}

}

$reponse = $bdd->query($SELECT_INFOS_BIERE);

$reponse->setFetchMode(PDO::FETCH_ASSOC); 
$BieresDispo = $reponse->fetchAll() ;

return $BieresDispo ;				   
}

function AVG_Note($ID)  // retourne la moyenne des notes attribuées à un bar
{
include "BaseDonnees.php";

$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

$bdd->exec("SET CHARACTER SET utf8");

	$SELECT_AVG = "SELECT AVG(Note) 
				   FROM Evaluations
				   WHERE ID_Bar_fk = ".$ID ;
				   
$reponse = $bdd->query($SELECT_AVG);

$reponse->setFetchMode(PDO::FETCH_ASSOC); 
$Moyenne = $reponse->fetchAll() ;

return $Moyenne ;
}

function Comment_Bar($ID)  // retourne tous les comment d'un bar
{
    include "BaseDonnees.php";
    
    $bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));
    
    $bdd->exec("SET CHARACTER SET utf8");
    
    $SELECT_COMMENT = "SELECT ID_Bar_fk, Note, Commentaire, Pseudo_Membre
    				   FROM Evaluations
					   INNER JOIN Membres ON ID_Membre_fk = ID_Membre
    				   WHERE ID_Bar_fk = ".$ID ;
    
    $reponse = $bdd->query($SELECT_COMMENT);
    
    $reponse->setFetchMode(PDO::FETCH_ASSOC); 
    $COMMENTS = $reponse->fetchAll() ;
    
    $compte = count($COMMENTS) ;
    
    if ($compte == 0) // si pas de comment on retourne un tab vide
    {
    	$COMMENTS = array();
    	return $COMMENTS ;
    }
    else
    {
    	return $COMMENTS ; 
    }

}

function Insert_Biere ($NomBiere, $Robe, $Origine, $Degre, $Description)  // fonction pour insérer une proposition de biere
{
	$insertionOK = "Votre saisie d'une nouvelle bière sera traitée dans les plus brefs délais. Merci pour votre contribution ! " ;
	$insertionKO = "Oups, notre serveur (celui de la base de données...) semble avoir du mal à digérer tout cet alcool, réessayez !" ;
	
	include "BaseDonnees.php";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$INSERT = "INSERT INTO Proposition_Biere (ID_Biere_Prop, Nom_Biere_Prop, Origine_Prop_fk, Robe_Prop_fk, Degre_Prop, Presentation_Prop) 
			   VALUES (NULL, '".$NomBiere."', ".$Robe.", ".$Origine.", ".$Degre.", '".$Description."' ) ";
			   
	$reponse = $bdd->exec($INSERT);
	
	if ($reponse)
	{
		return $insertionOK ;
	}
	else
	{
		return $insertionKO ;
	}
}
function Insert_Bar ($NumVoie, $TypeVoie, $Nomvoie, $Complement, $Arrondissement, $Prix, $NomBar, $Site, $Horaires, $Description)  // fonction pour insérer une proposition de bar
{
	$insertionOK = "Votre saisie d'un nouveau bar sera traitée dans les plus brefs délais. Merci pour votre contribution ! " ;
	$insertionKO = "Oups, notre serveur (celui de la base de données...) semble avoir du mal à digérer tout cet alcool, réessayez !" ;
	
	include "BaseDonnees.php";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$INSERT = "INSERT INTO Proposition_Bar (ID_Prop_Bar, Num_Voie_Prop, Type_Voie_Prop_fk, Nom_Voie_Prop, Complement_Prop_fk, Arrondissement_Prop_fk, Prix_Prop_fk, Nom_Bar_Prop, Site_Bar_Prop, Horaire_Prop, Description_Prop) 
			   VALUES (NULL, ".$NumVoie.", ".$TypeVoie.", '".$Nomvoie."', ".$Complement.", ".$Arrondissement.", ".$Prix.", '".$NomBar."', '".$Site."', '".$Horaires."', '".$Description."') ";
	
	$reponse = $bdd->exec($INSERT);
	
	if ($reponse)
	{
		return $insertionOK ;
	}
	else
	{
		return $insertionKO ;
	}
}

function SELECT_COL_ADMIN($Table) // permet de récupérer les colonnes d'une table sélectionnée et de proposer les col à modif ensuite.
{
	include "BaseDonnees.php";
    
    // connexion sur information_schema
	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$INFOS_BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true)); 

	$bdd->exec("SET CHARACTER SET utf8");
	
	$SELECT_COL = "SELECT COLUMN_NAME FROM `COLUMNS` WHERE TABLE_NAME = ".$Table ;
	
	$reponse = $bdd->query($SELECT_COL);
    		
    $reponse->setFetchMode(PDO::FETCH_ASSOC); 
    $ColBar = $reponse->fetchAll() ;
	
	return $ColBar ;
}

function UPDATE_ADMIN ($Table, $Col, $Valeur, $ID) // met à jour un champ pour un enregistrement 
{
    
	include "BaseDonnees.php";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$UPDATEOK = "La modification a été prise en compte" ;
	$UPDATEKO = "La modification a échoué" ;
	
	if ($Table == "Bars")
	{
		$UPDATE = "UPDATE `".$Table."` SET `".$Col."` = '".$Valeur."' WHERE `".$Table."`.`ID_Bar` = ".$ID ;
	}
	else if ($Table == "Bieres")
	{
	    $UPDATE = "UPDATE `".$Table."` SET `".$Col."` = '".$Valeur."' WHERE `".$Table."`.`ID_Biere` = ".$ID ;
	}
	else  // modif de la table membre
	{
	    $UPDATE = "UPDATE `".$Table."` SET `".$Col."` = '".$Valeur."' WHERE `".$Table."`.`ID_Membre` = ".$ID ;
	}
	
	$reponse = $bdd->exec($UPDATE);
	
	if ($reponse)
	{
		return $UPDATEOK ;
	}
	else 
	{
		return $UPDATEKO ; 
	}
	
	
}

function DELETE_ADMIN ($Table, $ID)   // supprime un enregistrement d'une table 
{
	include "BaseDonnees.php";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$DELETEOK = "La suppression a été prise en compte" ;
	$DELETEKO = "La suppression a échoué" ;
	
	$DeleteMembre = false ;
	
	if ($Table == "Bars")  // cas suppression biere ou bar, il faut aussi supprimer la jointure correspondante dans bieres par bars.
	{
		$DELETE = "DELETE FROM `".$Table."` WHERE `".$Table."`.`ID_Bar` = ".$ID ;
		$DELETE_JOINTURE = "DELETE FROM `Bieres_Par_Bars` WHERE `Bieres_Par_Bars`.`ID_Bar_fk` = ".$ID ; 
		$reponse = $bdd->exec($DELETE);
    	$reponse2 = $bdd->exec($DELETE_JOINTURE);
 	
	}
	else if ($Table == "Bieres")
	{
		$DELETE = "DELETE FROM `".$Table."` WHERE `".$Table."`.`ID_Biere` = ".$ID ;
		$DELETE_JOINTURE = "DELETE FROM `Bieres_Par_Bars` WHERE `Bieres_Par_Bars`.`ID_Biere_fk` = ".$ID ; 
		$reponse = $bdd->exec($DELETE);
	    $reponse2 = $bdd->exec($DELETE_JOINTURE);
	}
	else  // modif de la table membre, il faut supprimer les commentaires liés au compte
	{
	    $DeleteMembre = true ;
		$DELETE = "DELETE FROM `".$Table."` WHERE  `".$Table."`.`ID_Membre` = ".$ID ;
		$DELETE_EVAL = "DELETE FROM `Evaluations` WHERE `Evaluations`.`ID_Membre_fk` = ".$ID ; // select pour vérifier si le membre à des commentaires
		echo $DELETE ;  // controllllllllllllllllllllllllllllllllllllllll
		echo "<br>"  ;  // controllllllllllllllllllllllllllllllllllllllll
		echo $DELETE_EVAL ;  // controllllllllllllllllllllllllllllllllllllllll
		echo "<br>"  ;  // controllllllllllllllllllllllllllllllllllllllll
		
		$SELECT_EVAL = "SELECT * FROM `Evaluations` WHERE ID_Membre_fk = ".$ID ; 
		
        $reponse = $bdd->query($SELECT_EVAL);

        $reponse->setFetchMode(PDO::FETCH_ASSOC); 
        $COMMENTS = $reponse->fetchAll() ;
        
        if (count($COMMENTS)>0) // s'il a des commentaires je les supprime
		{
		    $reponse3 = $bdd->exec($DELETE_EVAL);
		}
		$reponse = $bdd->exec($DELETE);
	}
	
	
	if ($DeleteMembre)
	{
		if ($reponse)  // 
		{
			return $DELETEOK ; 
		}
		else
		{
			return $DELETEKO ;
		}
	}
	else // un bar à forcément des correspondances avec des bières dans Bières_par_Bars et inversement
	{
		if (($reponse) && ($reponse2))
		{
			return $DELETEOK ; 
		}
		else
		{
			return $DELETEKO ;
		}
		
	}	
}

function ADMIN_CREA_BAR ($NomBar, $NumTel, $NumVoie, $TypeVoie, $Complement, $Nomvoie, $Arrondissement, $Ville, $Site, $Prix, $Horaires, $HorairesHH, $Description, $Image)
{
	$insertionOK = "Le bar ".$NomBar." a bien été enregistré" ;
	$insertionKO = "Echec de l'enregistrement ".$NomBar ;
	
	include "BaseDonnees.php";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$INSERT = "INSERT INTO Bars (ID_Bar, Nom_Bar, Num_Tel, Num_Voie, Type_Voie_fk, Complement_adresse_fk, Nom_Voie, ID_Arrondissement_fk, ID_Ville_fk, Site_Bar, Prix_fk, Horaires_Bar, Horaire_HH, Presentation_Bar, Image_Bar) 
			   VALUES (NULL, '".$NomBar."', '".$NumTel."', ".$NumVoie.", ".$TypeVoie.", ".$Complement.", '".$Nomvoie."', ".$Arrondissement.", ".$Ville.", '".$Site."', ".$Prix.", '".$Horaires."', '".$HorairesHH."', '".$Description."', '".$Image."') ";
			   
	
	$reponse = $bdd->exec($INSERT);
	
	if ($reponse)
	{
		return $insertionOK ;
	}
	else
	{
		return $insertionKO ;
	}
}

function ADMIN_CREA_BIERE ($NomBiere, $Origine, $Robe, $Degre, $Description, $Image)
{
	$insertionOK = "La bière ".$NomBiere." a bien été enregistrée" ;
	$insertionKO = "Echec de l'enregistrement ".$NomBiere ;
	
	include "BaseDonnees.php";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$INSERT = "INSERT INTO Bieres (ID_Biere, Nom_Biere, Origine_fk, Robe_fk, Degre, Presentation_Biere, Image_Biere) 
			   VALUES (NULL, '".$NomBiere."', ".$Origine.", ".$Robe.", ".$Degre.", '".$Description."', '".$Image."' ) ";
			   
	$reponse = $bdd->exec($INSERT);
	
	if ($reponse)
	{
		return $insertionOK ;
	}
	else
	{
		return $insertionKO ;
	}
}


function UPDATE_MDP ($ID, $MDP)
{
	$MDPOK = "Le mot de passe a été modifié." ;
	$MDPKO = "La modification a échoué ! " ;
	include "BaseDonnees.php";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$UPDATE = "UPDATE `Membres` SET `Mdp_Membre` = '".$MDP."' WHERE `Membres`.`ID_Membre` = ".$ID ;
	
	$reponse = $bdd->exec($UPDATE);
	
	if ($reponse)
	{
		return $MDPOK ;
	}
	else
	{
		return $MDPKO ;
	}	
}
function INSERT_EVAL ($IDMembre, $IDBar, $Note, $Commentaire)
{
	include "BaseDonnees.php";
	
	$CommentaireOK = "Commentaire inséré";
	$CommentaireKO = "Echec de l'engistrement du commentaire";

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$INSERT_COMMENT = "INSERT INTO `Evaluations` (`ID_Membre_fk`, `ID_Bar_fk`, `Note`, `Commentaire`, `Date_Commentaire`) VALUES (".$IDMembre.", ".$IDBar.", ".$Note.", '".$Commentaire."', NULL)";
	
	
	$reponse = $bdd->exec($INSERT_COMMENT);
	
	if ($reponse)
	{
		return $CommentaireOK ;
	}
	else
	{
		return $CommentaireKO ;
	}
}


function Recup_Identifiants ($Pseudo)
{
	include "BaseDonnees.php";
	
	$PasdeRes = "Le pseudo renseigné est inconnu" ;

	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");
	
	$Recup = "SELECT * FROM `Membres` WHERE `Pseudo_Membre` = '".$Pseudo."'" ; 
	
	$reponse = $bdd->query($Recup);
	
	$reponse->setFetchMode(PDO::FETCH_ASSOC); 
   	$TabFinal = $reponse->fetchAll() ;
   	
   	if (count($TabFinal) == 0)
   	{
   	    return $PasdeRes ;
   	}
	else
	{
	    return $TabFinal; 
	}

}

?>