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
			
			<p>Sélectionnez une action dans la barre de droite.</p>
			
		</div>
	</body>

</html>
