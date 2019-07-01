<?php

/*************************
      Page: profil.php
 **************************/
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("include/fonction.php");
    include("include/header.php");

//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!membreEstConnecte()) header("location:connexion.php");
$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '</strong></p>';
$contenu .= '<div class="cadre"><h2> Voici vos informations </h2>';
$contenu .= '<p> votre email est: ' . $_SESSION['membre']['mail'] . '<br>';

//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;
include("include/footer.php");
?>