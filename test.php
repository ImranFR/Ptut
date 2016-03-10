<?php
    $db = mysql_connect('iutdoua-webetu.univ-lyon1.fr', 'p1400208', '210864')  or die('Erreur de connexion '.mysql_error());
    mysql_select_db('p1400208',$db)  or die('Erreur de selection '.mysql_error()); 
    $sql_keywords = "SELECT KEYWORD FROM KEYWORDS WHERE Reference = 1";
    $mots_cles = mysql_query($sql_keywords) or die('Erreur SQL ! '.$sql_keywords.'<br>'.mysql_error());

    while ($row=mysql_fetch_array($mots_cles)){ 
        echo $row['KEYWORD'] .", ";
    }
?>