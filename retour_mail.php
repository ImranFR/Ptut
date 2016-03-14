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
        <?php
        if (isset($_GET['resultat'])){
            $resultat = $_GET['resultat'];
        } else {
            $resultat = 0;
        }
        if (isset($_GET['date_debut'])){
            $date_debut = $_GET['date_debut'];
        } else {
            $date_debut = '';
        }
        ?>
        
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
        <?php
        if ($resultat == 1){
            ?>
            <p id="mail_reussi">Le mail a été envoyé. Merci de vous rendre au bureau de Mme DEBOUTE le <?php echo $date_debut; ?> durant l'une des pauses.</p>
            <?php
        } else {
            ?>
            <p id="mail_echec">Le mail n'a pas été envoyé. Réessayez.</p>
        
            <?php
        }
        ?>
    </body>
</html>
