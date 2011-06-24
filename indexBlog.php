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
			
			<h2>Blog</h2>
			
			<?php include_once("dbconnex.php");
			$idcom = connexobject("bibliotheque", "dbparam");
			$requete = "SELECT ART_Titre, ART_Contenu FROM T_Articles".
			" ORDER BY ART_ID DESC".
			" LIMIT 0, 5";
			$result = $idcom->query($requete);
			if(!$result) {
				echo "<p>Erreur requête</p>";
			} else {
				while($row = $result->fetch_assoc()) {
					echo "<h3>".utf8_encode($row['ART_Titre'])."</h3>";
					echo utf8_encode($row['ART_Contenu']);
					echo "<hr>";
				}
			}
			$result->close();
			?>
		</div>
	</body>

</html>
