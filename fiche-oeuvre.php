<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

    // Appel de la fonction de connexion à la BDD
include("include/fonction.php");

	//Menu--> 
		include("include/header.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['ID_Oeuvre']))  
{ 
	$resultat = ListeParID("oeuvre","ID_Oeuvre",$_GET['ID_Oeuvre']);
}
if(count($resultat)== 0) { header("location:collection-par-categorie.php"); exit(); }

$contenu .= "<h2>Titre : ".$resultat[0]['Nom_Oeuvre']."</h2><hr><br>";
$contenu .= "<p>Categorie: ".$resultat[0]['Cat_Oeuvre']."</p>";
$contenu .= "<p>Taille:". $resultat[0]['Taille']."</p>";
$contenu .= "<img src='".$resultat[0]['Img_Oeuvre']."' ='150' height='150'>";
$contenu .= "<p><i>Artiste:". $resultat[0]['Artiste']."</i></p><br>";
$contenu .= "<p>Prix :". $resultat[0]['Prix'] ."€</p><br>";
 

    $contenu .= '<form method="post" action="panier.php">';
        $contenu .= "<input type='hidden' name='ID_Oeuvre' value='$_GET[ID_Oeuvre]'>";
        $contenu .= '<label for="quantite">Quantité : </label>';
        $contenu .= '<select id="quantite" name="quantite">';
        for($i = 1; $i <= 5; $i++)
            {
                $contenu .= "<option>$i</option>";
            }
        $contenu .= '</select>';
        $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier">';
    $contenu .= '</form>';
$contenu .= "<br><a href='collection-par-categorie.php?categorie=" . $resultat[0]['Cat_Oeuvre'] . "'>Retour vers la séléction de " . $resultat[0]['Cat_Oeuvre'] . "</a>";
//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;


		//Pied de la page -->

			include ("include/footer.php");
		?>
 