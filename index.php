<?php include("include/fonction.php");
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
?>

	<!--Menu-->
	<?php include("include/header.php");?>
		<main>
		 <section class="index-banner">
		   <div class="vertical-center">
		   <a href="toutes-collections.php">
		     <button class="btn">VOIR TOUTES NOS OEUVRES</button>
		   </a>
			 <h2>DÉCOUVREZ ET ACHETEZ L’ART QUE VOUS AIMEZ</h2>
			   <h1>Nos experts dénichent pour vous les meilleurs artistes contemporains</h1>
			</div> 
		 </section>
		 <div class="wrapper">
		     <h2>Nos oeuvres à vendre par catégorie</h2>
		     <section class="index-links">
				   <a href="collection-par-categorie.php?categorie=Peinture">
					  <div class="index-linkbox-squre5">
						<h3>peinture</h3>
					  </div>
				   </a>
				   <a href="collection-par-categorie.php?categorie=Sculpture">
					  <div class="index-linkbox-rectangle3">
						<h3>sculpture</h3>
					  </div>
				   </a>
				   <a href="artistes.php">
					  <div class="index-linkbox-squre6">
						<h3>artiste</h3>
					  </div>
				   </a>
				   <a href="collection-par-categorie.php?categorie=Photographie">
					  <div class="index-linkbox-rectangle4">
						<h3>photographie</h3>
					  </div>
				   </a>
				</section>
				<h2 class="index-price">Nos oeuvres à vendre par prix</h2>
				<section class="index-links2">
				   <a href="collection-par-prix.php?prix=40">
					  <div class="index-linkbox-rectangle1">
						<h3>Moins de 40 €</h3>
					  </div>
				   </a>
				   <a href="collection-par-prix.php?prix=50">
					  <div class="index-linkbox-squre1">
						<h3>Moins de 50 €</h3>
					  </div>
				   </a>
				   <a href="collection-par-prix.php?prix=60">
					  <div class="index-linkbox-squre2">
						<h3>Moins de 60 €</h3>
					  </div>
				   </a>
				   <a href="collection-par-prix.php?prix=70">
					  <div class="index-linkbox-squre3"">
						<h3>Moins de 70 €</h3>
					  </div>
				   </a>
				   <a href="collection-par-prix.php?prix=90">
					  <div class="index-linkbox-squre4">
						<h3>Moins de 90 €</h3>
					  </div>
				   </a>
				   <a href="collection-par-prix.php?prix=500">
					  <div class="index-linkbox-rectangle2"">
						<h3>Moins de 500</h3>
					  </div>
				   </a>
				</section>
				</div>
				</main>
		<!-- Pied de la page -->
				<?php include ("include/footer.php");?>
