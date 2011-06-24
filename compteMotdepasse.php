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
			
			<h3>Changer votre mot de passe</h3>
			
			<?php if(!isset($_POST["oldPwd"]) || !isset($_POST["newPwd"]) 
			|| !isset($_POST["newPwd2"])) {
			?>
			<form class="" method="post" action="CompteMotdepasse.php">
				<p>
					<label for="oldPwd">Ancien mot de passe : </label>
					<input type="password" name="oldPwd" id="oldPwd" size="20" />
				</p>
				<p>
					<label for="newPwd">Nouveau mot de passe : </label>
					<input type="password" name="newPwd" id="newPwd" size="20" />
				</p>
				<p>
					<label for="newPwd2">Nouveau mot de passe : </label>
					<input type="password" name="newPwd2" id="newPwd2" size="20" />
				</p>
				
				<p><input type="submit" class="submit" value="Créer ce compte" /></p>
			</form>
			
			<?php } else {
					if($_POST["newPwd"] != $_POST["newPwd2"]) {
					?>
					
					<p>Faute de frappe dans votre nouveau mot de passe.
					Veuillez recommencer.</p>
					<form class="" method="post" action="CompteMotdepasse.php">
				<p>
					<label for="oldPwd">Ancien mot de passe : </label>
					<input type="password" name="oldPwd" id="oldPwd" size="20" />
				</p>
				<p>
					<label for="newPwd">Nouveau mot de passe : </label>
					<input type="password" name="newPwd" id="newPwd" size="20" />
				</p>
				<p>
					<label for="newPwd2">Nouveau mot de passe : </label>
					<input type="password" name="newPwd2" id="newPwd2" size="20" />
				</p>
				
				<p><input type="submit" class="submit" value="Créer ce compte" /></p>
			</form>
				
			<?php } else { 
					include_once("dbconnex.php");
					$idcom = connexobject("bibliotheque", "dbparam");
					$requete = "SELECT USA_Motdepasse FROM T_Usagers ".
					"WHERE USA_ID = '".$_SESSION['id']."'";
					$result = $idcom->query($requete);
					if(!$result) {
						echo "<p>Erreur requête</p>";
					} else {
						while($obj = $result->fetch_object()) {
							$pwd = $obj->USA_Motdepasse;
						}
					}
					if($pwd != $_POST["oldPwd"]) {
						echo "<p>Votre mot de passe actuel est erroné.</p>";
					} else {
						$update = "UPDATE T_Usagers ".
						"SET USA_Motdepasse = '".$_POST["newPwd"]."' ".
						"WHERE USA_ID = '".$_SESSION['id']."'";
						$result = $idcom->query($update);
						if(!$result) {
							echo "<p>Erreur requête</p>";
						} else {
							echo "<p>Votre mot de passe a été modifié.</p>";
						}
					}
				}
			}
			?>
		</div>
	</body>

</html>

