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

		if ( ! isset($_GET["ID"]) ) {
			header("Location: index.php");
			exit();
		}

		$ID = intval($_GET["ID"]);

		if ( $ID < 1 ) {
			header("Location: index.php");
			exit();
		}

		$requete = "DELETE FROM games WHERE games_ID = " . $ID . " LIMIT 1";
		$result = $pdo->query($requete);

		$requete2 = "DELETE FROM games_plateformes WHERE games_plateformes_games_ID = " . $ID;
		$result2 = $pdo->query($requete2);

		header("Location: index.php");
		exit();

	?>

</body>
</html>