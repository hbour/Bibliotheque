<?php session_start(); ?>
<!DOCTYPE html> <!-- Ceci est du HTML 5 -->

<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="reset.css" />
		<link rel="stylesheet" href="style.css" />
		<title>Exam Library</title>
	</head>
	
	<body>
		<div id="marges">
			<?php include "header.php"; ?>
			<div id="sidebar">
				<?php include "log.php"; ?>
			</div>
			
			<h2>Fiche article</h2>
			
			<?php
			if(!isset($_GET['id'])) {
				echo "Erreur: article indéfini";
			} else {
				$id = $_GET['id'];
				include_once("dbconnex.php");
				$idcom = connexobject("bibliotheque", "dbparam");
				$requete = "SELECT OUV_Titre, OUV_Auteur, TYP_Support, OUV_Editeur, ".
				" OUV_Collection, OUV_Date_parution, OUV_Theme ".
				" FROM T_Ouvrages WHERE OUV_ID = '".$id."'";
				$result = $idcom->query($requete);
				if(!$result) {
					echo "<p>Erreur requête</p>";
				} else {
					while($res = $result->fetch_assoc()) {
						echo "<p>Titre : ".utf8_encode($res['OUV_Titre'])."</p>";
						echo "<p>Auteur : ".utf8_encode($res['OUV_Auteur'])."</p>";
						echo "<p>Code : ".utf8_encode($id)."</p>";
						echo "<p>Support : ".utf8_encode($res['TYP_Support'])."</p>";
						echo "<p>Editeur : ".utf8_encode($res['OUV_Editeur'])."</p>";
						echo "<p>Collection : ".utf8_encode($res['OUV_Collection'])."</p>";
						echo "<p>Date de parution : ".utf8_encode($res['OUV_Date_parution'])."</p>";
						echo "<p>Thème : ".utf8_encode($res['OUV_Theme'])."</p>";
					}
				}
				$result->close();
			}
			?>
			
			<h2>Statut des exemplaires</h2>
			
			<?php
			$requete2 = "SELECT DIS_Disponibilite ".
			" FROM T_Exemplaires WHERE OUV_ID = '".$id."'";
			$result2 = $idcom->query($requete2);
			echo "<p>".$result2->num_rows." exemplaire(s) :</p>";
			$present = 0;
			while($row = $result2->fetch_array(MYSQLI_NUM)) {
				foreach($row as $item) {
					echo "<p> - ".utf8_encode($item)." : ";
					if($item == 'Present') {
						$present = 1;
					}
				}
			}
			if($present == 1) {
				echo "<form method='get' id='reserver' action='indexReserver.php'>".
				"<input type='text' hidden='hidden' name='reserver' value='".$id."' />".
				"<input class='indent' type='submit' value='Réserver' /><form>";
			}
			$result2->close();
			?>
		</div>
	</body>

</html>
