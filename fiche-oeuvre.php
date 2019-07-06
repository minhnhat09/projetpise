<?php
if (!isset($_SESSION)) {
    session_start();
}
// Appel de la fonction de connexion à la BDD
include("include/fonction.php");
//Menu--> 
include("include/header.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
?>
<?php

if (isset($_GET['ID_Oeuvre'])) {
    $requeteUneOeuvre = ListeParID("oeuvre", "ID_Oeuvre", "=", $_GET['ID_Oeuvre']);
    $resultat = $requeteUneOeuvre->fetch();
}
if (count($resultat) == 0) {
    header("location:collection-par-categorie.php");
    exit();
}

$nom = $resultat['Nom_Oeuvre'];
$categorie = $resultat['Cat_Oeuvre'];
$taille = $resultat['Taille'];
$img = $resultat['Img_Oeuvre'];
$artiste = $resultat['Artiste'];
$prix = $resultat['Prix'];
$ID_Oeuvre = $_GET['ID_Oeuvre'];


?>
<!--//--------------------------------- AFFICHAGE HTML ---------------------------------//-->
<main>
    <section class="peinture1-box">
        <div class="wrapper">
            <h2><?php echo $nom; ?></h2>
            <div class="peinture1-box-squre">
                <img src='<?php echo $img ?>'='150' height='150'>
            </div>
            <div class="peinture1-box-rectangle">
                <h3><?php echo $artiste; ?></h3>

                <p><br><?php echo $taille; ?><br>Oeuvre unique</p>
                <div class="peinture1-box-squre2">
                    <h3><?php echo $prix; ?>€</h3>

                    <br>
                    <p>Livraison sous 1 à 2 semaines <br>
                        15 jours pour tester l'œuvre chez vous - retour gratuit</p>
                </div>
            </div>
            <form method="post" action="panier.php">
                <input type='hidden' name='ID_Oeuvre' value='<?php echo $_GET["ID_Oeuvre"] ?>'>
                <label for="quantite">Quantité : </label>
                <select id="quantite" name="quantite">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <input type="submit" name="ajout_panier" value="ajout au panier">
            </form>
            <br><a href='collection-par-categorie.php?categorie=<?php echo $resultat['Cat_Oeuvre'] ?>'>Retour vers la séléction de <?php echo $resultat['Cat_Oeuvre'] ?></a>

            </form>
        </div>

</main>

<?php
//Pied de la page -->

include("include/footer.php");
?>