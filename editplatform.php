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

			$requete = "UPDATE plateformes SET plateformes_name = :plateformes_name, plateformes_description = :plateformes_description WHERE plateformes_ID = :plateformes_ID";
			$stmt = $pdo->prepare($requete);
			$stmt->bindParam(":plateformes_name",$_POST["platformName"],PDO::PARAM_STR);
			$stmt->bindParam(":plateformes_description",$_POST["platformDescription"],PDO::PARAM_STR);
			$stmt->bindParam(":plateformes_ID",$_POST["platformID"],PDO::PARAM_STR);
			$stmt->execute();
			header("Location: listplatforms.php");
			exit();



		}

		if ( ! isset($_GET["ID"]) ) {
			header("Location: listplatforms.php");
			exit();
		}

		$ID = intval($_GET["ID"]);

		if ( $ID < 1 ) {
			header("Location: listplatforms.php");
			exit();
		}

		$requete = "SELECT * FROM plateformes WHERE plateformes_ID = " . $ID . " LIMIT 1";

		$result = $pdo->query($requete);

		$line = $result->fetch();

		if (! $line) {
			header("Location: listplatforms.php");
			exit();
		}

		require_once("menu.php");

	?>

		<form method="POST" action ="" class="create">

			<input name="platformID" value="<?php echo $line["plateformes_ID"]; ?>" hidden>

			<label for="platformName">Nom du genre :</label>
			<input name="platformName" value="<?php echo $line["plateformes_name"]; ?>">
		
			<label for="platformDescription">Description du genre :</label>
			<textarea name="platformDescription"><?php echo $line["plateformes_description"]; ?></textarea>

			<input type="submit" value="Mettre à jour">		

		</form>

</body>
</html>