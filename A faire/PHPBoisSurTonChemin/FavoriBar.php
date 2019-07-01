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
			AjoutBarFavori($_SESSION['ID_Membre'],$_GET['ID']);	
			$Message = "Un nouveau bar rajouté à vos petits papiers, TCHIN!";
		}
		else if($_GET['action'] == "supprime")
		{
			SuppressionBarFavori($_SESSION['ID_Membre'],$_GET['ID']);
			$Message = "Bar supprimé. Mince alors";
		}
		
		$_SESSION['Message'] = $Message;

header('Location: Bars.php');
exit();
?>