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
            $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
            mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
            
            $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        
        
            if (isset($_GET['note_admin']) && isset($_GET['ref_valide'])){
                $note = $_GET['note_admin'];
                
                $gamme_note = 3;
                if ($note<=7){
                    $gamme_note = 1;
                } else if ($note <= 13){
                    $gamme_note = 2;
                }
                
                
                $ref = $_GET['ref_valide'];
                $sql = "UPDATE RAPPORTS SET Valide = 1 WHERE Reference = ".$ref;
                mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
                $sql = "UPDATE RAPPORTS SET Gamme_note = ".$gamme_note." WHERE Reference = ".$ref;
                mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
            }
        
        
        
        
            else if (isset($_GET['refuse'])){
                $refuse = $_GET['refuse'];
                $sql = "DELETE FROM RAPPORTS WHERE Reference = ".$refuse;
                mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
                $sql = "DELETE FROM KEYWORDS WHERE Reference = ".$refuse;
                mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
            }
        ?>
        
    </head>
    <body>
        <header>
            <a href="./index.php">Accueil</a>
            <a href="./ajout.php">Ajout d'un rapport</a>
            <a href="./tri.php">Recherche de rapport</a>
        </header>                
                <?php
                    $sql = "SELECT * FROM RAPPORTS WHERE Valide = 0 LIMIT 1";
                    $liste_attente = mysql_query($sql) or die('Erreur SQL !'.$liste_attente.'<br>'.mysql_error());
                    if (mysql_num_rows($liste_attente) == 0){
                        ?>
                        <p id="no_result">Il n'y a plus de rapports à valider</p>
                        <?php
                    }

                    while ($row = mysql_fetch_array($liste_attente)){
                ?>
                    <p>Référence : <?php echo $row['Reference']?></p>
                    <p>Identité : <?php echo $row['Prenom_etu'].' '.$row['Nom_etu']?></p>
                    <p>Mail : <?php echo $row['Mail_etu']?></p>

                    <form action="admin.php" method="GET" id="form_validation">
                        <input type="hidden" id="ref_valide" name="ref_valide" value="<?php echo $row['Reference']?>">

                        <p>Note : </p> <input type="number" id="note_admin" name="note_admin" required="required">

                        <input type="submit" value="Envoyer"> 
                    </form>
                    
                    <a href="<?php echo $link?>refuse=<?php echo $row['Reference']?>">Refuser</a>
                    
                
                    <?php
                    }
                ?>  
            <table id="table_admin_emprunts">

            </table>
    </body>
</html>