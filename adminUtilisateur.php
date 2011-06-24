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
				<?php include "menuAdmin.php"; ?>
			</div>
			
			<h2>Administration</h2>
			
			<h3>Fiche usager</h3>
			
			<?php include_once("dbconnex.php");
			$idcom = connexobject("bibliotheque", "dbparam");
			
			if(!$_SESSION['id']) {
				echo "Veuillez vous connecter.";
			} else {
				if(!isset($_GET['id'])) {
					echo "Erreur: usager indéfini";
				} else {
					$id = $_GET['id'];
					$requete = "SELECT USA_ID, CAT_Categorie, USA_Motdepasse, USA_Date_fin_validite,  ".
					"USA_Nom, USA_Prenom, USA_Adresse, USA_Tel, USA_Email, USA_Retard ".
					"FROM T_Usagers WHERE USA_ID = '".$id."'";
					$result = $idcom->query($requete);
					if(!$result) {
						echo "<p>Erreur requête</p>";
					} else {
						if($result->num_rows == 0) {
							echo "<p>Cet identifiant ne resprésente aucun usager.</p>";
						} else {
							while($res = $result->fetch_assoc()) {
								echo "<p>Nom : ".utf8_encode($res['USA_Nom'])."</p>";
								echo "<p>Prénom : ".utf8_encode($res['USA_Prenom'])."</p>";
								echo "<p>Identifiant : ".utf8_encode($res['USA_ID'])."</p>";
								echo "<p>Categorie : ".utf8_encode($res['CAT_Categorie'])."</p>";
								echo "<p>Mot de passe : ".utf8_encode($res['USA_Motdepasse'])."</p>";
								echo "<p>Fin de validité carte : ".utf8_encode($res['USA_Date_fin_validite'])."</p>";
								echo "<p>Adresse : ".utf8_encode($res['USA_Adresse'])."</p>";
								echo "<p>Téléphone : ".utf8_encode($res['USA_Tel'])."</p>";
								echo "<p>Email : ".utf8_encode($res['USA_Email'])."</p>";
								echo "<p>Retard : ".utf8_encode($res['USA_Retard'])."</p>";
							}
						}
					}
					$result->close();
				}
			}
			?>
		</div>
	</body>

</html>