<?php
    $Domaines_info = "chaine, de, caractères";
    $liste_domaines = explode(",",$Domaines_info);
    foreach ($liste_domaines as $domaine){
        echo $domaine;
    }
?>