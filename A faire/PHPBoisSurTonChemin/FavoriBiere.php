<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
include 'PHP/BaseDonnees.php';
include 'PHP/Fonctions.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
		if($_GET['action'] == "ajout")
		{
			AjoutBiereFavorite($_SESSION['ID_Membre'],$_GET['ID']);	
			$Message = "Une nouvelle bière rajoutée à vos favoris, TCHIN!";
		}
		else if($_GET['action'] == "supprime")
		{
			SuppressionBiereFavorite($_SESSION['ID_Membre'],$_GET['ID']);
			$Message = "Bière supprimée des favoris. Lendemain de gueule de bois ?";
		}
		
		$_SESSION['Message'] = $Message;

header('Location: Bieres.php');
exit();
?>