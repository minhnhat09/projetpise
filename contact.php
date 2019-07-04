<?php
    // Appel de la fonction de connexion à la BDD
include("include/fonction.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
	<!--Menu-->
	<?php   
		include("include/header.php");
		$reponse="";//par défaut, on met valeur vide dans $reponse pour éviter l'erreur
if(isset($_POST['envoyer'])) { // si le bouton "Envoyer" est appuyé
    //on vérifie que le champ mail est correctement rempli
    if(empty($_POST['mail'])) {
        $reponse= "Le champ mail est vide";
    } else {
        //on vérifie que l'adresse est correcte
        if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i",$_POST['mail'])){
            $reponse= "L'adresse mail entrée est incorrecte";
        }else{
            //on vérifie que le champ sujet est correctement rempli
            if(empty($_POST['sujet'])) {
                $reponse= "Le champ sujet est vide";
            }else{
                //on vérifie que le champ message n'est pas vide
                if(empty($_POST['message'])) {
                    $reponse= "Le champ message est vide";
                }else{
                    //tout est correctement renseigné, on envoi le mail
					$reponse= "Le mail a été envoyé avec succès !";
					$TraitementFini=true;

                    }
                }
            }
        }
    }
    
    echo "<main>";

	if(!isset($TraitementFini)){//quand le membre a remplit, on définira cette variable afin de cacher le formulaire
		//--------------------------------- AFFICHAGE HTML ---------------------------------//
           
	?>

			<h1>Nous envoyer un message</h1>
			<h3>Envoyez-nous votre demande en remplissant ce formulaire</h3>
		<form action="contact.php" method="post">
<br/><label for="mail">Mail: </label> <input type="text" name="mail" value="" />
     
    <br/><label for="sujet">Sujet: </label><input type="text" name="sujet" value="" />
     
    <br/><label for="sujet">Message: </label><textarea name="message" cols="40" rows="20"></textarea>
     
    <br/><input type="submit" name="envoyer" value="Envoyer" />
</form>
</main>

		
<?php
        }
        echo "<em>". $reponse. "</em></main>";

        ?>	  
		
		<!-- Pied de la page -->
		<?php
			include ("include/footer.php");
		?>
