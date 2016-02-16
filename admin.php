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

function getRapportsNV() {
		$bdd = Connect_db();
		$query = $bdd->prepare('SELECT Nom_etu, Prenom_etu, Nom_tuteur_IUT FROM RAPPORTS R WHERE R.Valide = 0');
		$query->execute();
		
		$map = array();
		
		while($data = $query->fetch()) {
			$map[] = array( 
				'Nom_etu' => $data['Nom_etu'],
				'Prenom_etu' => $data['Prenom_etu'],
				'Nom_tuteur_IUT' => $data['Nom_tuteur_IUT']);
		}
		$query->closeCursor();
		
		return $map;
}

function getRapportsPret() {
		$bdd = Connect_db();
		$query = $bdd->prepare('');//Changer ça
		$query->execute();
		
		$map = array();
		
		while($data = $query->fetch()) {
			$map[] = array( 
				'Nom_etu' => $data['Nom_etu'],
				'Prenom_etu' => $data['Prenom_etu'],
				'Nom_tuteur_IUT' => $data['Nom_tuteur_IUT']);
		}
		$query->closeCursor();
		
		return $map;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page d'admin</title>
	</head>
	<body>
        <header>
            <a href="./index.php">Accueil</a>
            <a href="./ajout.php">Ajout d'un rapport</a>
            <a href="./tri.php">Recherche de rapport</a>
            <a href="./admin.php">Page administrateur</a>
        </header>
		<form method="POST">
			<?php 
				$map = getRapportsNV();
				if(isset($map)) {
					foreach($map as $data) {
						print_r($data['Nom_etu']);
                        print_r($data['Prenom_etu']);
                        print_r($data['Nom_tuteur_IUT']);
						?>
							<input type="checkbox" name="cbvar" value="Supprimer">Valider<br/>
						<?php
					}
				}
			?>
			<input type="submit" value="Valider">
		</form>
	</body>
</html>