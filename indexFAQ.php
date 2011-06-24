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
			
			<h2>Questions fréquentes</h2>
			
			<h3>Adresse de la bibliothèque</h3>
			
			<p>Nous sommes situés au 123 rue de l'Afpa, 91123 Bois-Epine.</p>
			
			<h3>Horaires</h3>
			
			<p>Du lundi au vendredi : de 9h30 à 12h30 et de 14h30 à 17h30.</p>
			
			<p>Le samedi : de 9h30 à 12h30.</p>
			
			<h3>Tarifs</h3>
			
			<p>La carte d'accès à la bibliothèque coûte 15€ par an pour les étudiants 
			et 20€ par an pour les professeurs.</p>
			
			<h3>Limites d'emprunts</h3>
			
			<p>Les étudiants peuvent emprunter jusqu'à 3 livres, 2 CD et 1 DVD simultanément,
			pendant une période maximale de 2 semaines.</p>
			
			<p>Les professeurs peuvent emprunter jusqu'à 8 livres, 4 CD et 2 DVD simultanément,
			pendant une période maximale de 4 semaines.</p>
		</div>
	</body>

</html>
