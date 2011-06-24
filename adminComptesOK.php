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
			
			<h3>Créer un nouveau compte</h3>
			
			<?php if(isset($_POST["nom"]) && isset($_POST["prenom"]) && 
			isset($_POST["categorie"]) && isset($_POST["mail"]) && 
			($_SESSION["categorie"] == "Bibliothecaire" || 
			 $_SESSION["categorie"] == "Administrateur")) {
				$nom = $_POST["nom"];
				$prenom = $_POST["prenom"];
				$categorie = $_POST["categorie"];
				$adresse = $_POST["adresse"];
				$tel = $_POST["tel"];
				$mail = $_POST["mail"];
				
				include_once("dbconnex.php");
				$idcom = connexobject("bibliotheque", "dbparam");
				$requete = "INSERT INTO T_Usagers ".
				"(CAT_Categorie, USA_Nom, USA_Prenom, USA_Adresse, USA_Tel, USA_Email) ".
				"VALUES ('".$categorie."', '".$nom."', '".$prenom."', '".$adresse."', '".$tel."', '".$tel."')";
				$result = $idcom->query($requete);
				if(!$result) {
					echo "<p>Erreur de la base de données.</p>";
					echo "<p><a href='adminComptes.php'>Réessayer</a></p>";
				} else {
					echo "<p>Le compte a été créé.<p>";
				}
			} else {
				echo "<p>Formulaire incomplet.</p>";
				echo "<p><a href='adminComptes.php'>Réessayer</a></p>";
			}
			?>
			
		</div>
	</body>

</html>
