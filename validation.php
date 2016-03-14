<?php
    ini_set('session.save_path', 'tmp');
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css" type="text/css"><?php
            $regex = "@etu.univ-lyon1.fr$";
            $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
            mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
            //INITIALISATION des valeurs
            if(isset($_POST) & count($_POST)) { 
                $_SESSION['Nom_etu'] = $_POST['Nom_etu'];
                $_SESSION['Prenom_etu'] = $_POST['Prenom_etu'];
                $_SESSION['Mail_etu'] = $_POST['Mail_etu'];
                $_SESSION['Domaines_info'] = $_POST['Domaines_info'];
                $_SESSION['Nom_entreprise'] = $_POST['Nom_entreprise'];
                $_SESSION['Secteur_entreprise'] = $_POST['Secteur_entreprise'];
                $_SESSION['Date_stage'] = $_POST['Date_stage'];
                $_SESSION['Pays_stage'] = $_POST['Pays_stage'];
                $_SESSION['Nom_tuteur_IUT'] = $_POST['Nom_tuteur_IUT'];
                $_SESSION['Nom_tuteur_entreprise'] = $_POST['Nom_tuteur_entreprise'];
                $_SESSION['Prive'] = $_POST['Prive'];
            }
            if (isset($_SESSION['Nom_etu'])){
                $Nom_etu = $_SESSION['Nom_etu'];
            } else {
                $Nom_etu = '';
            }
            if (isset($_SESSION['Prenom_etu'])){
                $Prenom_etu = $_SESSION['Prenom_etu'];
            } else {
                $Prenom_etu = '';
            }
            if (isset($_SESSION['Mail_etu'])){
                $Mail_etu = $_SESSION['Mail_etu'];
            } else {
                $Mail_etu = '';
            }
            if (isset($_SESSION['Domaines_info'])){
                $Domaines_info = $_SESSION['Domaines_info'];
                $liste_domaines = explode(",",$Domaines_info);
            } else {
                $Domaines_info = '';
            }
            if (isset($_SESSION['Nom_entreprise'])){
                $Nom_entreprise = $_SESSION['Nom_entreprise'];
            } else {
                $Nom_entreprise = '';
            }
            if (isset($_SESSION['Secteur_entreprise'])){
                $Secteur_entreprise = $_SESSION['Secteur_entreprise'];
            } else {
                $Secteur_entreprise = '';
            }
            if (isset($_SESSION['Date_stage'])){
                $Date_stage = $_SESSION['Date_stage'];
            } 
            if (isset($_SESSION['Pays_stage'])){
                $Pays_stage = $_SESSION['Pays_stage'];
            } else {
                $Pays_stage = '';
            }
            if (isset($_SESSION['Nom_tuteur_IUT'])){
                $Nom_tuteur_IUT = $_SESSION['Nom_tuteur_IUT'];
            } else {
                $Nom_tuteur_IUT = '';
            }
            if (isset($_SESSION['Nom_tuteur_entreprise'])){
                $Nom_tuteur_entreprise = $_SESSION['Nom_tuteur_entreprise'];
            } else {
                $Nom_tuteur_entreprise = '';
            }
            if (isset($_SESSION['Prive'])){
                $Prive = $_SESSION['Prive'];
            }
            if (isset($_GET['update'])){
                $update=$_GET['update'];
            }
            // FIN INIT //
        
            $sql_maxref = "SELECT MAX(Reference) as maxref FROM RAPPORTS";
                
        
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
                if (isset($Nom_etu) 
                    && isset($Prenom_etu) 
                    && isset($Mail_etu) 
                    && isset($Domaines_info) 
                    && isset($Nom_entreprise) 
                    && isset($Secteur_entreprise) 
                    && isset($Date_stage) 
                    && isset($Pays_stage) 
                    && isset($Nom_tuteur_IUT) 
                    && isset($Nom_tuteur_entreprise)
                    && isset($Prive)){
                        if (ereg($regex,$Mail_etu)){
                                echo '<h2 class="recap"> Récapitulatif : </h2>';
                                echo '<table>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> Votre nom ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Nom_etu.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> Votre prénom ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Prenom_etu.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> Votre mail ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Mail_etu.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> Les domaines informatiques de votre stage  ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Domaines_info.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> La date où vous avez commencé votre stage  ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Date_stage.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> Le pays où vous avez effectué votre stage  ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Pays_stage.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> Le nom de votre tuteur IUT  ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Nom_tuteur_IUT.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>';
                                            echo '<p class="recapgauche"> Le nom de votre tuteur entreprise  ';
                                        echo '</td>';
                                        echo '<td class="centre">';
                                            echo '<p class="recapcentre">:</p>';
                                        echo '</td>';
                                        echo '<td>';
                                            echo '<p class="recapdroite">'.$Nom_tuteur_entreprise.'</p>';
                                        echo '</td>';
                                    echo '</tr>';
                                        echo '<tr>';
                                            echo '<td>';
                                                echo '<p class="recapgauche"> La confidentialité de votre rapport est fixée sur';
                                            echo '</td>';
                                            echo '<td class="centre">';
                                                echo '<p class="recapcentre">:</p>';
                                            echo '</td>';
                                            echo '<td>';
                                            if ($Prive == 1){
                                                echo '<p class="recapdroite">Privé</p>';
                                            } else {
                                                echo '<p class="recapdroite">Publique</p>';
                                            }
                                            echo '</td>';
                                        echo '</tr>';
                            echo '</table>';

                            $requete_keywords = "INSERT INTO KEYWORDS(Reference,KEYWORD) VALUES ";
                            
                            $maxref = mysql_query($sql_maxref) or die('Erreur SQL !'.$sql_maxref.'<br>'.mysql_error());
                            $reference  = mysql_fetch_assoc($maxref,0);
                            $refmax = $reference['maxref'] + 1;
                            
                            $sql = "INSERT INTO RAPPORTS
        (Reference,Nom_etu,Prenom_etu,Mail_etu,Gamme_note,Nom_entreprise,Secteur_entreprise,Date_stage,Pays_stage,Nom_tuteur_IUT,Nom_tuteur_entreprise,Valide,Dispo_pret,Prive)
                                    VALUES
                                        ('$refmax',
                                        '$Nom_etu',
                                        '$Prenom_etu',
                                        '$Mail_etu',
                                        NULL,
                                        '$Nom_entreprise',
                                        '$Secteur_entreprise',
                                        '$Date_stage',
                                        '$Pays_stage',
                                        '$Nom_tuteur_IUT',
                                        '$Nom_tuteur_entreprise',
                                        0,
                                        1,
                                        '$Prive')"; 
                            if (isset($update)){
                                
                                
                                
                                mysql_query($sql) or die('Erreur SQL ! '.$sql.'<br>'.mysql_error());         //On ajoute le rapport à la table rapport
                                
                                
                                
                                
                                
                                foreach($liste_domaines as $domaine){                                       //Pour chacun des domaines entrés par l'utilisateur,...
                                    $requete_keywords .= "(".$refmax.",'".$domaine."') ,";                      //On build la requete d'ajout dans la table KEYWORDS
                                }
                                
                                
                                $requete_keywords[strlen($requete_keywords) - 1] = "";                                               //On enlève la dernière virgule pour la remplacer par un point-virgule
                                echo $requete_keywords;
                                echo '<br><br>';
                                $requete_keywords .= ";";
                                
                                mysql_query($requete_keywords) or die('Erreur SQL !'.$requete_keywords.'<br>'.mysql_error());
                                
                                
                                header('Location: http://iutdoua-webetu.univ-lyon1.fr/~p1400208/Ptut/ajout_valide.html');
                                exit;
                            }
                            echo "<a href='validation.php?update=true'>Valider</a>";
                            mysql_close($db); 
                        } else {
                            echo '<p class="echec">Merci de rentrer un mail valide</p>';
                            echo '<p class="echec">Merci de remplir tous les champs</p></br>';
                            echo '<a href="ajout.php">Retour</a>';
                            mysql_close($db);
                        }
                } else {
                    echo '<p class="echec">Merci de remplir tous les champs</p></br>';
                    echo '<a href="ajout.php">Retour</a>';
                    mysql_close($db);
                }
            ?>
    </body>
</html>
