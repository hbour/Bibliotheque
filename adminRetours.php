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
			
			<h3>Validation des retours</h3>
			
			<?php if(isset($_GET["id"]) && 
			($_SESSION["categorie"] == "Bibliothecaire" || 
			 $_SESSION["categorie"] == "Administrateur")) {
				$id = $_GET["id"];
				
				include_once("dbconnex.php");
				$idcom = connexobject("bibliotheque", "dbparam");
				
				$req = "UPDATE TJ_Emprunter SET EMP_En_cours = 0 WHERE EXE_Code_exemplaire = '".$id."'";
				$result = $idcom->query($req);
				
				if(!$result) {
					echo "<p>Erreur de la base de données.</p>";
				} else {
					echo "<p>L'exemplaire a été mis à jour.<p>";
				}
				
			} else {
				echo "<p>Formulaire incomplet.</p>";
				echo "<p><a href='adminExemplaire.php'>Réessayer</a></p>";
			}
			?>
		</div>
	</body>

</html>