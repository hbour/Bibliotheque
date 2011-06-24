 <?php session_start(); ?>
<!DOCTYPE html> <!-- Ceci est du HTML 5 -->

<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="reset.css" />
		<link rel="stylesheet" href="style.css" />
		<title>Exam Library</title>
		
		<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js" ></script >
		<script type="text/javascript" >
		tinyMCE.init({
		        mode : "textareas",
		        theme : "advanced",
		        plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
		                
		        // Theme options - button# indicated the row# only
		        theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect",
		        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,undo,redo,|,link,unlink,anchor,image",
		        theme_advanced_toolbar_location : "top",
		        theme_advanced_toolbar_align : "left",
		        theme_advanced_statusbar_location : "bottom",
		        theme_advanced_resizing : true

		});
		</script >
	</head>
	
	<body>
		<div id="marges">
			<?php include "header.php"; ?>
			<div id="sidebar">
				<?php include "log.php"; ?>
				<?php include "menuAdmin.php"; ?>
			</div>
			
			<h2>Administration</h2>
			
			<h3>Ajouter un article sur le blog</h3>
			
			<form class="corps" method="post" action="adminBlogEditerOK.php">
				<p><label for="titre">Titre : </label>
				<input type="text" name="titre" id="titre" size="30" /></p>
				<p><label for="blog">Contenu : </label>
		        <p><textarea class="blog" name="blog" cols="40" rows="20" ></textarea></p>
		        
		        <p><input type="submit" class="submit" value="Publier cet article" /></p>
	        </form>
			
		</div>
	</body>

</html>