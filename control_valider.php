<?php
	function Connect_db(){
		  $host="iutdoua-webetu.univ-lyon1.fr";
		  $user="p1400208";
		  $password="210864";
		  $dbname="p1400208";
	  try {
		   $bdd=new PDO('mysql:host='.$host.';dbname='.$dbname.
						';charset=utf8',$user,$password);
		   return $bdd;
		}
		catch (Exception $e) {
		   die('Erreur : '.$e->getMessage());
	  }
	}
	
	
	function validerRapport($id) {
		$bdd = Connect_db();
		$query = $bdd->prepare("UPDATE RAPPORTS SET Valide = 1 WHERE id = ?");
		$args[] = $id;
		$query->execute($args);
		$query->closeCursor();
	}
	
	$bdd = connect
	if(isset($_POST['cbvar'])) {
		for($i = 0; $i < count($_POST['cbvar']); $i++){
		  
		}
		
	}
?>