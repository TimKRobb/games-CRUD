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

			$requete = "UPDATE genre SET genre_name = :genre_name, genre_description = :genre_description WHERE genre_ID = :genre_ID";
			$stmt = $pdo->prepare($requete);
			$stmt->bindParam(":genre_name",$_POST["genreName"],PDO::PARAM_STR);
			$stmt->bindParam(":genre_description",$_POST["genreDescription"],PDO::PARAM_STR);
			$stmt->bindParam(":genre_ID",$_POST["genreID"],PDO::PARAM_STR);
			$stmt->execute();
			header("Location: listgenres.php");
			exit();



		}

		if ( ! isset($_GET["ID"]) ) {
			header("Location: listgenres.php");
			exit();
		}

		$ID = intval($_GET["ID"]);

		if ( $ID < 1 ) {
			header("Location: listgenres.php");
			exit();
		}

		$requete = "SELECT * FROM genre WHERE genre_ID = " . $ID . " LIMIT 1";

		$result = $pdo->query($requete);

		$line = $result->fetch();

		if (! $line) {
			header("Location: listgenres.php");
			exit();
		}

		require_once("menu.php");

	?>

		<form method="POST" action ="" class="create">

			<input name="genreID" value="<?php echo $line["genre_ID"]; ?>" hidden>

			<label for="genreName">Nom du genre :</label>
			<input name="genreName" value="<?php echo $line["genre_name"]; ?>">
		
			<label for="genreDescription">Description du genre :</label>
			<textarea name="genreDescription"><?php echo $line["genre_description"]; ?></textarea>

			<input type="submit" value="Mettre à jour">		

		</form>

</body>
</html>