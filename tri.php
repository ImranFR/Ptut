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
            
            if (isset ($_GET['disponible'])){
                $disponible = 1;
            } else { 
                $disponible = 0;
            }
        
            if (isset ($_GET['nom_entreprise']) && $_GET['nom_entreprise'] != ''){
                $nom_entreprise = $_GET['nom_entreprise'];
                $where = "WHERE Nom_entreprise LIKE \"%".$nom_entreprise."%\"";
            } else {
                $nom_entreprise = '';
            }
            
            if (isset ($_GET['nom_tuteur_iut']) && $_GET['nom_tuteur_iut'] != ''){
                $nom_tuteur_iut = $_GET['nom_tuteur_iut'];
                if (isset ($where)){
                    $where .= "AND Nom_tuteur_IUT LIKE \"%".$nom_tuteur_iut."%\"";
                } else {
                    $where = "WHERE Nom_tuteur_IUT LIKE \"%".$nom_tuteur_iut."%\"";
                }
            } else {
                $nom_tuteur_iut = '';
            } 
        
            if (isset($where)){
                $requete = "SELECT * FROM RAPPORTS ".$where."".$tri."";
            } else {
                $requete = "SELECT * FROM RAPPORTS ".$tri."";
            }
        ?>
    </head>
    <body>
        <form action="tri.php" method="get" id="tri_form">
            <table id="table_formulaire">
                <thead id="header">Filtres</thead>
                <tbody>
                    <tr>
                    <td><select name="tri" form="tri_form">
                        <option value="default" selected="selected">Trier par...</option>
                        <option value="Date_stage DESC">Année : Du plus ancien au plus récent</option>
                        <option value="Date_stage ASC">Année : Du plus récent au plus ancien</option>
                        <option value="Gamme_note DESC">Note : De la plus basse à la plus haute</option>
                        <option value="Gamme_note ASC">Note : De la plus haute à la plus basse</option>
                        <option value="Nom_entreprise DESC">Entreprise : De A à Z</option>
                        <option value="Nom_entreprise ASC">Entreprise : De Z à A</option>
                    </select> </td>

                    
                        <td><input type="text" name="nom_entreprise" placeholder="Nom de l'entreprise..." value="<?php echo $nom_entreprise; ?>"></td>
                        <td><input type="text" name="nom_tuteur_iut" placeholder="Tuteur IUT" value="<?php echo $nom_tuteur_iut; ?>"></td>
                        <td><label for="disponible">
                            Afficher uniquement les rapports disponibles
                        </label>
                        <input type="checkbox" id="disponible" name="disponible[]"></td>

                    </tr>
                    <tr>
                        <td><input type="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
            /*echo $requete;
            echo '<br>';*/
            $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
            $liste_rapports = mysql_query($requete) or die('Erreur SQL !'.$liste_rapports.'<br>'.mysql_error());
            ?>
                <table id="table_rapports">
                    <thead>
                        <td><em>Nom</em></td>
                        <td><em>Prénom</em></td>
                        <td><em>Note</em></td>
                        <td><em>Domaines</em></td>
                        <td><em>Entreprise</em></td>
                        <td><em>Secteur entreprise</em></td>
                        <td><em>Date du stage</em></td>
                        <td><em>Pays</em></td>
                        <td><em>Tuteur IUT</em></td>
                        <td><em>Disponibilité</em></td>
                        <td><em>Confidentialité</em></td>
                    </thead>
            <?php
                 while($rapport = mysql_fetch_array($liste_rapports)) {
            ?>
                <tr>
                    <td><?php echo $rapport['Nom_etu']?></td>
                    <td><?php echo $rapport['Prenom_etu']?></td>
                    <td><?php echo $rapport['Gamme_note']?></td>
                    <td><?php echo $rapport['Domaines_info']?></td>
                    <td><?php echo $rapport['Nom_entreprise']?></td>
                    <td><?php echo $rapport['Secteur_entreprise']?></td>
                    <td><?php echo $rapport['Date_stage']?></td>
                    <td><?php echo $rapport['Pays_stage']?></td>
                    <td><?php echo $rapport['Nom_tuteur_IUT']?></td>
                    
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
                </tr>

            <?php
            }
            mysql_close($db);
        ?>
        </table>
    </body>
</html>
