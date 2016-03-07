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
	
	function getRapportsNV() {
		$bdd = Connect_db();
		$query = $bdd->prepare('SELECT Reference, Nom_etu, Prenom_etu, Nom_tuteur_IUT FROM RAPPORTS R WHERE R.Valide = 0');
		$query->execute();
		
		$map = array();
		
		while($data = $query->fetch()) {
			$map[] = array(
				'Reference' => $data['Reference'],
				'Nom_etu' => $data['Nom_etu'],
				'Prenom_etu' => $data['Prenom_etu'],
				'Nom_tuteur_IUT' => $data['Nom_tuteur_IUT']);
		}
		$query->closeCursor();
		
		return $map;
	}
	
	$data = getRapportsNV();
	if(isset($_POST['cbvar'])) {
		$cbvar = $_POST['cbvar'];
		for($i = 0; $i < count($cbvar); $i++){
			if(in_array($i, $cbvar)) {
				validerRapport($data[$i]['Reference']);
				print_r('OK');
			}
		}
		
	}
?>