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
            $mail_ok = 1;
            if (isset($_GET['reference'])){
                $_SESSION['reference'] = $_GET['reference'];
                $reference = $_SESSION['reference'];
            } else if (isset($_SESSION['reference'])){
                $reference = $_SESSION['reference'];
            } else {
                $reference = 'undef';
                $mail_ok = 0;
            }
        
            if (isset($_POST['email_reservation'])){
                $mail_reservation = $_POST['email_reservation'];
            } else {
                $mail_ok = 0;
            }
            
            if (isset($_POST['nom_reservation'])){
                $nom_reservation = $_POST['nom_reservation'];
            } else {
                $mail_ok = 0;
            }
        
            if (isset($_POST['prenom_reservation'])){
                $prenom_reservation = $_POST['prenom_reservation'];
            } else {
                $mail_ok = 0;
            }
        
            if (isset($_POST['date_debut'])){
                $date_debut = $_POST['date_debut'];
            } else {
                $mail_ok = 0;
            }
        
            if (isset($_POST['date_fin'])){
                $date_fin = $_POST['date_fin'];
            } else {
                $mail_ok = 0;
            }
        
            if ($mail_ok == 1){
                $mailto = 'yann.davin@etu.univ-lyon1.fr, '.$mail_reservation;
                
                $objet_mail = '[PTut] Demande de rapport - '.$prenom_reservation.' '.$nom_reservation;
                
                $message = 'Demande de réservation de <em>'.$prenom_reservation.' '.$nom_reservation.'</em><br>';
                $message .= 'Référence souhaitée : <em>'.$reference.'</em><br>';
                $message .= 'Date d\'emprunt souhaitée : <em>'.$date_debut.'</em><br>';
                $message .= 'Date de rendu prévue : <em>'.$date_fin.'</em><br>';
                $message .= 'Mail de l\'étudiant : <em>'.$mail_reservation.'</em><br>';
                $message .= 'Message généré par le site.';
                echo $message;
                
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "To: ".$mailto." \r\n";
                $headers .= "From: ".$prenom_reservation." ".$nom_reservation." <".$mail_reservation."> \r\n";
                
                if (mail($mailto,$objet_mail,$message,$headers)){
                    $sql = "UPDATE RAPPORTS SET Dispo_pret=0 WHERE Reference = ".$reference;
                    $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                    mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
                    mysql_query($sql) or die('Erreur SQL !'.$liste_rapports.'<br>'.mysql_error());
                    header('Location: ./retour_mail.php?resultat=1&date_debut='.$date_debut);
                } else {
                    header('Location: ./retour_mail.php?resultat=0&date_debut='.$date_debut);
                }
            }
        
        ?>
    </head>
    <body>
        <header>
            <a href="./index.php">Accueil</a>
            <a href="./ajout.php">Ajout d'un rapport</a>
            <a href="./tri.php">Recherche de rapport</a>
        </header>
        <form method="POST" id="form_demande" action="demande_reservation.php">
            <label for="email_reservation">
                Votre adresse mail :
            </label>
            <input type="email" name="email_reservation" required="required" id="email_reservation">
            <br>
            
            <label for="nom">
                Votre nom :
            </label>
            <input type="text" name="nom_reservation" required="required" id="nom_reservation">
            <br>
            
            <label for="prenom">
                Votre prenom :
            </label>
            <input type="text" name="prenom_reservation" required="required" id="prenom_reservation">
            <br>
            
            <label for="date_debut">
                Date de début d'emprunt :
            </label>
            <input type="date" name="date_debut" required="required" id="date_debut">
            <br>
            
            <label for="date_fin">
                Date de fin d'emprunt :
            </label>
            <input type="date" name="date_fin" required="required" id="date_fin">
            <br>
            
            <input type="submit" value="Générer le mail">
        </form>
        <script language="javascript" type="text/javascript">
            
        </script>
    </body>
</html>