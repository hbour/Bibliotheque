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
				<?php include "menuCompte.php"; ?>
			</div>
			
			<h2>Votre compte</h2>
			
			<h3>Historique de vos réservations</h3>
			
			<?php include_once("dbconnex.php");
			$idcom = connexobject("bibliotheque", "dbparam");
			
			if(!$_SESSION['id']) {
				echo "Veuillez vous connecter.";
			} else {
				$requete = "SELECT OUV_Titre, OUV_Auteur, EMP_Date ".
				"FROM TJ_Reserver re ".
				"JOIN T_Exemplaires ex ".
				"ON re.EXE_Code_exemplaire = ex.EXE_Code_exemplaire ".
				"JOIN T_Ouvrages o ".
				"ON o.OUV_ID = ex.OUV_ID ".
				"WHERE re.USA_ID = '".$_SESSION['id']."'";
				$result = $idcom->query($requete);
				if(!$result) {
					echo "<p>Erreur requête</p>";
				} else {
					if($result->num_rows == 0) {
						echo "<p>Vous n'avez encore rien réservé.</p>";
					} else {
						while($res = $result->fetch_assoc()) {
							echo "<p>";
							echo $res['EMP_Date']." : ";
							echo "<b>".$res['OUV_Titre']."</b>, ";
							echo "<i>".$res['OUV_Auteur'].".</i>";
							echo "</p>";
						}
					}
				}
				$result->close();
			}
			?>
		</div>
	</body>

</html>