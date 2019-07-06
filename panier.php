<?php

/*************************
      Page: panier.php
 **************************/
if (!isset($_SESSION)) {
    session_start();
}
include("include/fonction.php");
include("include/header.php");


//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if (isset($_POST['ajout_panier'])) {
    $dataOeuvre = ListeParID("oeuvre", "ID_Oeuvre", "=", $_POST['ID_Oeuvre']);
    foreach ($dataOeuvre as $num => $Oeuvre) {
        ajouterOeuvreDansPanier($Oeuvre['Nom_Oeuvre'], $_POST['ID_Oeuvre'], $_POST['quantite'], $Oeuvre['Prix']);
    }
}
//--- VIDER PANIER ---//
if (isset($_GET['action']) && $_GET['action'] == "vider") {
    unset($_SESSION['panier']);
}
//--- SUPPRIMER UNE OEUVRE ---//
if (isset($_GET['action']) && $_GET['action'] == "retirer") {
    for ($i = 0; $i < count($_SESSION['panier']['ID_Oeuvre']); $i++) {
        retirerProduitDuPanier($_SESSION['panier']['ID_Oeuvre'][$i]);
    }
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo "<main>";
echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Récapitulatif de votre commande</td></tr>";
echo "<tr><th>Oeuvre d'art</th><th>Quantité</th><th>Prix Unitaire</th><th>Action</th></tr>";
if (empty($_SESSION['panier']['ID_Oeuvre'])) // panier vide
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
} else {

    for ($i = 0; $i < count($_SESSION['panier']['ID_Oeuvre']); $i++) {
        echo "<tr>";
        echo "<td>" . $_SESSION['panier']['Nom_Oeuvre'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['QteOeuvre'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['Prix'][$i] . "</td>";
        echo "<td><a href='?action=retirer'>retirer</a></td>";

        echo "</tr>";
    }
    echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " euros</td></tr>";

    if (membreEstConnecte()) {
        echo '<form method="post" action="">';
        echo '<tr><td colspan="4"><input type="submit" name="payer" value="Valider mon panier"></td></tr>';
        echo '</form>';
    } else {
        echo '<tr><td colspan="4">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
    }
    echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a> OU <a href='toutes-collections.php'>Continuer mes achats</a></td></tr>";
}
echo "</table><br/></main>";
