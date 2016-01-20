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
            //INITIALISATION des valeurs
            if (isset($_POST['Nom_etu'])){
                $Nom_etu = $_POST['Nom_etu'];
            } else {
                $Nom_etu = '';
            }
            if (isset($_POST['Prenom_etu'])){
                $Prenom_etu = $_POST['Prenom_etu'];
            } else {
                $Prenom_etu = '';
            }
            if (isset($_POST['Mail_etu'])){
                $Mail_etu = $_POST['Mail_etu'];
            } else {
                $Mail_etu = '';
            }
            if (isset($_POST['Domaines_info'])){
                $Domaines_info = $_POST['Domaines_info'];
            } else {
                $Domaines_info = '';
            }
            if (isset($_POST['Nom_entreprise'])){
                $Nom_entreprise = $_POST['Nom_entreprise'];
            } else {
                $Nom_entreprise = '';
            }
            if (isset($_POST['Secteur_entreprise'])){
                $Secteur_entreprise = $_POST['Secteur_entreprise'];
            } else {
                $Secteur_entreprise = '';
            }
            if (isset($_POST['Date_stage'])){
                $Date_stage = $_POST['Date_stage'];
            }
            if (isset($_POST['Pays_stage'])){
                $Pays_stage = $_POST['Pays_stage'];
            } else {
                $Pays_stage = '';
            }
            if (isset($_POST['Nom_tuteur_IUT'])){
                $Nom_tuteur_IUT = $_POST['Nom_tuteur_IUT'];
            } else {
                $Nom_tuteur_IUT = '';
            }
            if (isset($_POST['Nom_tuteur_entreprise'])){
                $Nom_tuteur_entreprise = $_POST['Nom_tuteur_entreprise'];
            } else {
                $Nom_tuteur_entreprise = '';
            }
            if (isset($_POST['Prive'])){
                $Prive = $_POST['Prive'];
            }
            // FIN INIT //
        ?>
    </head>
    <body>
        <form method="POST" action="index.php" id = "formulaire">
           
           
                <div id="field1-container" class="champs">
                   <label for="field1">
                       Votre nom :</br>
                   </label>
                   <input type="text" name="Nom_etu" id="field1" maxlength="32" required="required" value=<?php echo $Nom_etu ;?> >
              </div>


              <div id="field3-container" class="champs">
                   <label for="field3">
                        Votre prénom :</br>
                   </label>
                   <input type="text" maxlength="32" name="Prenom_etu" id="field3" required="required" value=<?php echo $Prenom_etu ;?> >
              </div>


              <div id="field6-container" class="champs">
                   <label for="field6">
                        Votre adresse mail :</br>
                   </label>
                   <input type="email" maxlength="100" name="Mail_etu" id="field6" required="required" value=<?php echo $Mail_etu ;?> >
              </div>


              <div id="field5-container" class="champs">
                   <label for="field5">
                        Les domaines informatiques de votre stage (séparés par des espaces) :</br>
                   </label>
                   <input type="text" maxlength="100" name="Domaines_info" id="field5" required="required" value=<?php echo $Domaines_info ;?> >
              </div>


              <div id="field7-container" class="champs">
                   <label for="field7">
                        Le nom de l'entreprise où vous avez effectué votre stage :</br>
                   </label>
                   <input type="text" name="Nom_entreprise" id="field7" maxlength="50" required="required" value=<?php echo $Nom_entreprise ;?> >
              </div>


              <div id="field8-container" class="champs">
                   <label for="field8">
                        Les secteurs d'activité de l'entreprise (séparés par des espaces) :</br>
                   </label>
                   <input type="text" name="Secteur_entreprise" maxlength="100" id="field8" required="required" value=<?php echo $Secteur_entreprise ;?> >
              </div>


              <div id="field9-container" class="champs">
                   <label for="field9">
                        La date de début de votre stage :</br>
                   </label>
                   <input type="date" name="Date_stage" value=<?php echo $Date_stage ;?> >
              </div>


              <div id="field10-container" class="champs">
                   <label for="field10">
                        Le pays où vous avez réalisé votre stage :</br>
                   </label>
                   <input type="text" maxlength="30" name="Pays_stage" id="field10" required="required" value=<?php echo $Pays_stage ;?> >
              </div>


              <div id="field11-container" class="champs">
                   <label for="field11">
                        Le nom de votre tuteur IUT :</br>
                   </label>
                   <input type="text" name="Nom_tuteur_IUT" id="field11" maxlength="100" required="required" value=<?php echo $Nom_tuteur_IUT ;?> >
              </div>


              <div id="field12-container" class="champs">
                   <label for="field12">
                        Le nom de votre tuteur en entreprise :</br>
                   </label>
                   <input type="text" name="Nom_tuteur_entreprise" maxlength="100" id="field12" required="required" value=<?php echo $Nom_tuteur_entreprise ;?> >
              </div>


              <div id="field14-container" class="champs radio-group required">
                   <label for="field14-1">
                        Visibilité de votre rapport :</br>
                   </label>


                   <div class="option clearfix">
                        <input type="radio" name="Prive" id="field14-1" value="0">
                        <span class="option-title">
                             Public
                        </span>
                   </div>


                   <div class="option clearfix">
                        <input type="radio" name="Prive" id="field14-2" value="1">
                        <span class="option-title">
                             Privé
                        </span>
                   </div>
            </div>


              <div id="form-submit" class="champs clearfix submit">
                   <input type="submit" value="Envoyer">
            </div>
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
                    echo '<h2 class="recap"> Récapitulatif : </h2>';
                    echo '<a class="recap">Votre nom : '.$Nom_etu.'</a></br>';
                    echo '<a class="recap">Votre prénom : '.$Prenom_etu.'</a></br>';
                    echo '<a class="recap">Votre mail : '.$Mail_etu.'</a></br>';
                    echo '<a class="recap">Les domaines informatiques de votre stage : '.$Domaines_info.'</a></br>';
                    echo '<a class="recap">Le nom de l\'entreprise où vous avez effectué votre stage : '.$Nom_entreprise.'</a></br>';
                    echo '<a class="recap">Les secteurs d\'activité de cette entreprise : '.$Secteur_entreprise.'</a></br>';
                    echo '<a class="recap">La date où vous avez commencé votre stage : '.$Date_stage.'</a></br>';
                    echo '<a class="recap">Le pays où vous avez effectué votre stage : '.$Pays_stage.'</a></br>';
                    echo '<a class="recap">Le nom de votre tuteur IUT : '.$Nom_tuteur_IUT.'</a></br>';
                    echo '<a class="recap">Le nom de votre tuteur entreprise : '.$Nom_tuteur_entreprise.'</a></br>';
                    echo '<a class="recap">Votre nom : '.$Nom_etu.'</a></br>';
                    if ($Prive == 1){
                        echo '<a class="recap">Vous souhaitez que ce rapport soit privé</a></br>';
                    }
                    
                    
                    $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                    mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
                    $sql = "INSERT INTO RAPPORTS
(Nom_etu,Prenom_etu,Mail_etu,Gamme_note,Domaines_info,Nom_entreprise,Secteur_entreprise,Date_stage,Pays_stage,Nom_tuteur_IUT,Nom_tuteur_entreprise,Valide,Dispo_pret,Prive)
                            VALUES
                                ('$Nom_etu',
                                '$Prenom_etu',
                                '$Mail_etu',
                                NULL,
                                '$Domaines_info',
                                '$Nom_entreprise',
                                '$Secteur_entreprise',
                                '$Date_stage',
                                '$Pays_stage',
                                '$Nom_tuteur_IUT',
                                '$Nom_tuteur_entreprise',
                                0,
                                0,
                                '$Prive')"; 
                    //mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); //
                    mysql_close(); 
                } else {
                    echo '<a class="echec">Merci de remplir tous les champs</a>';
                }
            ?>
        </form>
    </body>
</html>
