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
			
			<h3>Ajouter un exemplaire</h3>
			
			<form class="corps" method="post" action="adminExemplaireOK.php">
				<p>
					<label for="id">Identifiant : </label>
					<input type="text" name="id" id="id" size="20" />
				</p>
				<p>
					<label for="quantite">Quantité : </label>
					<input type="text" name="quantite" id="quantite" size="10" />
				</p>
				
				
				<p><input type="submit" class="submit" value="Ajouter" /></p>
			</form>
			
		</div>
	</body>

</html>
