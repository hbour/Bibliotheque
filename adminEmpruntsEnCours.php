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
			
			<h3>Emprunts en cours</h3>
			
			<?php include_once("dbconnex.php");
			$idcom = connexobject("bibliotheque", "dbparam");
			
			if(!$_SESSION['id']) {
				echo "Veuillez vous connecter.";
			} else {
				$requete = "SELECT em.EXE_Code_exemplaire, OUV_Titre, OUV_Auteur, EMP_Date, em.USA_ID, USA_Email ".
				"FROM TJ_Emprunter em ".
				"JOIN T_Exemplaires ex ".
				"ON em.EXE_Code_exemplaire = ex.EXE_Code_exemplaire ".
				"JOIN T_Ouvrages o ".
				"ON o.OUV_ID = ex.OUV_ID ".
        "JOIN T_Usagers us ".
        "ON em.USA_ID = us.USA_ID ".
				"WHERE EMP_En_cours = 1 ".
				"ORDER BY EMP_Date";
				$result = $idcom->query($requete);
				if(!$result) {
					echo "<p>Erreur requête</p>";
				} else {
					if($result->num_rows == 0) {
						echo "<p>Il n'y a aucune réservation en cours.</p>";
					} else {
						while($res = $result->fetch_assoc()) {
							echo "<p>";
							echo $res['EMP_Date']." : ";
							echo "<b>".$res['OUV_Titre']."</b>, ";
							echo "<i>".$res['OUV_Auteur'].".</i>";
							echo "</p><p><a href='adminUtilisateur.php?id=".$res['USA_ID']."'>".
							"Emprunté par: ".$res['USA_ID'].".</a></p>";
							echo "</p><p><a href='adminRetours.php?id=".$res['EXE_Code_exemplaire']."'>".
							"Déclarer le retour.</a> ";
							echo "<a href='mailto:".$res['USA_Email']."'>".
							"Envoyer un e-mail.</a></p>";
							echo "<br>";
						}
					}
				}
				$result->close();
			}
			?>
		</div>
	</body>

</html>