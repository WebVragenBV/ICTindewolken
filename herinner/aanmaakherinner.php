<!DOCTYPE html>
<html>
	<head>
		<title>
			Herinnering aanmaken
		</title>
		<?php
		session_start();

			$db = new PDO('mysql:host=localhost;dbname=groepb_ict;charset=utf8', 'groepb_ict', 'Tdx0ZKXT');
			$soort = 1;

			if(isset($_POST['event'])) {
				$gebruiker_ophalen = $db->prepare("SELECT id FROM user WHERE naam = ?");
				$gebruiker_ophalen->bindValue(1, $_SESSION['user']['naam'], PDO::PARAM_STR);
				$gebruiker_ophalen->execute();
				$gebruiker_ophalen_1 = $gebruiker_ophalen->fetch(PDO::FETCH_ASSOC);

				$event_id = $_POST['event'];

				$datum = $db->prepare("SELECT van_datum FROM event WHERE id = ?");
				$datum->bindValue(1, $event_id, PDO::PARAM_STR);
				$datum->execute();
				$datum_1 = $datum->fetch(PDO::FETCH_ASSOC);

				$invoegen = $db->prepare("INSERT INTO herriner(user_id, tijd, event, r_id) VALUES(:user_id, :tijd, :event, :r_id)");
				$invoegen->bindValue(':user_id', $gebruiker_ophalen_1['id'], PDO::PARAM_INT);
				$invoegen->bindValue(':tijd', $datum_1['van_datum'], PDO::PARAM_STR);
				$invoegen->bindValue(':event', $soort, PDO::PARAM_INT);
				$invoegen->bindValue(':r_id', $event_id, PDO::PARAM_INT);
				$invoegen->execute();
			}
		?>
	</head>
	<body>
		<form action="" method="post">
			
			<?php
			if(isset($_SESSION['user']['naam'])){
				$result = $db->prepare('SELECT id FROM `event`');
				$result->execute();
				echo "<select name='event'>";
				echo "<option selected value = '0' name = 'default'>Selecteer</option>";
				while($row = $result->fetch(PDO::FETCH_ASSOC)) {
					$result_naam = $db->prepare('SELECT naam FROM `event` WHERE id = ?');
					$result_naam->bindValue(1, $row['id'], PDO::PARAM_STR);
					$result_naam->execute();
					$result_naam_1 = $result_naam->fetch(PDO::FETCH_ASSOC);
						echo "<option name='".$row['id']."' value='".$row['id']."'>".$result_naam_1['naam']."</option>";
					}
					echo "</select>";
				echo "<br /><input type='submit' value='Verzenden' />";
			}
			else {
				echo "Je bent niet ingelogd en kan dus geen herinnering aanmaken!";
			}
			?>
			
		</form>
	</body>
</html>