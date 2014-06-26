<!DOCTYPE html>
<html>
<head>
	<title>
		Zoeken maar
	</title>
</head>
<body>
<br>

<form method="get" action="zoeken.php">
	<label for="sorteer">Sorteer op</label>
			<select id="sorteer" name="sorteer">
			<option value="van_datum">Datum</option>
			<option value="naam">titel</option>
			<option value="soort">soort</option>
			<option value="omschrijving">omschrijving</option>
			<option value="locatie">locatie</option>
			</select>
			<br>	
			<input id="zoekterm" pattern=".{4,20}" title="De zoekterm moet tussen de 4 en 20 tekens lang zijn" placeholder="Vul hier uw zoekterm in" name="zoekterm" required>
			<br>
	<input type="submit" value="Zoek">
</form>
</body>
</html>