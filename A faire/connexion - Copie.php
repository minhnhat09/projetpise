<?php
// On initialise les sessions
session_start();

// On définit le mot de pass et login
define( 'USER','username');
define( 'PASS','password');

// On récupère le formulaire
$adminUser 		= isset($_POST['adminuser'])? 		$_POST['adminuser']: 	'';
$adminPassword	= isset($_POST['adminpassword'])? 	$_POST['adminpassword']:'';
$message = '';

// Si les variables ne sont pas vides...
if( !empty( $adminUser ) && !empty( $adminPassword ) ){
	
	// On vérifie si elle corresspondent aux constantes
	if( $adminUser == USER  && $adminPassword == PASS ){
		
		// Si c'est ok, on définit la session ADMIN
		$_SESSION['admin'] = $_SERVER['REMOTE_ADDR'];
		header('Location: login.php');
		
	} else {
		
		// Autrement => message d'erreur
		$message = '<div class="error">Nom d\'utilisateur ou mot de pass erroné</div>';
		
	}
		
}

if(isset($_GET['logout'])){
	echo '1';
	session_destroy();
	header('Location: login.php');
	
}

// On déclare le mode admin
$sessionAdmin = isset($_SESSION['admin'])? '<div id="admin">Bienvenue Administrateur</div>': '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
    <title>Admin Login page</title>
    <style>
body {
	background-color: #333;
	color: #CCC;
}
label {
	display: inline-block;
	width: 100px
}
a {
	color: #FFF;
}
form {
	margin: 10px;
	padding: 10px;
	border: 1px solid #CCC;
	box-shadow: #000 3px 3px 30px;
	border-radius: 6px
}
#admin {
	position: absolute;
	right: 0;
	margin: 10px
}
.error {
	background-color: #FFB7AE;
	color: #F00;
	border: #F00;
	border-radius: 6px;
	padding: 6px;
	margin-bottom: 10px
}
</style>
  </head>
  
  <body>
  <?php echo $sessionAdmin; ?>
  <div style="width:434px; margin:auto; margin-top:30px">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <?php echo $message;
	if(!$sessionAdmin){?>
      <table>
        <tr>
          <td><label>User:</label></td>
          <td><input type="text" name="adminuser" class="right" /></td>
          <td></td>
        </tr>
        <tr>
          <td><label> Password:</label></td>
          <td><input type="password" name="adminpassword" class="right"  /></td>
          <td><input type="submit" class="left" /></td>
        </tr>
      </table>
      <?php } else {
		  
		  echo '<a href="login.php?logout">Logout</a>';
		  
	  }?>
    </form>
  </div>
  </body>
</html>
