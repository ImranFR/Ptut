<?php
$nom = 1;
$prenom = 1;
$mail = 1;
$gamme = 1;
$nom_entreprise = 1;
$tuteur_iut = 1;
$date = 1;
$dispo = 0;
$total = 0;
$prive = 0;
$valide = 0;
while ($gamme <= 3){
    while ($nom_entreprise <= 3){
        while ($tuteur_iut <= 3){
            while ($date <= 3){
                while ($dispo <= 1){
                    while ($prive <= 1){
                        while ($valide <= 1){
                            $final_nom = 'Nom'.$nom;
                            $final_prenom = 'Prenom'.$prenom;
                            $final_mail = 'mail'.$mail.'@etu.univ-lyon1.fr';
                            $final_nom_entreprise = 'Entreprise'.$nom_entreprise;
                            $final_tuteur_iut = 'Tuteur'.$tuteur_iut;
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
                                                            VALUES(".$total.",'Nom','Prénom','".$final_mail."',".$gamme.",'DOMAINE','".$final_nom_entreprise."','Secteur','".$final_date."','France','".$final_tuteur_iut."','Tuteur Entreprise',".$valide.",".$dispo.",".$prive.");";
                            echo $stmt; 
                            echo '</br><br>';
                            $valide++;
                            $total++;
                        }
                        $valide = 0;
                        $prive++;
                    }
                    $prive = 0;
                    $dispo++;
                }
                $dispo=0;
                $date++;
            }
            $date=1;
            $tuteur_iut++;
        }
        $tuteur_iut=1;
        $nom_entreprise++;
    }
    $nom_entreprise=1;
    $gamme++;
}
$gamme=1;


?>