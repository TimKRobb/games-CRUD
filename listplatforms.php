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

		$sortField = "plateformes_name";

		if (! empty($_POST) ) {
			switch($_POST["sortField"]){
				case "ID": $sortField = "plateformes_ID"; break;
				case "name": $sortField = "plateformes_name"; break;
			}
		}

		$requete = "SELECT * FROM plateformes
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
		    echo "<td class=\"id\">" . $row["plateformes_ID"] . "</td>" . PHP_EOL;
		    echo "<td class=\"name\">" . $row["plateformes_name"] . "</td>" . PHP_EOL;
		    echo "<td class=\"desc\">" . $row["plateformes_description"] . "</td>" . PHP_EOL;
		    echo "<td class=\"id\">";
		    $requete2 = "SELECT games_plateformes_games_ID FROM games_plateformes WHERE games_plateformes_plateformes_ID = " . $row["plateformes_ID"] . ";";
		    $result2 = $pdo->query($requete2);
		    echo $result2->rowCount();
		    echo "</td>" . PHP_EOL;
		    echo "<td class=\"id\"><a href=\"editplatform.php?ID=" . $row["plateformes_ID"] . "\">Edit</a> - ";
		    echo "<a href=\"deleteplatform.php?ID=" . $row["plateformes_ID"] . "\">Delete</a></td>" . PHP_EOL;
		    echo "</tr>" . PHP_EOL;
		}

		echo "</table>" . PHP_EOL;
		echo "</form>" . PHP_EOL;
	?>

</body>
</html>