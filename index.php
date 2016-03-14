<?php
    ini_set('session.save_path', 'tmp');
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <header>
			<ul>
				<li><a href="./index.php">Accueil</a></li>
				<li><a href="./ajout.php">Ajout d'un rapport</a></li>
				<li><a href="./tri.php">Recherche de rapport</a></li>
				<li><a href="./admin.php">Page administrateur</a></li>
			</ul>
		</header>
       	
    </body>
</html>
