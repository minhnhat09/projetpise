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
		     <button class="btn">JE DÉCOUVRE</button>
			 <h2>DÉCOUVREZ ET ACHETEZ L’ART QUE VOUS AIMEZ</h2>
			   <h1>Nos experts dénichent pour vous les meilleurs artistes contemporains</h1>
			</div> 
		 </section>
		 <div class="wrapper">
		     <h2>Nos oeuvres à vendre par catégorie</h2>
		     <section class="index-links">
				   <a href="collection-par-categorie.php?categorie=Peinture">
					  <div class="index-linkbox-squre5">
						<h3>peintures</h3>
					  </div>
				   </a>
				   <a href="collection-par-categorie.php?categorie=Sculpture">
					  <div class="index-linkbox-rectangle3">
						<h3>sculptures</h3>
					  </div>
				   </a>
				   <a href="artistes.php">
					  <div class="index-linkbox-squre6">
						<h3>artistes</h3>
					  </div>
				   </a>
				   <a href="collection-par-categorie.php?categorie=Photographie">
					  <div class="index-linkbox-rectangle4">
						<h3>photographies</h3>
					  </div>
				   </a>
				</section>
				<h2 class="index-price">Nos oeuvres à vendre par prix</h2>
				<section class="index-links2">
				   <a href="30.html">
					  <div class="index-linkbox-rectangle1">
						<h3>jusqu'à 30</h3>
					  </div>
				   </a>
				   <a href="30-50.html">
					  <div class="index-linkbox-squre1">
						<h3>€30-€50</h3>
					  </div>
				   </a>
				   <a href="50-70.html">
					  <div class="index-linkbox-squre2">
						<h3>€50-€70</h3>
					  </div>
				   </a>
				   <a href="70-90.html">
					  <div class="index-linkbox-squre3"">
						<h3>€70-€90</h3>
					  </div>
				   </a>
				   <a href="90-150.html">
					  <div class="index-linkbox-squre4">
						<h3>€90-€150</h3>
					  </div>
				   </a>
				   <a href="plusde150.html">
					  <div class="index-linkbox-rectangle2"">
						<h3>Plus de €150</h3>
					  </div>
				   </a>
				</section>
				</div>
				</main>
		<!-- Pied de la page -->
				<?php include ("include/footer.php");?>
