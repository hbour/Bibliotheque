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
			
			<h3>Ajouter un ouvrage</h3>
			
			<?php if(isset($_POST["id"]) && isset($_POST["titre"]) && 
			isset($_POST["auteur"]) && isset($_POST["support"]) && 
			($_SESSION["categorie"] == "Bibliothecaire" || 
			 $_SESSION["categorie"] == "Administrateur")) {
				$id = $_POST["id"];
				$titre = $_POST["titre"];
				$auteur = $_POST["auteur"];
				$support = $_POST["support"];
				$editeur = $_POST["editeur"];
				$collection = $_POST["collection"];
				$date = $_POST["date"];
				$theme = $_POST["theme"];
				
				include_once("dbconnex.php");
				$idcom = connexobject("bibliotheque", "dbparam");
				
				$reqVerif = "SELECT * FROM T_Ouvrages WHERE OUV_ID = '".$id."'";
				$res = $idcom->query($reqVerif);
				$exist = $res->num_rows;
				
				if($exist == 0) {
					$requete = "INSERT INTO T_Ouvrages ".
					"(OUV_ID, TYP_Support, OUV_Auteur, OUV_Titre, OUV_Editeur, ".
					" OUV_Collection, OUV_Date_parution, OUV_Theme) ".
					"VALUES ('".$id."', '".$support."', '".$auteur."', '".$support."', '".$editeur.
					"', '".$collection."', '".$date."', '".$theme."')";
					$result = $idcom->query($requete);
					if(!$result) {
						echo "<p>Erreur de la base de données.</p>";
						echo "<p><a href='adminOuvrages.php'>Réessayer</a></p>";
					} else {
						echo "<p>L'ouvrage a été ajouté.<p>";
					}
				} else {
					echo "<p>Ce titre existe déjà.</p>";
				}
			} else {
				echo "<p>Formulaire incomplet.</p>";
				echo "<p><a href='adminOuvrages.php'>Réessayer</a></p>";
			}
			?>
			
		</div>
	</body>

</html>
