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
    exit();//on arrête l'éxécution du reste de la page avec exit, si le membre n'est pas connecté
}


$Pseudo=$_SESSION['pseudo'];//on défini la variable $Pseudo (Plus simple à écrire que $_SESSION['pseudo']) pour pouvoir l'utiliser plus bas dans la page
 
 
//on récupère les infos du membre si on souhaite les afficher dans la page:
$req=mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='$Pseudo'");
$info=mysqli_fetch_assoc($req);
?><!DOCTYPE HTML>
<html>
    <head>
        <title>C2script.com - Script espace membre</title>
    </head>
    <body>
        <h1>Espace membre</h1>
        Pour modifier vos informations, <a href="espace-membre.php?modifier">cliquez ici</a>
         
        Pour supprimer votre compte, <a href="espace-membre.php?supprimer">cliquez ici</a>
         
        Pour vous déconnecter, <a href="deconnexion.php">cliquez ici</a>
        <hr/>
        <?php
        //si "?modifier" est dans l'URL:
        if(isset($_GET['supprimer'])){
            if($_GET['supprimer']!="ok"){
                echo "<p>Êtes-vous sûr de vouloir supprimer votre compte définitivement?</p>
                 
                <a href='espace-membre.php?supprimer=ok' style='color:red'>OUI</a> - <a href='espace-membre.php' style='color:green'>NON</a>";
            } else {
                //on supprime le membre avec "DELETE"
                if(mysqli_query($mysqli,"DELETE FROM membres WHERE pseudo='$Pseudo'")){
                    echo "Votre compte vient d'être supprimé définitivement.";
                    unset($_SESSION['pseudo']);//on tue la session pseudo avec unset()
                } else {
                    echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
                    //echo "Erreur retournée: ".mysqli_error($mysqli);
                }
            }
        }
        //si "?modifier" est dans l'URL:
        if(isset($_GET['modifier'])){
            ?>
            <h1>Modification du compte</h1>
            Choisissez une option:
            <p>
                <a href="espace-membre.php?modifier=mail">Modifier l'adresse mail</a>
                 
                <a href="espace-membre.php?modifier=mdp">Modifier le mot de passe</a>
            </p>
            <hr/>
            <?php
            if($_GET['modifier']=="mail"){
                echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
                if(isset($_POST['valider'])){
                    if(!isset($_POST['mail'])){
                        echo "Le champ mail n'est pas reconnu.";
                    } else {
                        if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,30}$#i",$_POST['mail'])){
                            //cette preg_match est un petit peu complexe, je vous invite à regarder l'explication détaillée sur mon site c2script.com
                            echo "L'adresse mail est incorrecte.";
                            //normalement l'input type="email" vérifie que l'adresse mail soit correcte avant d'envoyer le formulaire mais il faut toujours être prudent et vérifier côté serveur (ici) avant de valider définitivement
                        } else {
                            //tout est OK, on met à jours son compte dans la base de données:
                            if(mysqli_query($mysqli,"UPDATE membres SET mail='".htmlentities($_POST['mail'],ENT_QUOTES,"UTF-8")."' WHERE pseudo='$Pseudo'")){
                                echo "Adresse mail {$_POST['mail']} modifiée avec succès!";
                                $TraitementFini=true;//pour cacher le formulaire
                            } else {
                                echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
                                //echo "Erreur retournée: ".mysqli_error($mysqli);
                            }
                        }
                    }
                }
                if(!isset($TraitementFini)){
                    ?>
                     
                    <form method="post" action="espace-membre.php?modifier=mail">
                        <input type="email" name="mail" value="<?php echo $info['mail']; ?>" required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
                        <input type="submit" name="valider" value="Valider la modification">
                    </form>
                    <?php
                }
            } elseif($_GET['modifier']=="mdp"){
                echo "<p>Renseignez le formulaire ci-dessous pour modifier vos informations:</p>";
                //si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
                if(isset($_POST['valider'])){
                    //vérifie si tous les champs sont bien pris en compte:
                    if(!isset($_POST['nouveau_mdp'],$_POST['confirmer_mdp'],$_POST['mdp'])){
                        echo "Un des champs n'est pas reconnu.";
                    } else {
                        if($_POST['nouveau_mdp']!=$_POST['confirmer_mdp']){
                            echo "Les mots de passe ne correspondent pas.";
                        } else {
                            $Mdp=md5($_POST['mdp']);
                            $NouveauMdp=md5($_POST['nouveau_mdp']);
                            $req=mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='$Pseudo' AND mdp='$Mdp'");
                            //on regarde si le mot de passe correspond à son compte:
                            if(mysqli_num_rows($req)!=1){
                                echo "Mot de passe actuel incorrect.";
                            } else {
                                //tout est OK, on met à jours son compte dans la base de données:
                                if(mysqli_query($mysqli,"UPDATE membres SET mdp='$NouveauMdp' WHERE pseudo='$Pseudo'")){
                                    echo "Mot de passe modifié avec succès!";
                                    $TraitementFini=true;//pour cacher le formulaire
                                } else {
                                    echo "Une erreur est survenue, merci de réessayer ou contactez-nous si le problème persiste.";
                                    //echo "Erreur retournée: ".mysqli_error($mysqli);
                                }
                            }
                        }
                    }
                }
                if(!isset($TraitementFini)){
                    ?>
                     
                    <form method="post" action="espace-membre.php?modifier=mdp">
                        <input type="password" name="nouveau_mdp" placeholder="Nouveau mot de passe..." required><!-- required permet d'empêcher l'envoi du formulaire si le champ est vide -->
                        <input type="password" name="confirmer_mdp" placeholder="Confirmer nouveau passe..." required>
                        <input type="password" name="mdp" placeholder="Votre mot de passe actuel..." required>
                        <input type="submit" name="valider" value="Valider la modification">
                    </form>
                    <?php
                }
            }
        }
        ?>
    </body>
</html>

include("include/footer.php");
