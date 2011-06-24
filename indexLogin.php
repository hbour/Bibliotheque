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
			
			<?php include_once("dbconnex.php");
			$idcom = connexobject("bibliotheque", "dbparam");
			if(isset($_POST["numId"]) && isset($_POST["pwd"])) {
				$requete = "SELECT USA_Motdepasse, USA_Nom, CAT_Categorie ".
				"FROM T_Usagers WHERE USA_ID = ".$_POST["numId"];
				$result = $idcom->query($requete);
				$res = $result->fetch_object();
				$pwd = $res->USA_Motdepasse;
				$usrNom = $res->USA_Nom;
				$categorie = $res->CAT_Categorie;
				if($pwd == $_POST["pwd"]) {
					echo "Bonjour, vous êtes connecté.";
					$_SESSION["nom"] = $usrNom;
					$_SESSION["categorie"] = $categorie;
					$_SESSION["id"] = $_POST["numId"];
				} else {
					echo "Erreur: identifiant ou mot de passe incorrect.";
				}
			}
			
			$idcom->close();
			?>
		</div>
	</body>

</html>
