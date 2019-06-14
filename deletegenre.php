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
			header("Location: listgenres.php");
			exit();
		}

		$ID = intval($_GET["ID"]);

		if ( $ID < 1 ) {
			header("Location: listgenres.php");
			exit();
		}

		$requete = "DELETE FROM genre WHERE genre_ID = " . $ID . " LIMIT 1";
		$result = $pdo->query($requete);

		$requete2 = "DELETE FROM games WHERE games_genre_ID = " . $ID;
		$result2 = $pdo->query($requete2);


		header("Location: listgenres.php");
		exit();

	?>

</body>
</html>