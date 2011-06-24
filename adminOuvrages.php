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
			
			<form class="corps" method="post" action="adminOuvragesOK.php">
				<p>
					<label for="id">Identifiant : </label>
					<input type="text" name="id" id="id" size="20" />
				</p>
				<p>
					<label for="titre">Titre : </label>
					<input type="text" name="titre" id="titre" size="20" />
				</p>
				<p>
					<label for="auteur">Auteur : </label>
					<input type="text" name="auteur" id="auteur" size="20" />
				</p>
				<p>
					<label for="support">Support : </label>
					<select name="support" id="support">
						<option value="livre">Livre</option>
						<option value="cd">CD</option>
						<option value="dvd">DVD</option>
					</select>
				</p>
				
				<p>
					<label for="editeur">Editeur : </label>
					<input type="text" name="editeur" id="editeur" size="20" />
				</p>
				<p>
					<label for="collection">Collection : </label>
					<input type="text" name="collection" id="collection" size="20" />
				</p>
				<p>
					<label for="date">Date de parution : </label>
					<input type="text" name="date" id="date" size="20" />
				</p>
				<p>
					<label for="theme">Thème : </label>
					<input type="text" name="theme" id="theme" size="20" />
				</p>
				
				<p><input type="submit" class="submit" value="Ajouter" /></p>
			</form>
			
		</div>
	</body>

</html>
