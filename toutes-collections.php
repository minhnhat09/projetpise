<?php
// Appel de la fonction de connexion à la BDD
include("include/fonction.php");
if (!isset($_SESSION)) {
	session_start();
}
?>
<!--Menu-->
<?php
include("include/header.php");
?>

<main>
	<section class="peinture-links">
		<div class="wrapper">
			<h2 class="collection">Toutes les oeuvres</h2>

			<?php
			//Appel fonction ListeTab pour récupérer les données dans BDD
			$Tab = ListeTab("oeuvre", "*");
			$Tab = $Tab->fetchAll();
			foreach ($Tab as $num => $UneOeuvre) {

				$ID_Oeuvre = $UneOeuvre['ID_Oeuvre'];
				$Nom = $UneOeuvre['Nom_Oeuvre'];
				$Categorie = $UneOeuvre['Cat_Oeuvre'];
				$Taille = $UneOeuvre['Taille'];
				$Prix = $UneOeuvre['Prix'];
				$Artiste = $UneOeuvre['Artiste'];
				$Image = $UneOeuvre['Img_Oeuvre'];

				?>
				<a href="fiche-oeuvre.php?ID_Oeuvre=<?php echo $UneOeuvre['ID_Oeuvre'] ?>">
					<div class="peinture-link">
						<img src="<?php echo "$Image" ?>">
						<p class="p1"><?php echo "$Nom" ?></p>
						<p class="p1"><?php echo "$Prix" ?> €</p>
					</div>
				</a>
			<?php
			}
			?>

		</div>
	</section>

</main>
</div>
</div>
<!-- Pied de la page -->
<?php
include("include/footer.php");
?>