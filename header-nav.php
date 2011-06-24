<nav>
	<ul>
		<li><a href="index.php">Accueil</a></li>
		<li><a href="indexCatalogue.php">Catalogue</a></li>
		<?php if($_SESSION): ?> 
			<li><a href="indexCompte.php">Compte</a></li>
		<?php endif; ?>
		<?php if($_SESSION): ?> 
			<?php if($_SESSION["categorie"] == "Bibliothecaire" || 
					$_SESSION["categorie"] == "Administrateur"): ?>
				<li><a href="indexAdministration.php">Administration</a></li>
			<?php endif; ?>
		<?php endif; ?>
		<li><a href="indexBlog.php">Blog</a></li>
		<li><a href="indexFAQ.php">FAQ</a></li>
	</ul>
</nav>