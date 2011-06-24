<form method="post" id="logout" action="indexLogout.php">
	<fieldset>
		<legend>Déconnectez-vous</legend>
		<p><?php echo $_SESSION["nom"]; ?>
			<input type="text" hidden="hidden" name="logout" value="ok" />
			<input type="submit" value="Déconnexion" />
		</p>
	</fieldset>
</form>