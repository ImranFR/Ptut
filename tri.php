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
            $regex = "/&page=/";
            if (isset($_GET['note_user'])){
                $note_user = $_GET['note_user'];
                $gamme_note_user = 3;
                if ($note_user<=7){
                    $gamme_note_user = 1;
                } else if ($note_user <= 13){
                    $gamme_note_user = 2;
                }
            }
            if (isset($_GET['tri']) && ($_GET['tri'] != 'default')){
                $tri = 'ORDER BY '.$_GET['tri'];
            } else {
                $tri = '';
            }
            
            if (isset ($_GET['disponible'])){
                $disponible = 1;
                $where = "WHERE Dispo_pret = 1 ";
            }
        
            if (isset ($_GET['public'])){
                if (isset ($where)){
                    $where .= "AND Prive = 0 ";
                } else {
                    $where = "WHERE Prive = 0 ";
                }
            }
        
            if (isset ($gamme_note_user)){
                if (isset ($where)){
                    $where .= "AND Gamme_note >= ".$gamme_note_user." ";
                } else {
                    $where = "WHERE Gamme_note >= ".$gamme_note_user." ";
                }
            }
        
            if (isset ($_GET['nom_entreprise']) && $_GET['nom_entreprise'] != ''){
                $nom_entreprise = $_GET['nom_entreprise'];
                if (isset ($where)){
                    $where .= "AND Nom_entreprise LIKE \"%".$nom_entreprise."%\"";
                } else {
                    $where = "WHERE Nom_entreprise LIKE \"%".$nom_entreprise."%\"";
                } 
            } else {
                $nom_entreprise = '';
            }
            
            if (isset ($_GET['nom_tuteur_iut']) && $_GET['nom_tuteur_iut'] != ''){
                $nom_tuteur_iut = $_GET['nom_tuteur_iut'];
                if (isset ($where)){
                    $where .= "AND Nom_tuteur_IUT LIKE \"%".$nom_tuteur_iut."%\" ";
                } else {
                    $where = "WHERE Nom_tuteur_IUT LIKE \"%".$nom_tuteur_iut."%\" ";
                }
            } else {
                $nom_tuteur_iut = '';
            } 
        
            if (isset ($_GET['nb_rapports']) && $_GET['nb_rapports'] != ''){
                $nb_rapports = $_GET['nb_rapports'];
                $limite = "LIMIT ".$nb_rapports."";
            } else {
                $limite = '';
                $nb_rapports = 1000;
            } 
        
        
            if (isset ($_GET['page']) && $_GET['page'] != ''){
                $page = $_GET['page'];
                $page_offset = $page * $nb_rapports;
                $limite .= " OFFSET ".$page_offset."";
            } 
        
        
        
        
            //Gestion des domaines
        
            if (isset ($_GET['domaines']) && $_GET['domaines'] != ''){
                $domaines = $_GET['domaines'];
                $liste_domaines = explode(",",$domaines);
                if (isset ($where)){
                    foreach($liste_domaines as $domaine){
                        $where .= "AND K.KEYWORD LIKE \"%".$domaine."%\" ";
                    }
                } else {
                    foreach($liste_domaines as $domaine){
                        $where .= "WHERE K.KEYWORD LIKE \"%".$domaine."%\" ";
                    }
                }
            } else {
                $domaines = '';
            }
        
            //Fin gestion des domaines
        
            if (isset($where)){
                $requete = "SELECT RAPPORTS.* FROM RAPPORTS, KEYWORDS K ".$where."".$tri."";
                $requete_count = "SELECT COUNT(*) as reference FROM RAPPORTS, KEYWORDS K ".$where."".$tri."";
            } else {
                $requete = "SELECT RAPPORTS.* FROM RAPPORTS, KEYWORDS K ".$tri."";
                $requete_count = "SELECT COUNT(*) as reference FROM RAPPORTS, KEYWORDS K ".$tri."";
            }
        
        
        
        
        
            if (isset($limite)){
                $requete .= " ".$limite."";
            }
           /* echo $requete;
            echo '</br>';
            echo $requete_count;*/
        
        
        
            
        ?>
    </head>
    <body>
        <header>
            <a href="./index.php">Accueil</a>
            <a href="./ajout.php">Ajout d'un rapport</a>
            <a href="./tri.php">Recherche de rapport</a>
            <a href="./admin.php">Page administrateur</a>
        </header>
        <form action="tri.php" method="get" id="tri_form">
            <table id="table_formulaire">
                <thead id="header">Filtres</thead>
                <tbody>
                    <tr>
                    <td><select name="tri" form="tri_form">
                        <option value="default" selected="selected">Trier par...</option>
                        <option value="Date_stage ASC">Année : Du plus ancien au plus récent</option>
                        <option value="Date_stage DESC">Année : Du plus récent au plus ancien</option>
                        <option value="Gamme_note ASC">Note : De la plus basse à la plus haute</option>
                        <option value="Gamme_note DESC">Note : De la plus haute à la plus basse</option>
                        <option value="Nom_entreprise ASC">Entreprise : De A à Z</option>
                        <option value="Nom_entreprise DESC">Entreprise : De Z à A</option>
                    </select> </td>

                    
                        <td><input type="text" name="nom_entreprise" placeholder="Nom de l'entreprise..." value="<?php echo $nom_entreprise; ?>"></td>
                        <td><input type="text" name="nom_tuteur_iut" placeholder="Tuteur IUT" value="<?php echo $nom_tuteur_iut; ?>"></td>
                        <td><input type="number" name="note_user" placeholder="Note minimale" value="<?php echo $note_user; ?>"></td>
                        <td><input type="number" name="nb_rapports" placeholder="Nombre de rapports..." value="<?php echo $nb_rapports; ?>"></td>
                        <td><input type="text" name="domaines" placeholder="Domaines (séparés par des virgules)..." value="<?php echo $domaines; ?>"></td>
                        
                        <td><label for="disponible">
                            Afficher uniquement les rapports disponibles
                        </label>
                        <?php
                            if (isset($_GET['disponible'])){
                                ?>
                                <input type="checkbox" id="disponible" name="disponible[]" checked></td>
                                <?php    
                        } else {
                                ?>
                        <input type="checkbox" id="disponible" name="disponible[]"></td>
                        <?php }
                            ?>

                    </tr>
                    <tr>
                        <td><input type="submit"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
            $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
            $liste_rapports = mysql_query($requete) or die('Erreur SQL !'.$requete.'<br>'.mysql_error());
            
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
                        <td><em>Lien</em></td>
                    </thead>
            <?php
                $j = 0;
                while(($rapport = mysql_fetch_array($liste_rapports)) && ($j < $nb_rapports)) {
            ?>
                <tr>
                    <td><?php echo $rapport['Nom_etu']?></td>
                    <td><?php echo $rapport['Prenom_etu']?></td> 
                    <td><?php echo $rapport['Gamme_note']?></td>
                    <td><table>
                        <?php
                            $sql_keywords = "SELECT KEYWORD FROM KEYWORDS WHERE Reference = 1";
                            $mots_cles = mysql_query($sql_keywords) or die('Erreur SQL ! '.$sql_keywords.'<br>'.mysql_error());

                            while ($row=mysql_fetch_array($mots_cles)){ 
                                ?> 
                                <td>
                                <?php
                                
                                    echo $row['KEYWORD'];
                                
                                ?>                               
                                </td>
                            <?php
                            }
                        ?>
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
                    
                    ?>
                    <td><a href="<?php echo "http://iutdoua-webetu.univ-lyon1.fr/~p1400208/Ptut/rapport.php?reference=".$rapport['Reference'] ?>">Accéder</a> </td>
                </tr>

            <?php
                $j++;
            }
            $linkraw = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $link = substr($linkraw, 0, strrpos($linkraw, "&page="));         //On enlève la page actuelle de l'URL
            
            $reponse = mysql_query($requete_count) or die('Erreur SQL !'.$reponse.'<br>'.mysql_error());
            $nb_rapports_table = mysql_fetch_assoc($reponse,0);  
            //echo $nb_rapports_table['reference'];
                    
            ?>
            </table>  
            <table id="table_href">
                <tr>
                    <?php

                    $i = 1;
                    while ($i < ($nb_rapports_table['reference'] / $nb_rapports)){
                        $k = $i-1;
                        if (preg_match($regex,$linkraw)){
                            echo '<td><a href="'.$link.'&page='.$k.'">'.$i.'</a></td>';
                        } else {
                            echo '<td><a href="'.$linkraw.'&page='.$k.'">'.$i.'</a></td>';
                        }
                        $i++;
                    }

                    mysql_close($db);

                    ?>
                </tr>
            </table>
    </body>
</html>