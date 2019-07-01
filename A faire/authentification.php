<?php

/*
 * Cette page sert de passage entre la page de connexion et la page affichant la liste des personnes
 * Avec vérification de l'authentification
 * Affichage des messages si authentification ok
 * 
 * date modification : 6 juin 2019
 *
 */

// $affichage permet de gérer le type d'affichage
// Si true : affichage de la liste des personnes avec le lien
// Si false : erreur de connexion (par défaut)
$affichage = false;
// Création du tableau avec les personnes
$tab_personnes = array();
// S'il ya des données de connexion (via $_POST)
if (isset($_POST["identifiant"]) && isset($_POST["mot_de_passe"]) && htmlspecialchars($_POST["identifiant"]) != "" && htmlspecialchars($_POST["mot_de_passe"]) != "") {
	// Inclusion du fichier des fonctions
    include("fonction.php");
    // Appel de la fonction de connexion à la BDD
    $bdd = "test";
    $login = "root";
    $mdp = "";
    $obj_connexion = connexion_bdd($bdd, $login, $mdp);
    // Appel de la fonction de select
    $tab_personnes = select_bdd($obj_connexion);
    // Vérification que l'identifiant et le mot de passe sont dans la table personne
    foreach ($tab_personnes AS $personne) {
        if ($_POST["identifiant"] == $personne["nom"] && $_POST["mot_de_passe"] == $personne["prenom"]) {
            $affichage = true;
            break;
        }
    }
}

// Si $affichage est true, traitement et affichage des messages et liens
if ($affichage) {
	// Démarrage de la session (avant l'affichage)
    session_start();
	// Récupération des données et mises en session pour les utiliser sur d'autres pages
    $_SESSION["nom"] = strtoupper(htmlspecialchars($_POST["identifiant"]));
    $_SESSION["prenom"] = htmlspecialchars($_POST["mot_de_passe"]);
    $_SESSION["tab_personnes"] = $tab_personnes;
    $_SESSION["tab_personnes_orig"] = $tab_personnes;
	
	/////////////////////////
	// DEBUT PARTIE AFFICHAGE
	/////////////////////////
    echo "Bonjour " . $_SESSION["nom"] . " " . $_SESSION["prenom"];
    echo "<br />Votre connexion est accept&eacute;e.";
    echo "<br />Pour continuer, cliquez sur le lien <a href=\"affichage.php\">suivant</a>";
	///////////////////////
	// FIN PARTIE AFFICHAGE
	///////////////////////
	
	// Suppression des données de $_POST
    unset($_POST["identifiant"]);
    unset($_POST["mot_de_passe"]);
}
// Si $affichage est false, affichage message renvoyant sur page de connexion
else {
    echo "Erreur de connexion, retour vers la <a href=\"connexion.php\">page de connexion</a>";
}
?>