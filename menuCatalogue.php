<fieldset id="menuBar">
	<legend>Catégories</legend>
	<ul>
		<li><a href=""></a></li>
		
		<?php
		include_once("dbconnex.php");
		$idcom = connexobject("bibliotheque", "dbparam");
		
		$requete = "";
		$result = $idcom->query($requete);
		if(!$result) {
			echo "<p>Erreur requête</p>";
		} else {
					
		}
		?>
	</ul>
</fieldset>