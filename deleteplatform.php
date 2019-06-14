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
			header("Location: listplatforms.php");
			exit();
		}

		$ID = intval($_GET["ID"]);

		if ( $ID < 1 ) {
			header("Location: listplatforms.php");
			exit();
		}

		$requete = "DELETE FROM plateformes WHERE plateformes_ID = " . $ID . " LIMIT 1";

		$result = $pdo->query($requete);

		$line = $result->fetch();

		header("Location: listplatforms.php");
		exit();

	?>

</body>
</html>