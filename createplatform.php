<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Game Center</title>
	<link rel="stylesheet" href="style.css"> 
	<meta charset="UTF-8">
	<meta name="description" content="Exercice de bibliothèque de jeux vidéo.">
	<meta name="keywords" content="gaming, database">
	<meta name="author" content="Tim K. Robb">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="script.js" type="text/javascript"></script>
<!--	<script src="ckeditor/ckeditor.js"></script> -->
</head>
<body>

	<?php

		require_once("dbinit.php");

		if ( ! empty($_POST) ) {
			$requete = "INSERT INTO plateformes (plateformes_name, plateformes_description) VALUES (:plateformes_name, :plateformes_description)";
			$stmt = $pdo->prepare($requete);
			$stmt->bindParam(":plateformes_name",$_POST["platformName"],PDO::PARAM_STR);
			$stmt->bindParam(":plateformes_description",$_POST["platformDescription"],PDO::PARAM_STR);
			$stmt->execute();
			header("Location: listplatforms.php");
			exit();
		}

		require_once("menu.php");

	?>

	<form method="POST" action ="" class="create">

		<label for="platformName">Nom de la plateforme :</label>
		<input name="platformName">
		
		<label for="platformDescription">Description de la plateforme :</label>
		<textarea name="platformDescription"></textarea>

		<input type="submit" value="Créer">		

	</form>

</body>
</html>