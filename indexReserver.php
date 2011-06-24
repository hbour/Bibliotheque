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
			
			<h2>Réserver un article</h2>
			
			<?php if(isset($_GET["reserver"]) && isset($_SESSION['id'])) {
				$art = $_GET["reserver"];
				$usr = $_SESSION['id'];
				
				include_once("dbconnex.php");
				$idcom = connexobject("bibliotheque", "dbparam");
				
				$reqExe = "SELECT EXE_Code_exemplaire FROM T_Exemplaires ".
				" WHERE DIS_Disponibilite LIKE 'Pr%sent' LIMIT 0, 1";
				$result = $idcom->query($reqExe);
				if(!$result) {
					echo "<p>Erreur de la base de données.</p>";
				} else {
					$codeEx = $result->fetch_object()->EXE_Code_exemplaire;
					
					$reqDispo = "UPDATE T_Exemplaires SET DIS_Disponibilite = 'Réservé' ".
					"WHERE EXE_Code_exemplaire = '".$codeEx."'";
					$result2 = $idcom->query($reqDispo);
					
					$reqResa = "INSERT INTO TJ_Reserver (USA_ID, EXE_Code_exemplaire, RES_Date, RES_En_cours)".
					" VALUES ('".$usr."', '".$codeEx."', '".getdate()."', 1)";
					$result3 = $idcom->query($reqResa);
					
					echo "<p>L'ouvrage est réservé. Vous avez 24h pour le prendre en bibliothèque</p>";
				}
			}
			?>
		</div>
	</body>

</html>