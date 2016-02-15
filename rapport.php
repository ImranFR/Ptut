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
            if (isset($_GET['reference'])){
                $reference = $_GET['reference'];
            } else {
                $reference = 'undef';
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
            if (isset($reference)){
                $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
                $liste_rapports = mysql_query('SELECT * FROM RAPPORTS WHERE Reference = "'.$reference.'"') or die('Erreur SQL !'.$liste_rapports.'<br>'.mysql_error());
                ?>
                <table id="table_rapports">
                    <thead>
                        <td><em>Reference</em></td>
                        <td><em>Nom</em></td>
                        <td><em>Prénom</em></td>
                        <td><em>Mail</em></td>
                        <td><em>Note</em></td>
                        <td><em>Domaines</em></td>
                        <td><em>Entreprise</em></td>
                        <td><em>Secteur entreprise</em></td>
                        <td><em>Date du stage</em></td>
                        <td><em>Pays</em></td>
                        <td><em>Tuteur IUT</em></td>
                        <td><em>Tuteur Entreprise</em></td>
                        <td><em>Disponibilité</em></td>
                        <td><em>Confidentialité</em></td>
                        <td><em>Réservation</em></td>
                    </thead>
                    
                <?php
                while($rapport = mysql_fetch_array($liste_rapports)) {
                ?>
                <tr>
                    <td><?php echo $rapport['Reference']?></td>
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
                    
                    
                    <?php
                    if ($rapport['Dispo_pret'] == 1){
                        ?>
                        <td>Disponible</td>
                        <?php
                    } else {
                    ?>
                        <td>Indisponible</td> 
                    <?php
                    }
                    if ($rapport['Prive'] == 0){
                        ?>
                        <td>Public</td>
                        <?php
                    } else {
                    ?>
                        <td>Privé</td>
                    <?php
                    } 
                    
                    ?>
                    <td><a href="<?php echo "http://iutdoua-webetu.univ-lyon1.fr/~p1400208/Ptut/demande_reservation.php?reference=".$rapport['Reference'] ?>">Réserver</a> </td>
                </tr>
        </table>

            <?php
            }
                
            } else {
                ?>
                <p id="erreur">Référence inexistante ou non définie</p>
                <?php
            }
        ?>
    </body>
</html>