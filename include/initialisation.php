<?php
  include "db_params.php";
  include  "fonction.php";
  try
  {
   $bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));  
   $bdd->exec("SET CHARACTER SET utf8");  
  }
  catch(Exception $e)
  {
   $InsertionOK = False;   
  }


function VerifPseudo($Pseudo)  // permet de récupérer tous les pseudos et par la suite de tester si le nouveau pseudo est déjà existant
{ 
  	include "db_params.php";
  
	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");

	$resultat = $bdd->prepare('SELECT * FROM '.$MEMBRES." WHERE pseudo='".$Pseudo."'");
	$resultat->execute();
	
	$donnees = $resultat->fetch();
	
	if($donnees)
	{
		$VerifUnique = false;
	}
	else
	{
		$VerifUnique = true;
	}

	return $VerifUnique;
}

function ListeTab($Tabcherche)
{
  include "db_params.php";
  $Tabfinal = array();
  
  try
  {

   $bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));
   
   $bdd->exec("SET CHARACTER SET utf8");  

   $Requete_SQL = 'SELECT * FROM '.$Tabcherche ;
   $resultat = $bdd->query($Requete_SQL); 
	$resultat->exec();
   
   // --- traitement des erreurs de retour sur la requête ---
   if (!$resultat)
   {
     echo "Problème de requête sur la table";
   }
   // --- un tableau associatif ---
   $resultat->setFetchMode(PDO::FETCH_ASSOC); 
   $Tabfinal = $resultat->fetchAll() ;
  }
  catch(Exception $e)
  {
   echo 'Erreur de connexion avec la base : '.$BASE;
  }
  return  $Tabfinal ;
}


function ListeParCategorie($Table,$Col,$MotRecherche)  // fonction de récupération de peinture, scupture, photographie
{ 
  	include "db_params.php";  
  			
  		$TabFiltres = array();
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'SELECT * FROM '.$Table." WHERE ".$Col." LIKE '%".$MotRecherche."%'";
		$resultat = $bdd->query($Requete_SQL);
		
		$resultat->setFetchMode(PDO::FETCH_ASSOC); 
   		$TabFiltres = $resultat->fetchAll() ;
   		
   		return $TabFiltres;
		
}

?>