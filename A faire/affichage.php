<?php

/*
 * Cette page affiche la liste des personnes suivies d'un lien Supprimer
 * Au clic, la personne est supprim�e de la liste qui est rafra�chie
 * Sous la liste :
 * - 1 lien "R�initialiser" : Remet la liste d'origine
 * - 1 lien "D�connexion" : Renvoie sur la page de connexion et supprime la session
 * 
 * date modification : 6 juin 2019
 *
 */

 // D�marrage de la session (avant l'affichage)
session_start();
// $affichage permet de g�rer le type d'affichage
// Si true : affichage de la liste des personnes avec le lien
// Si false : erreur de connexion (par d�faut)
$affichage = false;
// $affichage est true quand le nom et le prenom sont en session
if (isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) && $_SESSION["nom"] != "" && $_SESSION["prenom"] != "") {
    $affichage = true;
}

// Si $affichage est true, traitement et affichage de la liste et des liens
if ($affichage) {
	
    // Pour la suppression de la personne apr�s le clic sur le lien Supprimer devant un nom
	// Suppression dans le tableau gr�ce � la fonction PHP unset()
    if (isset($_GET["id"]) && $_GET["id"] != "") {
        if (array_key_exists($_GET["id"], $_SESSION["tab_personnes"])) {
            unset($_SESSION["tab_personnes"][$_GET["id"]]);
        }
    }
	
    // R�initialisation de la liste
    else if (isset($_GET["reinit"]) && $_GET["reinit"] == "1") {
        $_SESSION["tab_personnes"] = $_SESSION["tab_personnes_orig"];
    }
	
	/////////////////////////
	// DEBUT PARTIE AFFICHAGE
	/////////////////////////
    // Affichage de la personne connect�e
    echo "Connect&eacute; :  " . strtoupper($_SESSION["nom"]) . " " . $_SESSION["prenom"];
    // Affichage de la liste des personnes
    $num = 1;
    foreach ($_SESSION["tab_personnes"] AS $personne) {
        echo "<br />" . $num . "/ " . $personne["nom"] . " " . $personne["prenom"] . " <a href=\"affichage.php?id=" . $personne["id"] . "\">Supprimer</a>";
        $num++;
    }
    // Lien de r�initialisation
    echo "<br /><a href=\"affichage.php?reinit=1\">R&eacute;initialiser</a>";
    // Lien de d�connexion
    echo "<br /><a href=\"connexion.php?deconnex=1\">D&eacute;connexion</a>";
	///////////////////////
	// FIN PARTIE AFFICHAGE
	///////////////////////	
	
}
// Si $affichage est false, affichage message renvoyant sur page de connexion
else {
    echo "Erreur de connexion, retour vers la <a href=\"connexion.php\">page de connexion</a>";
}
?>