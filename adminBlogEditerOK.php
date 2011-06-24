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
			
			<h3>Ajouter un article sur le blog</h3>
			
			<?php if(isset($_POST["blog"]) && 
			($_SESSION["categorie"] == "Bibliothecaire" || 
			 $_SESSION["categorie"] == "Administrateur")) {
				include_once("dbconnex.php");
				$idcom = connexobject("bibliotheque", "dbparam");
				$requete = "INSERT INTO T_Articles ".
				"(USA_ID, ART_Titre, ART_Contenu) ".
				"VALUES ('".$_SESSION['id']."', '".addslashes(utf8_decode($_POST['titre']))."', '".
				addslashes(utf8_decode($_POST['blog']))."')";
				$result = $idcom->query($requete);
				if(!$result) {
					echo "<p>Erreur de la base de données.</p>";
					echo "<p><a href='adminBlogEditer.php'>Réessayer</a></p>";
				} else {
					echo "<p>L'article a été publié.<p>";
				}
			} else {
				echo "<p>Formulaire incomplet.</p>";
				echo "<p><a href='adminBlogEditer.php'>Réessayer</a></p>";
			}
			?>
		</div>
	</body>

</html>