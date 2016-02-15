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
            if (isset($_GET['tri']) && ($_GET['tri'] != 'default')){
                $tri = 'ORDER BY '.$_GET['tri'];
            } else {
                $tri = '';
            }
            
            $requete = "SELECT * FROM RAPPORTS ".$tri."";
        ?>
    </head>
    <body>
        <form action="tri.php" method="get" id="tri_form">
            <select name="tri" form="tri_form">
                <option value="default" selected="selected">Trier par...</option>
                <option value="Date_stage">Année</option>
                <option value="Gamme_note">Note</option>
                <option value="Dispo_pret">Disponibilité</option>
            </select>
            
            <input type="submit">
        </form>
        <?php
            echo $requete;
            echo '<br>';
            $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
            $liste_rapports = mysql_query($requete) or die('Erreur SQL !'.$sql.'<br>'.mysql_error());
            ?>
                <table id="table_rapports">
            <?php
                 while($rapport = mysql_fetch_array($liste_rapports)) {
            ?>
                <tr>
                    <td><?php echo $rapport['Nom_etu']?></td>
                    <td><?php echo $rapport['Prenom_etu']?></td>
                    <td><?php echo $rapport['Mail_etu']?></td>
                    <td><?php echo $rapport['Gamme_note']?></td>
                    <td><?php echo $rapport['Domaines_info']?></td>
                    <td><?php echo $rapport['Nom_entreprise']?></td>
                    <td><?php echo $rapport['Secteur_entreprise']?></td>
                    <td><?php echo $rapport['Date_stage']?></td>
                    <td><?php echo $rapport['Pays_stage']?></td>
                    <td><?php echo $rapport['Nom_tuteur_IUT']?></td>
                    <td><?php echo $rapport['Nom_tuteur_entreprise']?></td>
                    <td><?php echo $rapport['Dispo_pret']?></td>
                    <td><?php echo $rapport['Prive']?></td>
                </tr>

            <?php
            }
        ?>
        </table>
    </body>
</html>