<?php

/*************************
      Page: connexion.php
 **************************/

include("include/fonction.php");
include("include/header.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>



<?php
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//Si le membre clic sur le lien deconnexion, déconnecter via session_destroy();.
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
//si le formulaire est envoyé ("envoyé" signifie que le bouton submit est cliqué)
if (isset($_POST['connecter'])) {
    //vérifie si tous les champs sont bien  pris en compte:
    if (!isset($_POST['pseudo'], $_POST['mdp'])) {
        $reponse = "Un des champs n'est pas reconnu.";
    } else {


        $Pseudo = $_POST['pseudo'];
        $Mdp = $_POST['mdp'];
        $reponse=Connexion($Pseudo,$Mdp);
        
    }
}
?>
    //--------------------------------- AFFICHAGE HTML ---------------------------------//
  
    <main>
        <div id="signup-box">
            <div class="signup-left-box">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <h1>Connexion</h1>
                    <input type="text" name="pseudo" placeholder="Votre pseudo" required="required" />
                    <input type="password" name="mdp" placeholder="Mot de passe" required="required" />
                    <input type="submit" name="connecter" value="Se connecter" />
                </form>
            </div>
            <div class="signup-right-box">
                <h1>Pas encore membre?</h1>
                </br>
                <a href="inscription.php">Inscrivez-vous</a>

            </div>
            <div class="signup-or">or</div>
        </div>
    </main>
    <!-- Partie javascript pour afficher les messages en cas d'erreur-->
    <script type="text/javascript">
        var message = '<?php echo $reponse; ?>';
        rep = resultat(message);
    </script>
</body>
<?php
include("include/footer.php");
?>