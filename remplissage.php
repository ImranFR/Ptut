<?php
$nom = 1;
$prenom = 1;
$mail = 1;
$gamme = 1;
$nom_entreprise = 1;
$secteur_entreprise = 1;
$date = 1;
$dispo = 0;
$total = 0;
while ($nom <= 3){
    while ($prenom <= 3){
        while ($mail <= 3){
            while ($gamme <= 3){
                while ($nom_entreprise <= 3){
                    while ($secteur_entreprise <= 3){
                        while ($date <= 3){
                            while ($dispo <= 1){
                                $final_nom = 'Nom'.$nom;
                                $final_prenom = 'Prenom'.$prenom;
                                $final_mail = 'mail'.$mail.'@etu.univ-lyon1.fr';
                                $final_nom_entreprise = 'Entreprise'.$nom_entreprise;
                                $final_secteur_entreprise = 'Secteur'.$secteur_entreprise;
                                $final_date = '2016-03-'.$date;
                                $stmt = "INSERT INTO `RAPPORTS` (
                                                                `Reference`, 
                                                                `Nom_etu`, 
                                                                `Prenom_etu`, 
                                                                `Mail_etu`, 
                                                                `Gamme_note`, 
                                                                `Domaines_info`,
                                                                `Nom_entreprise`, 
                                                                `Secteur_entreprise`, 
                                                                `Date_stage`, 
                                                                `Pays_stage`, 
                                                                `Nom_tuteur_IUT`, 
                                                                `Nom_tuteur_entreprise`, 
                                                                `Valide`, 
                                                                `Dispo_pret`, 
                                                                `Prive`) 
                                                                VALUES(".$total.",'".$final_nom."','".$final_prenom."','".$final_mail."',".$gamme.",'DOMAINE','".$final_nom_entreprise."','".$final_secteur_entreprise."','".$final_date."','France','Tuteur IUT','Tuteur Entreprise',1,1,".$dispo.");";
                                echo $stmt; 
                                echo '</br><br>';
                                $dispo++;
                                $total++;
                            }
                            $dispo=0;
                            $date++;
                        }
                        $date=1;
                        $secteur_entreprise++;
                    }
                    $secteur_entreprise=1;
                    $nom_entreprise++;
                }
                $nom_entreprise=1;
                $gamme++;
            }
            $gamme=1;
            $mail++;
        }
        $mail=1;
        $prenom++;
    }
    $prenom=0;
    $nom++;
}


?>
