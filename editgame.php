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

		$error = "";

		if ( ! isset($_GET["ID"]) ) {
			header("Location: index.php");
			exit();
		}

		$ID = intval($_GET["ID"]);

		if ( $ID < 1 ) {
			header("Location: index.php");
			exit();
		}

		$requete = "SELECT * FROM games WHERE games_ID = " . $ID . " LIMIT 1";

		$result = $pdo->query($requete);

		$line = $result->fetch();

		if (! $line) {
			header("Location: index.php");
			exit();
		}

		if ( ! empty($_POST) ) {

			$gamePlatforms = [];

			foreach($_POST as $key => $val) {
				switch($key){
					case "gameName": $gameName = $val; break;
					case "gameYear": $gameYear = $val; break;
					case "gameDescription": $gameDescription = $val; break;
					case "gameGenre": $gameGenre = $val; break;
					default: array_push($gamePlatforms,$val);
				}
			}

			if ( ! count($gamePlatforms) ) {
				$error = "Attention ! Un jeu doit forcément avoir au moins une plateforme associée.";
			} else {

				$requete1 = "UPDATE games
					SET games_name = :games_name,
						games_year = :games_year,
						games_description = :games_description,
						games_genre_ID = :games_genre_ID
					WHERE games_ID = " . $ID . ";";
				$stmt1 = $pdo->prepare($requete1);
				$stmt1->bindParam(":games_name",$gameName,PDO::PARAM_STR);
				$stmt1->bindParam(":games_year",$gameYear,PDO::PARAM_STR);
				$stmt1->bindParam(":games_description",$gameDescription,PDO::PARAM_STR);
				$stmt1->bindParam(":games_genre_ID",$gameGenre,PDO::PARAM_STR);
				$stmt1->execute();

				$requete2 = "DELETE FROM games_plateformes WHERE games_plateformes_games_ID = " . $ID;
				$result2 = $pdo->query($requete2);

				foreach($gamePlatforms as $val) {
					$requete3 = "INSERT INTO games_plateformes (games_plateformes_games_ID, games_plateformes_plateformes_ID)
						VALUES (:games_plateformes_games_ID, :games_plateformes_plateformes_ID);";
					$stmt3 = $pdo->prepare($requete3);
					$stmt3->bindParam(":games_plateformes_games_ID",$ID,PDO::PARAM_STR);
					$stmt3->bindParam(":games_plateformes_plateformes_ID",$val,PDO::PARAM_STR);
					$stmt3->execute();
				}

				header("Location: index.php");
				exit();

			}

		}

		if ( ! isset($_GET["ID"]) ) {
			header("Location: index.php");
			exit();
		}

		$ID = intval($_GET["ID"]);

		if ( $ID < 1 ) {
			header("Location: index.php");
			exit();
		}

		$requete = "SELECT * FROM games WHERE games_ID = " . $ID . " LIMIT 1";

		$result = $pdo->query($requete);

		$line = $result->fetch();

		if (! $line) {
			header("Location: index.php");
			exit();
		}

		require_once("menu.php");

		$requete1 = "SELECT * FROM genre ORDER BY genre_name ASC";
		$result1 = $pdo->query($requete1);

		$requete2 = "SELECT * FROM plateformes ORDER BY plateformes_name ASC";
		$result2 = $pdo->query($requete2);

		if ( $error != "" ) {
			echo "<p class=\"error\">" . $error . "</p>" . PHP_EOL;
		}

	?>

	<form method="POST" action ="" class="create">

		<label for="gameName">Nom du jeu :</label>
		<input name="gameName" value="<?php echo $line["games_name"];?>">
		
		<label for="gameYear">Année de parution :</label>
		<input name="gameYear" value="<?php echo $line["games_year"];?>">
		
		<label for="gameDescription">Description du jeu :</label>
		<textarea name="gameDescription"><?php echo $line["games_description"];?></textarea>

		<label for="gameGenre">Genre :</label>
		<select name="gameGenre">
			<?php
				while($genre = $result1->fetch()) {
					echo "<option value=\"" . $genre["genre_ID"] . "\"";
					if ( $genre["genre_ID"] == $line["games_genre_ID"] ) {
						echo "selected";
					}
					echo ">" . $genre["genre_name"] . "</option>" . PHP_EOL;
				}
			?>
		</select>

		<fieldset>
			<legend>Plateformes :</legend>
			<?php
				while($plateforme = $result2->fetch()) {
					echo "<input type=\"checkbox\" name=\"platform" . $plateforme["plateformes_ID"] . "\" value=\"" . $plateforme["plateformes_ID"] . "\"";
					$requete3 = "SELECT * FROM games_plateformes WHERE games_plateformes_games_ID = " . $ID . " AND games_plateformes_plateformes_ID = " . $plateforme["plateformes_ID"] . " LIMIT 1";
					$result3 = $pdo->query($requete3);
					if ($result3->rowCount()) {
						echo " checked";
					}
					echo " /> " . $plateforme["plateformes_name"] . PHP_EOL;
				}
			?>
		</fieldset>

		<input type="submit" value="Modifier">		

	</form>

</body>
</html>