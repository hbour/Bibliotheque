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
				<?php include "menuCompte.php"; ?>
			</div>
			
			<h2>Votre compte</h2>
			
			<h3>Annuler une réservation</h3>
			
			<?php include_once("dbconnex.php");
			$idcom = connexobject("bibliotheque", "dbparam");
			
			if(!$_SESSION['id']) {
				echo "Veuillez vous connecter.";
			} else {
        if(!isset($_GET['id']) || !isset($_GET['ex']) || !isset($_GET['date'])) {
          echo "Réservation indéfinie.";
        } else {
          $id = $_GET['id'];
          $ex = $_GET['ex'];
          $date = $_GET['date'];
          $requete = "UPDATE TJ_Reserver SET RES_EN_COURS = 0 ".
          " WHERE USA_ID = '".$id."' AND EXE_Code_exemplaire = '".$ex.
          "' AND RES_Date = '".$date."'";
          $result = $idcom->query($requete);
          if(!$result) {
            echo "<p>Erreur requête</p>";
          } else {
            echo "<p>Votre réservation a été annulée.</p>";
          }
        }
			}
			?>
		</div>
	</body>

</html>