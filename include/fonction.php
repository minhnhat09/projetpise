<?php

function Inscription($Pseudo,$MotDePasse,$Mail)
{
  include "db_params.php";
  $InsertionOK = True;
  try
  {

   $bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));  
   $bdd->exec("SET CHARACTER SET utf8");  
   // la requ�te d'insertion des donn�es membres
   $req = "INSERT INTO ".$MEMBRES." (id_membre, pseudo, mdp, mail) VALUES (NULL,'".$Pseudo."','".$MotDePasse."','".$Mail."')" ; 
   $resultat = $bdd->prepare($req);
   $resultat->execute();
   // --- traitement des erreurs de retour sur la requ�te ---
   if (!$resultat)
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

function VerifPseudo($Pseudo)  // permet de r�cup�rer tous les pseudos et par la suite de tester si le nouveau pseudo est d�j� existant
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
function Connexion($Pseudo,$Mdp) 
{ 
  	include "db_params.php";
  
	$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

	$bdd->exec("SET CHARACTER SET utf8");

	$resultat = $bdd->prepare('SELECT * FROM '.$MEMBRES." WHERE pseudo='".$Pseudo."'");
	$resultat->execute();
	
	$donnees = $resultat->fetch();
	
	if($donnees)
	{
    
    if($donnees['mdp'] == $Mdp)
        {   //créer une session avec les éléments de la base de données
            foreach($donnees as $indice => $element)
            {   //condition pour ne pas pas prendre mdp dans la session
                if($indice != 'mdp')
                {
                    $_SESSION['membre'][$indice] = $element;
                }
            }
            $contenu="Vous êtes connecté";
            header("location:profil.php");
        }
        else
        {
            $contenu = "Mauvais mot de passe";
        }       
	}
	else
	{
    $contenu = "Mauvais identifiant";
	}

	return $contenu;
}

function ListeTab($Tabcherche,$Col)
{
  include "db_params.php";
  $Tabfinal = array();
  
  try
  {
   $bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));
   
   $bdd->exec("SET CHARACTER SET utf8");  

   $Requete_SQL = 'SELECT'.$Col."FROM ".$Tabcherche ;
   $resultat = $bdd->prepare($Requete_SQL); 
	$resultat->execute();
   
   // --- traitement des erreurs de retour sur la requête ---
   if (!$resultat)
   {
     echo "Problème de requête sur la table";
   }
   // --- un tableau associatif ---
   //$resultat->setFetchMode(PDO::FETCH_ASSOC); 
  //$Tabfinal = $resultat->fetchAll() ;
  }
  catch(Exception $e)
  {
   echo 'Erreur de connexion avec la base : '.$BASE;
  }
  return  $resultat ;
}


function ListeParID($Table,$Col,$ID)  // fonction de r�cup�ration de peinture, scupture, photographie
{ 
  	include "db_params.php";  
  			
  		$TabFiltres = array();
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'SELECT * FROM '.$Table." WHERE ".$Col." = '".$ID."'";
		$resultat = $bdd->prepare($Requete_SQL);
		$resultat->execute();
		//$resultat->setFetchMode(PDO::FETCH_ASSOC); 
   	$TabFiltres = $resultat->fetchAll() ;
   		
   		return $TabFiltres;
		
}

// permettre de savoir si le membre est connecté
function membreEstConnecte()
{ 
    if(!isset($_SESSION['membre'])) return false;
    else return true;
}

//permettre de savoir si l'internaute est connecté en tant qu'administrateur (statut a 1) ou en tant que membre (statut a 0)
function membreEstConnecteEtEstAdmin()
{
    if(membreEstConnecte() && $_SESSION['membre']['statut'] == 1) return true;
    else return false;
}
//permet d'ajouter une oeuvre
function AjoutOuModifierOeuvre($ID_Oeuvre,$Nom_Oeuvre,$Cat_Oeuvre,$Taille,$Prix,$Artiste,$Img_Oeuvre)
{ 
  include "db_params.php";  		
  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

    $bdd->exec("SET CHARACTER SET utf8");
    //replace se comporte soit en insert soit en update.Si l'id est connu alors ce sera un update(une modif).Si l'id n'est pas connu alors ce sera un insert(un ajout).
    if($ID_Oeuvre==NULL)
    $Requete_SQL = 'REPLACE INTO '.$OEUVRE." (ID_Oeuvre,Nom_Oeuvre,Cat_Oeuvre,Taille,Prix,Artiste,Img_Oeuvre) VALUES (NULL,'".$Nom_Oeuvre."','".$Cat_Oeuvre."','".$Taille."','".$Prix."','".$Artiste."','".$Img_Oeuvre."')" ;
    else
    $Requete_SQL = 'REPLACE INTO '.$OEUVRE." (ID_Oeuvre,Nom_Oeuvre,Cat_Oeuvre,Taille,Prix,Artiste,Img_Oeuvre) VALUES ('".$ID_Oeuvre."','".$Nom_Oeuvre."','".$Cat_Oeuvre."','".$Taille."','".$Prix."','".$Artiste."','".$Img_Oeuvre."')" ;

    $bdd->exec($Requete_SQL);	
}

//permet de supprimer une oeuvre
function SuppressionOeuvre($ID_Oeuvre)
{ 
    include "db_params.php";  		
		$bdd = new PDO($TYPEBD.':host='.$SERVEUR.';dbname='.$BASE,$LOGIN,$MDP,array(PDO::ATTR_PERSISTENT => true));

		$bdd->exec("SET CHARACTER SET utf8");
		
		$Requete_SQL = 'DELETE FROM '.$OEUVRE." WHERE ID_Oeuvre ='".$ID_Oeuvre."'"; ;
    $bdd->exec($Requete_SQL);	

}

function creationPanier(){
  if (!isset($_SESSION['panier'])){
     $_SESSION['panier']=array();
     $_SESSION['panier']['ID_Oeuvre'] = array();
     $_SESSION['panier']['Nom_Oeuvre'] = array();
     $_SESSION['panier']['QteOeuvre'] = array();
     $_SESSION['panier']['Prix'] = array();
     //$_SESSION['panier']['verrou'] = false;
  }
}

function ajouterOeuvreDansPanier($nom,$id, $quantite, $prix)
{
    creationPanier(); 
    $position_Article = array_search($nom,$_SESSION['panier']['Nom_Oeuvre']);
    if($position_Article !== false)
    {
         $_SESSION['panier']['QteOeuvre'][$position_Article] += $quantite ;
    }
    else
    {
        $_SESSION['panier']['Nom_Oeuvre'][] = $nom;
        $_SESSION['panier']['ID_Oeuvre'][] = $id;
        $_SESSION['panier']['QteOeuvre'][] = $quantite;
        $_SESSION['panier']['Prix'][] = $prix;
    }
}
function montantTotal()
{
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['Nom_Oeuvre']); $i++)
   {
      $total += $_SESSION['panier']['QteOeuvre'][$i] * $_SESSION['panier']['Prix'][$i];
   }
   return round($total,2); 
}

function retirerProduitDuPanier($id_Oeuvre_a_supprimer)
{
    $position_Article = array_search($id_Oeuvre_a_supprimer,  $_SESSION['panier']['ID_Oeuvre']);
    if ($position_Article !== false)
    {
        array_splice($_SESSION['panier']['Nom_Oeuvre'], $position_Article, 1);
        array_splice($_SESSION['panier']['ID_Oeuvre'], $position_Article, 1);
        array_splice($_SESSION['panier']['QteOeuvre'], $position_Article, 1);
        array_splice($_SESSION['panier']['Prix'], $position_Article, 1);
    }
}



?>