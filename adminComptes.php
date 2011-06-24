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
			
			<form class="corps" method="post" action="adminComptesOK.php">
				<p>
					<label for="nom">Nom : </label>
					<input type="text" name="nom" id="nom" size="20" />
				</p>
				<p>
					<label for="prenom">Prénom : </label>
					<input type="text" name="prenom" id="prenom" size="20" />
				</p>
				<p>
					<label for="categorie">Catégorie : </label>
					<select name="categorie" id="categorie">
						<?php include_once("dbconnex.php");
						$idcom = connexobject("bibliotheque", "dbparam");
						$requete = "SELECT CAT_Categorie FROM T_Categories_Usagers".
						" ORDER BY CAT_Categorie DESC";
						$result = $idcom->query($requete);
						if(!$result) {
							echo "<option>Erreur requête</option>";
						} else {
							while($row = $result->fetch_array(MYSQLI_NUM)) {
								foreach($row as $item) {
									echo "<option value='".$item."'>".$item."</option>";
								}
							}
						}
						$result->close();
						?>
					</select>
				</p>
				
				<p><label for="adresse">Adresse : </label>
				<textarea rows="5" cols="30" name="adresse" id="adresse"></textarea></p>
				
				<p>
					<label for="tel">Téléphone : </label>
					<input type="text" name="tel" id="tel" size="20" />
				</p>
				<p>
					<label for="mail">E-mail : </label>
					<input type="text" name="mail" id="mail" size="30" />
				</p>
				
				<p><input type="submit" class="submit" value="Créer ce compte" /></p>
			</form>
			
		</div>
	</body>

</html>
