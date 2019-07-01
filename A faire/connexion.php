<?php
// Suppression de la session (retour de la déconnexion)
session_start();
session_destroy();
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Page de connexion</title>
    </head>
    <body>
        <form method="post" action="authentification.php">
            <input type="text" name="identifiant" value="" />
            <br /><input type="password" name="mot_de_passe" value="" />
            <br /><input type="submit" name="bouton_soumission" value="Se connecter" />
        </form>
    </body>
</html>