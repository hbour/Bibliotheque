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
			
			<?php if(isset($_POST["id"]) && isset($_POST["quantite"]) && 
			($_SESSION["categorie"] == "Bibliothecaire" || 
			 $_SESSION["categorie"] == "Administrateur")) {
				$id = $_POST["id"];
				$quantite = $_POST["quantite"];
				
				include_once("dbconnex.php");
				$idcom = connexobject("bibliotheque", "dbparam");
				
				$reqVerif = "SELECT * FROM T_Ouvrages WHERE OUV_ID = '".$id."'";
				$res = $idcom->query($reqVerif);
				$exist = $res->num_rows;
				
				if($exist =! 0) {
					$requete = "INSERT INTO T_Exemplaires ".
					"(OUV_ID, DIS_Disponibilite) VALUES ('".$id."', 'Present')";
					
					for($i = 0; $i < $quantite; $i++) {
						$result = $idcom->query($requete);
					}
					
					if(!$result) {
						echo "<p>Erreur de la base de données.</p>";
						echo "<p><a href='adminExemplaire.php'>Réessayer</a></p>";
					} else {
						if($quantite = 1) {
							echo "<p>L'exemplaire a été ajouté.<p>";
						} else {
							echo "<p>Les exemplaires ont été ajoutés.<p>";
						}
					}
				} else {
					echo "<p>Ce titre n'existe pas.</p>";
				}
			} else {
				echo "<p>Formulaire incomplet.</p>";
				echo "<p><a href='adminExemplaire.php'>Réessayer</a></p>";
			}
			?>
			
		</div>
	</body>

</html>
