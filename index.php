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

		$sortField = "games_year";

		if (! empty($_POST) ) {
			switch($_POST["sortField"]){
				case "ID": $sortField = "games_ID"; break;
				case "name": $sortField = "games_name"; break;
				case "year": $sortField = "games_year"; break;
				case "genre": $sortField = "genre_name"; break;
			}
		}

		$requete = "SELECT * FROM games
			JOIN genre ON genre_ID = games_genre_ID
			ORDER BY " . $sortField . " ASC";

		$result = $pdo->query($requete);

		echo "<form method=\"POST\" action=\"\">" . PHP_EOL;
		echo "<input id= \"sortField\" value=\"\" name=\"sortField\" hidden>" . PHP_EOL;
		echo "<table class=\"gamelist\">" . PHP_EOL;
		echo "<tr>" . PHP_EOL;
		echo "<th class=\"id\" id=\"headerID\">ID</th>" . PHP_EOL;
		echo "<th class=\"name\" id=\"headerName\">Nom</th>" . PHP_EOL;
		echo "<th class=\"year\" id=\"headerYear\">Année</th>" . PHP_EOL;
		echo "<th class=\"desc\">Description</th>" . PHP_EOL;
		echo "<th class=\"desc\" id=\"headerGenre\">Genre</th>" . PHP_EOL;
		echo "<th class=\"desc\">Genre Desc</th>" . PHP_EOL;
		echo "<th class=\"desc\">Plateforme</th>" . PHP_EOL;
		echo "<th>Plateforme</th>" . PHP_EOL;
		echo "</tr>" . PHP_EOL;

		while ($row = $result->fetch()) {
		    echo "<tr>" . PHP_EOL;
		    echo "<td class=\"id\">" . $row["games_ID"] . "</td>" . PHP_EOL;
		    echo "<td class=\"name\">" . $row["games_name"] . "</td>" . PHP_EOL;
		    echo "<td class=\"year\">" . $row["games_year"] . "</td>" . PHP_EOL;
		    echo "<td class=\"desc\">" . $row["games_description"] . "</td>" . PHP_EOL;
		    echo "<td class=\"desc\">" . $row["genre_name"] . "</td>" . PHP_EOL;
		    echo "<td class=\"desc\">" . $row["genre_description"] . "</td>" . PHP_EOL;
		    echo "<td class=\"desc\">";
		    $requete2 = "SELECT * FROM plateformes JOIN games_plateformes ON plateformes_ID = games_plateformes_plateformes_ID
		    	WHERE games_plateformes_games_ID = " . $row["games_ID"] . " ORDER BY plateformes_name ASC";
		    $result2 = $pdo->query($requete2);
		    $p = [];
		    while ($plateforme = $result2->fetch()) {
		    	array_push($p,$plateforme["plateformes_name"]);
		    }
		    echo implode(", ",$p);
		    echo "</td>" . PHP_EOL;
		    echo "<td class=\"id\"><a href=\"editgame.php?ID=" . $row["games_ID"] . "\">Edit</a> - ";
		    echo "<a href=\"deletegame.php?ID=" . $row["games_ID"] . "\">Delete</a></td>" . PHP_EOL;
		    echo "</tr>" . PHP_EOL;
		}

		echo "</table>" . PHP_EOL;
		echo "</form>" . PHP_EOL;
	?>

</body>
</html>