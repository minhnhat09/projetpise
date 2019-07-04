<?php
 
    /*************************
      Page: inscription.php
    **************************/
    include("include/fonction.php");
    include("include/header.php");
?>

         
        <?php
		//--------------------------------- TRAITEMENTS PHP ---------------------------------//
        //si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
        $reponse="";
        if(isset($_POST['valider'])){
            //vérifie si tous les champs sont bien  pris en compte:
            if(!isset($_POST['pseudo'],$_POST['mdp'],$_POST['mail'])){
                $reponse= "Un des champs n'est pas reconnu.";
            } else {
                //on vérifie le pseudo
                if(!preg_match("#^[a-z0-9]{1,15}$#",$_POST['pseudo'])){
                    //la preg_match définie a-z pour toutes les lettres en minuscules et 0-9 pour tous les chiffres;
                    //d'une longueur de 1 min et 15 max
                    $reponse= "Caractère accepté : Lettre de a à z et/ou chiffre, longueur de 1 à 15 caractères.";
                } else {
                    //on vérifie le mot de passe:
                    if(strlen($_POST['mdp'])<5 or strlen($_POST['mdp'])>15){
                        $reponse= "Le mot de passe doit être minimum de 5 caractères et de 15 maximum.";
                    } else {
                        //on vérifie que l'adresse est correcte:
                        if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,30}$#i",$_POST['mail'])){
                           //à revoir sur le site  
							$reponse= "L'adresse mail est incorrecte.";
                        } else {
                            if(strlen($_POST['mail'])<7 or strlen($_POST['mail'])>50){
                                $reponse= "Le mail doit être d'une longueur minimum de 7 caractères et de 50 maximum.";
                            } else {
                               
                                    $Pseudo=$_POST['pseudo'];
                                    $Mdp=$_POST['mdp'];
                                    $Mail=$_POST['mail'];
									
                                    if(VerifPseudo($Pseudo)==false){
                                        $reponse= "Ce pseudo est déjà utilisé par un autre membre";
                                    } else {
                                        //insertion du membre dans la base de données:
                                        if(Inscription($Pseudo,$Mdp,$Mail)){
                                            //echo "Inscrit avec succès! Vous pouvez vous connecter";
                                            header("location:connexion.php");
                                            $TraitementFini=true;
											//pour cacher le formulaire
                                        } else {
                                            $reponse= "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
                                        }
                                    }
                                
                            }
                        }
                    }
                }
            }
             
        }
        if(!isset($TraitementFini)){//quand le membre sera inscrit, on définira cette variable afin de cacher le formulaire
		//--------------------------------- AFFICHAGE HTML ---------------------------------//
           ?>
				<main>	 
		  <div id="signup-box">
		     <div class="signup-left-box">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <em><?php echo $reponse;?></em>
                <h1>Créer votre compte</h1>
		        <input type="text" name="pseudo" placeholder="Pseudo: de a à z et/ou de 0 à 9" required="required"/>
		        <input type="text" name="mail" placeholder="Email: exemple@gmail.com" required="required"/>
		        <input type="password" name="mdp" placeholder="Mot de passe" required="required"/>
		        <!--<input type="text" name="couleurPref" placeholder="Couleur préféré"/><br-->
		        <input type="submit" name="valider" value="S'inscrire"/>
		        </form>
		     </div>
		     <div class="signup-right-box">
		         <h1>Déjà membre ?</h1>
				 
		        <a href="connexion.php">Connexion</a>
		     
		     </div> 
		     <div class="signup-or">or</div>
		  </div> 
		</main>

            <?php
        }
        ?>
    </body>
	<?php
 include("include/footer.php");
?>