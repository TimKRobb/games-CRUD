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
			$requete = "INSERT INTO genre (genre_name, genre_description) VALUES (:genre_name, :genre_description)";
			$stmt = $pdo->prepare($requete);
			$stmt->bindParam(":genre_name",$_POST["genreName"],PDO::PARAM_STR);
			$stmt->bindParam(":genre_description",$_POST["genreDescription"],PDO::PARAM_STR);
			$stmt->execute();
			header("Location: listgenres.php");
			exit();
		}

		require_once("menu.php");

	?>

	<form method="POST" action ="" class="create">

		<label for="genreName">Nom du genre :</label>
		<input name="genreName">
		
		<label for="genreDescription">Description du genre :</label>
		<textarea name="genreDescription"></textarea>

		<input type="submit" value="Créer">		

	</form>

</body>
</html>