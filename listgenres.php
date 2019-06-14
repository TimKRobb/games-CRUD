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

		require_once("menu.php");

		$sortField = "genre_name";

		if (! empty($_POST) ) {
			switch($_POST["sortField"]){
				case "ID": $sortField = "genre_ID"; break;
				case "name": $sortField = "genre_name"; break;
			}
		}

		$requete = "SELECT * FROM genre
			ORDER BY " . $sortField . " ASC";

		$result = $pdo->query($requete);

		echo "<form method=\"POST\" action=\"\">" . PHP_EOL;

		echo "<input id= \"sortField\" value=\"\" name=\"sortField\" hidden>" . PHP_EOL;

		echo "<table class=\"gamelist\">" . PHP_EOL;

		echo "<tr>" . PHP_EOL;

		echo "<th class=\"id\" id=\"headerID\">ID</th>" . PHP_EOL;

		echo "<th class=\"name\" id=\"headerName\">Nom</th>" . PHP_EOL;

		echo "<th class=\"desc\">Description</th>" . PHP_EOL;

		echo "<th class=\"id\" id=\"headerNbJeux\">Nb. de jeux</th>" . PHP_EOL;

		echo "<th></th>" . PHP_EOL;

		echo "</tr>" . PHP_EOL;

		while ($row = $result->fetch()) {
		    echo "<tr>" . PHP_EOL;
		    echo "<td class=\"id\">" . $row["genre_ID"] . "</td>" . PHP_EOL;
		    echo "<td class=\"name\">" . $row["genre_name"] . "</td>" . PHP_EOL;
		    echo "<td class=\"desc\">" . $row["genre_description"] . "</td>" . PHP_EOL;
		    echo "<td class=\"id\">";
		    $requete2 = "SELECT games_id FROM games WHERE games_genre_ID = " . $row["genre_ID"] . ";";
			$result2 = $pdo->query($requete2);
			echo $result2->rowCount();
		    echo "</td>" . PHP_EOL;
		    echo "<td class=\"id\"><a href=\"editgenre.php?ID=" . $row["genre_ID"] . "\">Edit</a> - ";
		    echo "<a href=\"deletegenre.php?ID=" . $row["genre_ID"] . "\">Delete</a></td>" . PHP_EOL;
		    echo "</tr>" . PHP_EOL;
		}

		echo "</table>" . PHP_EOL;
		echo "</form>" . PHP_EOL;
	?>

	<p class="error">ATTENTION ! Détruire un genre détruit tous les jeux associés.</p>

</body>
</html>