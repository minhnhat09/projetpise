<?php
if (!isset($_SESSION)) {
	session_start();
}
include("include/fonction.php");
include("include/header.php");


//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if (!membreEstConnecteEtEstAdmin()) {
	header("location:connexion.php");
	exit();
}
$contenu = "";
//--- SUPPRESSION OEUVRE ---//
if (isset($_GET['action']) && $_GET['action'] == "suppression") {
	SuppressionOeuvre($_GET['ID_Oeuvre']);
	$contenu .= 'L\'oeuvre été supprimé';
	$_GET['action'] = 'affichage';
}
//--- MODIFIER OEUVRE ---//
if (!empty($_POST)) {	//pour éviter une erreur si aucune img n'est ajoutée
	$img_bdd = "";
	if (isset($_GET['action']) && $_GET['action'] == 'modifier') {
		$img_bdd = $_POST['img_actuelle'];
	}
	// Contrôle de l’existence du fichier et si l’envoi est bien effectué
	if (isset($_FILES["img"]) and $_FILES["img"]["error"] == 0) {
		// Inspection de la taille du fichier, ici moins de 200Ko
		if ($_FILES["img"]["size"] <= 200000) {
			// Examen de l’extension du fichier
			$infosfichier = pathinfo($_FILES["img"]["name"]);
			$extension_upload = $infosfichier["extension"];
			$extensions_autorisees = array("jpg", "jpeg", "gif", "png");
			if (in_array($extension_upload, $extensions_autorisees)) {

				// Validation du fichier et stockage avec le même nom
				$nom_img = $_POST['Nom_Oeuvre'] . '_' . $_FILES['img']['name'];
				move_uploaded_file($_FILES["img"]["tmp_name"], "img/" . basename($nom_img));
				$img_bdd = "img/$nom_img";
			} else {
				echo "<br/>Seules les images sont acceptées !";
			}
		} else {
			echo "<br/>La taille du fichier est trop importante (200 Ko max) !";
		}
	}


	AjoutOuModifierOeuvre($_POST["ID_Oeuvre"], $_POST["Nom_Oeuvre"], $_POST["Cat_Oeuvre"], $_POST["Taille"], $_POST["Prix"], $_POST["Artiste"], $img_bdd);
	$contenu .= "L'oeuvre a été enregistré";
	$_GET['action'] = 'affichage';
}
//--- LIENS PRODUITS ---//

$contenu .= '<main><div class="wrapper"><a href="?action=affichage" >Affichage des oeuvres</a></br>';
$contenu .= '<a href="?action=ajouter">Ajout d\'une oeuvre</a></div></main>';
//--- AFFICHAGE PRODUITS ---//
if (isset($_GET['action']) && $_GET['action'] == "affichage") {
	$resultat = ListeTab("oeuvre", "*");
	//$resultat=$resultat->fetch();
	$contenu .= '<h2> Liste des oeuvres </h2>';
	$contenu .= '<table border="1" cellpadding="5"><tr>';
	//L'entête de la table
	$contenu .= '<th>ID_Oeuvre</th>';
	$contenu .= '<th>Nom_Oeuvre</th>';
	$contenu .= '<th>Cat_Oeuvre</th>';
	$contenu .= '<th>Taille</th>';
	$contenu .= '<th>Prix</th>';
	$contenu .= '<th>Artiste</th>';
	$contenu .= '<th>Img_Oeuvre</th>';
	$contenu .= '<th>Modification</th>';
	$contenu .= '<th>Supression</th>';

	$contenu .= '</tr>';

	while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
		$contenu .= '<tr>';
		foreach ($ligne as $indice => $information) {
			if ($indice == "Img_Oeuvre") {
				$contenu .= '<td><img src="' . $information . '" width="90" height="90" /></td>';
			} else {
				$contenu .= '<td>' . $information . '</td>';
			}
		}
		$contenu .= '<td><a href="?action=modifier&ID_Oeuvre=' . $ligne['ID_Oeuvre'] . '"><img src="img/edit.png" width="30" height="30" /></a></td>';
		$contenu .= '<td><a href="?action=suppression&ID_Oeuvre=' . $ligne['ID_Oeuvre'] . '" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="img/delete-button.png" width="30" height="30" /></a></td>';
		$contenu .= '</tr>';
	}
	$contenu .= '</table><br/><hr /><br/>';
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;

// En cas de cliquer sur lien ajouter ou modifier
if (isset($_GET['action']) && ($_GET['action'] == 'ajouter' || $_GET['action'] == 'modifier')) {
	if (isset($_GET['ID_Oeuvre'])) {
		$requeteProduitActuel = ListeParID("oeuvre", "ID_Oeuvre", "=", $_GET['ID_Oeuvre']);
		$produit_actuel = $requeteProduitActuel->fetch();
	}
	echo '
	<div class="wrapper"><h1> Formulaire Produits </h1>
	<form method="post" enctype="multipart/form-data" action="">
	
		<input type="hidden" id="ID_Oeuvre" name="ID_Oeuvre" value="';
	if (isset($produit_actuel['ID_Oeuvre'])) echo $produit_actuel['ID_Oeuvre'];
	echo '" />
			
		<label for="Nom_Oeuvre">Nom_Oeuvre</label><br/>
		<input type="text" id="Nom_Oeuvre" name="Nom_Oeuvre" value="';
	if (isset($produit_actuel['Nom_Oeuvre'])) echo $produit_actuel['Nom_Oeuvre'];
	echo '" /><br/><br/>

		<label for="Cat_Oeuvre">Cat_Oeuvre</label><br/>
		<select name="Cat_Oeuvre">
		<option value="Peinture"';
	if (isset($produit_actuel) && $produit_actuel['Cat_Oeuvre'] == 'Peinture') echo ' selected ';
	echo '>Peinture</option>
		<option value="Sculpture"';
	if (isset($produit_actuel) && $produit_actuel['Cat_Oeuvre'] == 'Sculpture') echo ' selected ';
	echo '>Sculpture</option>
		<option value="Photographie"';
	if (isset($produit_actuel) && $produit_actuel['Cat_Oeuvre'] == 'Photographie') echo ' selected ';
	echo '>Photographie</option>
        </select><br/><br/>
        
		<label for="Taille">Taille</label><br/>
		<input type="text" id="Taille" name="Taille" value="';
	if (isset($produit_actuel['Taille'])) echo $produit_actuel['Taille'];
	echo '"  /> <br/><br/>

		<label for="Prix">Prix</label><br/>
		<textarea name="Prix" id="Prix">';
	if (isset($produit_actuel['Prix'])) echo $produit_actuel['Prix'];
	echo '</textarea><br/><br/>
		
		<label for="Artiste">Artiste</label><br/>
		<input type="text" id="Artiste" name="Artiste" value="';
	if (isset($produit_actuel['Artiste'])) echo $produit_actuel['Artiste'];
	echo '" /> <br/><br/>

		<label for="img">Image</label><br/>
		<input type="file" id="img" name="img" /><br/><br/>';
	if (isset($produit_actuel)) {
		echo '<i>Vous pouvez télécharger une nouvelle image si vous souhaitez la changer</i><br/>';
		echo '<img src="' . $produit_actuel['Img_Oeuvre'] . '"  width="90" height="90" /><br/>';
		echo '<input type="hidden" name="img_actuelle" value="' . $produit_actuel['Img_Oeuvre'] . '" /><br/>';
	}

	echo '
		
		
		<input type="submit" value="';
	echo strtoupper($_GET['action']) . '"/>
	</form>
	</div>';
}
include("include/footer.php");
