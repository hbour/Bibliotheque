<?php session_start(); ?>
<!DOCTYPE html> <!-- Ceci est du HTML 5 -->

<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="reset.css" />
		<link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="jquery.suggest.css" />
		<title>Exam Library</title>
	</head>
	
	<body>
		<div id="marges">
			<?php include "header.php"; ?>
			<div id="sidebar">
				<?php include "log.php"; ?>
			</div>
			
			<h2>Catalogue</h2>
			
			<div id="formulaire">
				<form>
					<p>Recherche :</p>
					<p><input id="suggest" size="30" />
				</form>
			</div>
			
			<h3>Livres</h3>
			
			<?php include_once("dbconnex.php");
			$idcom = connexobject("bibliotheque", "dbparam");
			$requete = "SELECT OUV_ID, OUV_Titre, OUV_Auteur FROM T_Ouvrages".
			" WHERE TYP_Support = 'Livre' ORDER BY OUV_Titre";
			$result = $idcom->query($requete);
			if(!$result) {
				echo "<p>Erreur requête</p>";
			} else {
				while($row = $result->fetch_assoc()) {
					echo "<p><a href='indexArticle.php?id=".$row['OUV_ID']."'>".
					utf8_encode($row['OUV_Titre'])."</a>, <i>".utf8_encode($row['OUV_Auteur'])."</i></p>";
				}
			}
			$result->close();
			?>
			
			<h3>CD</h3>
			
			<?php
			$requeteCD = "SELECT OUV_ID, OUV_Titre, OUV_Auteur FROM T_Ouvrages".
			" WHERE TYP_Support = 'CD' ORDER BY OUV_Titre";
			$result = $idcom->query($requeteCD);
			if(!$result) {
				echo "<p>Erreur requête</p>";
			} else {
				while($row = $result->fetch_assoc()) {
					echo "<p><a href='indexArticle.php?id=".$row['OUV_ID']."'>".
					utf8_encode($row['OUV_Titre'])."</a>, <i>".utf8_encode($row['OUV_Auteur'])."</i></p>";
				}
			}
			$result->close();
			?>
			
			<h3>DVD</h3>
			
			<?php
			$requeteDVD = "SELECT OUV_ID, OUV_Titre, OUV_Auteur FROM T_Ouvrages".
			" WHERE TYP_Support = 'DVD' ORDER BY OUV_Titre";
			$result = $idcom->query($requeteDVD);
			if(!$result) {
				echo "<p>Erreur requête</p>";
			} else {
				while($row = $result->fetch_assoc()) {
					echo "<p><a href='indexArticle.php?id=".$row['OUV_ID']."'>".
					utf8_encode($row['OUV_Titre'])."</a>, <i>".utf8_encode($row['OUV_Auteur'])."</i></p>";
				}
			}
			$result->close();
			?>
		</div>
		
		<script type="text/javascript" src="jquery-1.6.js"></script>
		<script type="text/javascript" src="jquery.suggest.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#suggest").suggest("indexRecherche.php", {
					onSelect: function() {
						alert("Votre sélection est : " + this.value);
					}
				});
			});
		</script>
	</body>

</html>
