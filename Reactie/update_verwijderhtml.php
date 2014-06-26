<!doctype html>
<html>
<head>
<title>
	Updating en Verwijdering
</title>
</head>
<body>
<?php
include '../connect.php';
$id = $_GET['id'];
$db = dbConnect();
$sql = "SELECT * FROM reacties WHERE id = $id AND event=2;";
foreach ($db->query($sql) as $row){
			$bericht = $row['bericht'];
			$vote = $row['vote'];
			$van = $row['van'];
			echo "<form method='post' action='update_verwijder.php'>
			<input name='id' type='hidden' value='$id'>
			<input name='van' type='hidden' value='$van'>
			<input name='vote' type='range' value='$vote' min='1' max='10' step='0.1'><br>
			<input name='reactie' type='text' value='$bericht'><br>
			<select name='target'>
				<option value='kill'>kill</option>
				<option value='update'>update</option>
			</select>
			<input type='submit'>
			</form>";
		}
?>
</body>
</html>					