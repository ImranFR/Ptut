<?php
    ini_set('session.save_path', 'tmp');
    session_start();
    function Connect_db(){
		$host="iutdoua-webetu.univ-lyon1.fr"; 
		$user="p1400208";     
		$password="210684";     
		$dbname="p1400208";
		
		try {
		    $bdd=new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$user,$password);
		    return $bdd;                          // Connexion à la base de données
		}
		catch (Exception $e) {
		    die('Erreur : '.$e->GetMessage());
		}  
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css" type="text/css">
        <?php
            //INITIALISATION des valeurs
            if (isset($_POST['reference'])){
                $reference = $_POST['reference'];
            }
            if (isset($_POST['Nom_etu'])){
                $Nom_etu = $_POST['Nom_etu'];
            }
            if (isset($_POST['Prenom_etu'])){
                $Prenom_etu = $_POST['Prenom_etu'];
            }
            if (isset($_POST['Mail_etu'])){
                $Mail_etu = $_POST['Mail_etu'];
            }
            if (isset($_POST['Gamme_note'])){
                $Gamme_note = $_POST['Gamme_note'];
            }
            if (isset($_POST['Domaines_info'])){
                $Domaines_info = $_POST['Domaines_info'];
            }
            if (isset($_POST['Nom_entreprise'])){
                $Nom_entreprise = $_POST['Nom_entreprise'];
            }
            if (isset($_POST['Secteur_entreprise'])){
                $Secteur_entreprise = $_POST['Secteur_entreprise'];
            }
            if (isset($_POST['Date_stage'])){
                $Date_stage = $_POST['Date_stage'];
            }
            if (isset($_POST['Pays_stage'])){
                $Pays_stage = $_POST['Pays_stage'];
            }
            if (isset($_POST['Nom_tuteur_IUT'])){
                $Nom_tuteur_IUT = $_POST['Nom_tuteur_IUT'];
            }
            if (isset($_POST['Nom_tuteur_entreprise'])){
                $Nom_tuteur_entreprise = $_POST['Nom_tuteur_entreprise'];
            }
            if (isset($_POST['Valide'])){
                $Valide = $_POST['Valide'];
            }
            if (isset($_POST['Dispo_pret'])){
                $Dispo_pret = $_POST['Dispo_pret'];
            }
            if (isset($_POST['Prive'])){
                $Prive = $_POST['Prive'];
            }
            // FIN INIT //
        ?>
    </head>


    <body>
        <form method="POST" action="accueil.php" id = "formulaire">
           
           
                <div id="field1-container" class="field f_100">
                   <label for="field1">
                       Votre nom :</br>
                   </label>
                   <input type="text" name="Nom_etu" id="field1" required="required">
              </div>


              <div id="field3-container" class="field f_100">
                   <label for="field3">
                        Votre prénom :</br>
                   </label>
                   <input type="text" name="Prenom_etu" id="field3" required="required">
              </div>


              <div id="field6-container" class="field f_100">
                   <label for="field6">
                        Votre adresse mail :</br>
                   </label>
                   <input type="email" name="Mail_etu" id="field6" required="required">
              </div>


              <div id="field5-container" class="field f_100">
                   <label for="field5">
                        Le domaine informatique de votre stage :</br>
                   </label>
                   <input type="text" name="Domaine_info" id="field5" required="required">
              </div>


              <div id="field7-container" class="field f_100">
                   <label for="field7">
                        Le nom de l'entreprise où vous avez effectué votre stage :</br>
                   </label>
                   <input type="text" name="Nom_entreprise" id="field7" required="required">
              </div>


              <div id="field8-container" class="field f_100">
                   <label for="field8">
                        Les secteurs d'activité de l'entreprise (séparés par des virgules) :</br>
                   </label>
                   <input type="text" name="Secteur_entreprise" id="field8" required="required">
              </div>


              <div id="field9-container" class="field f_100">
                   <label for="field9">
                        La date de début de votre stage :</br>
                   </label>
                   <input class="ttw-date date" id="field9" maxlength="524288" name="Date_stage"
                   required="" size="20" tabindex="0" title="">
              </div>


              <div id="field10-container" class="field f_100">
                   <label for="field10">
                        Le pays où vous avez réalisé votre stage :</br>
                   </label>
                   <input type="text" name="Pays_stage" id="field10" required="required">
              </div>


              <div id="field11-container" class="field f_100">
                   <label for="field11">
                        Le nom de votre tuteur IUT :</br>
                   </label>
                   <input type="text" name="Nom_tuteur_IUT" id="field11" required="required">
              </div>


              <div id="field12-container" class="field f_100">
                   <label for="field12">
                        Le nom de votre tuteur en entreprise :</br>
                   </label>
                   <input type="text" name="Nom_tuteur_entreprise" id="field12" required="required">
              </div>


              <div id="field14-container" class="field f_100 radio-group required">
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


              <div id="form-submit" class="field f_100 clearfix submit">
                   <input type="submit" value="Envoyer">
            </div>
            <?php
                $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
                mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
                $sql = "INSERT INTO RAPPORTS(Nom_etu,Prenom_etu,Mail_etu,Gamme_note,Domaines_info,Nom_entreprise,Secteur_entreprise,Date_stage,Pays_stage,Nom_tuteur_IUT,Nom_tuteur_entreprise,Valide,Dispo_pret,Prive) VALUES('$Nom_etu','$Prenom_etu','$Mail_etu',NULL,'$Gamme_note','$Domaine_info','$Nom_entreprise','$Secteur_entreprise','$Date_stage','$Pays_stage','$Nom_tuteur_IUT','$Nom_tuteur_entreprise',0,0,'$Prive')"; 
        echo $sql;
            ?>
        </form>
    </body>
</html>
