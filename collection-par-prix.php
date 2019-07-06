<?php
if (!isset($_SESSION)) {
	session_start();
}
// Appel de la fonction de connexion à la BDD
include("include/fonction.php");

?>
<!--Menu-->
<?php
include("include/header.php");
?>

<main>
	<section class="peinture-links">
		<div class="wrapper">

			<h2>Les Œuvres</h2>
			<?php
			//--------------------------------- TRAITEMENTS PHP ---------------------------------//
			//--- DES PRIX---//
			//Appel fonction ListeTab pour récupérer les données dans BDD
			$Tab = ListeTab("oeuvre", " DISTINCT Prix ");
			while ($dataPrix = $Tab->fetch()) {
				$contenu = "<a href='?prix=" . $dataPrix['Prix'] . "'>" . $dataPrix['Prix'] . "</a>";
			}
			//--- AFFICHAGE DES OEUVRES ---//
			if (isset($_GET['prix'])) {
				$ListeOeuvre = ListeParID("oeuvre", "Prix", " <=", (int) $_GET['prix']);
				while ($TabOeuvre = $ListeOeuvre->fetch()) {
					?>
					<a href="fiche-oeuvre.php?ID_Oeuvre=<?php echo $TabOeuvre['ID_Oeuvre'] ?>">
						<div class="peinture-link">
							<img src="<?php echo $TabOeuvre['Img_Oeuvre'] ?>">
							<p class="p1"><?php echo $TabOeuvre['Nom_Oeuvre'] ?></p>
							<p class="p1"><?php echo $TabOeuvre['Prix'] ?> €</p>

						</div>
					</a>
				<?php
				}
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