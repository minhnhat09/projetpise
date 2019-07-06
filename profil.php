<?php

/*************************
      Page: profil.php
 **************************/
if (!isset($_SESSION)) {
    session_start();
}
include("include/fonction.php");
//Menu -->
include("include/header.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

if (!membreEstConnecte()) header("location:connexion.php");
$pseudo = $_SESSION['membre']['pseudo'];
$mail = $_SESSION['membre']['mail'];

//--------------------------------- AFFICHAGE HTML ---------------------------------//

?>
<main>
    <div class="wrapper">
        <section class="livrer">

            <div class="concept-linkbox-squre1">

                <h2>Espace membre</h2>
            </div>
            <h3> Voici vos informations </h3>

            <p> Votre email est: <?php echo $mail ?> <br />
                <p> Votre pseudo est: <?php echo $pseudo ?> <br />
                    <p><?php if (membreEstConnecteEtEstAdmin()) {
                            //echo '<h3><br/><a href="gestion-membre.php">Gestion des membres</a></h3>';
                            echo '<h3><br/><a href="gestion-oeuvres.php">Gestion des produits</a></h3>';
                        } ?></p>
        </section>
</main>
<!-- Pied de la page -->
<?php
include("include/footer.php");
?>