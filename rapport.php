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
           <ul>
				<li><a href="./index.php">Accueil</a></li>
				<li><a href="./ajout.php">Ajout d'un rapport</a></li>
				<li><a href="./tri.php">Recherche de rapport</a></li>
				<li><a href="./admin.php">Page administrateur</a></li>
			</ul>
        </header>
        <?php
            if (isset($reference)){
                $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
                $liste_rapports = mysql_query('SELECT RAPPORTS.* FROM RAPPORTS INNER JOIN KEYWORDS ON RAPPORTS.Reference = KEYWORDS.Reference WHERE RAPPORTS.Reference = "'.$reference.'" GROUP BY RAPPORTS.Reference') or die('Erreur SQL !'.$liste_rapports.'<br>'.mysql_error());
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
                    <td>
                            <?php
                                $sql_keywords = "SELECT KEYWORD FROM KEYWORDS WHERE Reference = ".$rapport['Reference']."";
                                $mots_cles = mysql_query($sql_keywords) or die('Erreur SQL ! '.$sql_keywords.'<br>'.mysql_error());
                                $liste_domaines = '';
                                while ($row=mysql_fetch_array($mots_cles)){ 
                                    ?> 
                                    <?php

                                        $liste_domaines .= $row['KEYWORD'].", ";

                                    ?>     
                                <?php
                                }
                                $liste_domaines = rtrim($liste_domaines,' ');
                                $liste_domaines = rtrim($liste_domaines,',');
                                echo $liste_domaines;
                            ?>
                        </td>
                    <td><?php echo $rapport['Nom_entreprise']?></td> 
                    <td><?php echo $rapport['Secteur_entreprise']?></td>
                    <td><?php echo $rapport['Date_stage']?></td>
                    <td><?php echo $rapport['Pays_stage']?></td>
                    <td><?php echo $rapport['Nom_tuteur_IUT']?></td>
                    <td><?php echo $rapport['Nom_tuteur_entreprise']?></td>
                    <?php
                    if ($rapport['Prive'] == 0){
                        ?>
                        <td>Public</td>
                        <?php
                    } else {
                    ?>
                        <td>Privé</td>
                    <?php
                    } 
                    if ($rapport['Dispo_pret'] == 1){
                        ?>
                        <td><a href="<?php echo "http://iutdoua-webetu.univ-lyon1.fr/~p1400208/Ptut/demande_reservation.php?reference=".$rapport['Reference'] ?>">Réserver</a> </td>
                    <?php
                    } else {
                        ?>
                        <td><p>Indisponible</a> </td>
                        <?php
                    }
                    ?>
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
