<html>
<body>

<?php
$db = new PDO('mysql:host=localhost;dbname=groepb_ict;charset=utf8', 'groepb_ict', 'Tdx0ZKXT');
$week_later = date('Y-m-d', strtotime('+1 week'));

$result = $db->prepare('SELECT id FROM `herriner` WHERE tijd = ?');
$result->bindValue(1, $week_later, PDO::PARAM_STR);
$result->execute();

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
	#echo "row |id|: ";
	#echo $row['id'];

	#$id_ontvanger
	$id_ontvanger = $db->prepare('SELECT user_id FROM `herriner` WHERE id = ?');
	$id_ontvanger->bindValue(1, $row['id'], PDO::PARAM_STR);
	$id_ontvanger->execute();
	$id_ontvanger_1 = $id_ontvanger->fetch(PDO::FETCH_ASSOC);

	#echo "<br />";
	#echo "id_ontvanger_1 |user_id|: ";
	#echo $id_ontvanger_1['user_id'];

	#$naam_ontvanger
	$naam_ontvanger = $db->prepare('SELECT naam FROM `user` WHERE id = ?');
	$naam_ontvanger->bindValue(1, $id_ontvanger_1['user_id'], PDO::PARAM_STR);
	$naam_ontvanger->execute();
	$naam_ontvanger_1 = $naam_ontvanger->fetch(PDO::FETCH_ASSOC);

	#echo "<br />";
	#echo "naam_ontvanger_1 |naam|: ";
	#echo $naam_ontvanger_1['naam'];

	#$mail_adres_ontvanger
	$mail_adres_ontvanger = $db->prepare('SELECT email FROM `user` WHERE naam = ?');
	$mail_adres_ontvanger->bindValue(1, $naam_ontvanger_1['naam'], PDO::PARAM_STR);
	$mail_adres_ontvanger->execute();
	$mail_adres_ontvanger_1 = $mail_adres_ontvanger->fetch(PDO::FETCH_ASSOC);

	#echo "<br />";
	#echo "mail_adres_ontvanger_1 |email|: ";
	#echo $mail_adres_ontvanger_1['email'];

	#$restaurant_of_event
	$restaurant_of_event = $db->prepare('SELECT event FROM `herriner` WHERE id = ?');
	$restaurant_of_event->bindValue(1, $row['id'], PDO::PARAM_STR);
	$restaurant_of_event->execute();
	$restaurant_of_event_1 = $restaurant_of_event->fetch(PDO::FETCH_ASSOC);

	#echo "<br />";
	#echo "<br />";
	#echo "restaurant_of_event_1 |event|: ";
	#echo $restaurant_of_event_1['event'];

	#If/else $restaurant_of_event_1
	if($restaurant_of_event_1['event'] == 1) {
		#echo "<br />";
		#echo "Event.";

		#$event
		$event = $db->prepare('SELECT r_id FROM herriner WHERE id = ?');
		$event->bindValue(1, $restaurant_of_event_1['event'], PDO::PARAM_STR);
		$event-> execute();
		$event_1 = $event->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_1 |r_id|: ";
		#echo $event_1['r_id'];

		#$event_naam
		$event_naam = $db->prepare('SELECT naam FROM event WHERE id = ?');
		$event_naam->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_naam-> execute();
		$event_naam_1 = $event_naam->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_naam_1 |naam|: ";
		#echo $event_naam_1['naam'];

		#$event_tijd_begin
		$event_tijd_begin = $db->prepare('SELECT start_tijd FROM event WHERE id = ?');
		$event_tijd_begin->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_tijd_begin-> execute();
		$event_tijd_begin_1 = $event_tijd_begin->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_tijd_begin_1 |start_tijd|: ";
		#echo $event_tijd_begin_1['start_tijd'];

		#$event_tijd_eind
		$event_tijd_eind = $db->prepare('SELECT eind_tijd FROM event WHERE id = ?');
		$event_tijd_eind->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_tijd_eind-> execute();
		$event_tijd_eind_1 = $event_tijd_eind->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_tijd_eind_1 |eind_tijd|: ";
		#echo $event_tijd_eind_1['eind_tijd'];

		#$event_datum_start
		$event_datum_start = $db->prepare('SELECT van_datum FROM event WHERE id = ?');
		$event_datum_start->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_datum_start-> execute();
		$event_datum_start_1 = $event_datum_start->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_datum_start_1 |van_datum|: ";
		#echo $event_datum_start_1['van_datum'];

		#$event_datum_eind
		$event_datum_eind = $db->prepare('SELECT tot_datum FROM event WHERE id = ?');
		$event_datum_eind->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_datum_eind-> execute();
		$event_datum_eind_1 = $event_datum_eind->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_datum_eind_1 |tot_datum|: ";
		#echo $event_datum_eind_1['tot_datum'];

		#$event_locatie
		$event_locatie = $db->prepare('SELECT locatie FROM event WHERE id = ?');
		$event_locatie->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_locatie-> execute();
		$event_locatie_1 = $event_locatie->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_locatie_1 |locatie|: ";
		#echo $event_locatie_1['locatie'];

		#$event_omschrijving
		$event_omschrijving = $db->prepare('SELECT omschrijving FROM event WHERE id = ?');
		$event_omschrijving->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_omschrijving-> execute();
		$event_omschrijving_1 = $event_omschrijving->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_omschrijving_1 |omschrijving|: ";
		#echo $event_omschrijving_1['omschrijving'];
	}
	elseif ($restaurant_of_event_1['event'] == 2) {
		#echo "<br />";
		#echo "Restaurant";

		#$event
		$event = $db->prepare('SELECT r_id FROM herriner WHERE id = ?');
		$event->bindValue(1, $restaurant_of_event_1['event'], PDO::PARAM_STR);
		$event-> execute();
		$event_1 = $event->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_1 |r_id|: ";
		#echo $event_1['r_id'];

		#$event_naam
		$event_naam = $db->prepare('SELECT naam FROM restaurant WHERE id = ?');
		$event_naam->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_naam-> execute();
		$event_naam_1 = $event_naam->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_naam_1 |naam|: ";
		#echo $event_naam_1['naam'];

		#$event_tijd_begin
		$event_tijd_begin = $db->prepare('SELECT van FROM restaurant_tijden WHERE r_id = ?');
		$event_tijd_begin->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_tijd_begin-> execute();
		$event_tijd_begin_1 = $event_tijd_begin->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_tijd_begin_1 |start_tijd|: ";
		#echo $event_tijd_begin_1['start_tijd'];

		#$event_tijd_eind
		$event_tijd_eind = $db->prepare('SELECT tot FROM restaurant_tijden WHERE r_id = ?');
		$event_tijd_eind->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_tijd_eind-> execute();
		$event_tijd_eind_1 = $event_tijd_eind->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_tijd_eind_1 |eind_tijd|: ";
		#echo $event_tijd_eind_1['eind_tijd'];

		#$event_datum_start
		$event_datum_start = $db->prepare('SELECT dag FROM restaurant_tijden WHERE r_id = ?');
		$event_datum_start->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_datum_start-> execute();
		$event_datum_start_1 = $event_datum_start->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_datum_start_1 |van_datum|: ";
		#echo $event_datum_start_1['van_datum'];

		#$event_datum_eind
		$event_datum_eind = $db->prepare('SELECT dag FROM restaurant_tijden WHERE r_id = ?');
		$event_datum_eind->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_datum_eind-> execute();
		$event_datum_eind_1 = $event_datum_eind->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_datum_eind_1 |tot_datum|: ";
		#echo $event_datum_eind_1['tot_datum'];

		#$event_locatie
		$event_locatie = $db->prepare('SELECT locatie FROM restaurant WHERE id = ?');
		$event_locatie->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_locatie-> execute();
		$event_locatie_1 = $event_locatie->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_locatie_1 |locatie|: ";
		#echo $event_locatie_1['locatie'];

		#$event_omschrijving
		$event_omschrijving = $db->prepare('SELECT omschrijving FROM restaurant WHERE id = ?');
		$event_omschrijving->bindValue(1, $event_1['r_id'], PDO::PARAM_STR);
		$event_omschrijving-> execute();
		$event_omschrijving_1 = $event_omschrijving->fetch(PDO::FETCH_ASSOC);

		#echo "<br />";
		#echo "event_omschrijving_1 |omschrijving|: ";
		#echo $event_omschrijving_1['omschrijving'];
	}

	$onderwerp = "Herinnering voor: " .$event_naam_1['naam'];
	#echo "<br />";
	#echo $onderwerp;
	
	if($restaurant_of_event_1['event'] == 1) {
		$bericht = "Hallo "	.$naam_ontvanger_1['naam'].
		",\n\nJij hebt een herinnering aangevraagd voor het volgende event: " .$event_naam_1['naam'].
		".\nBeschrijving: " .$event_omschrijving_1['omschrijving'].
		".\nHet begint om: " .$event_tijd_begin_1['start_tijd'].
		" op " .$event_datum_start_1['van_datum'].
		" en het eindigt om " .$event_tijd_eind_1['eind_tijd'].
		" op " .$event_datum_eind_1['tot_datum'].
		".\nDe plaats waar dit event plaats vindt is: " .$event_locatie_1['locatie'].
		".\n\nDit bericht is automatisch gegenereerd en hier kan dus niet op gereageerd worden.\n\nMet vriendelijke groeten,\n\nleukedingeninalmere.nl";
	}
	elseif ($restaurant_of_event_1['event'] == 2) {
		$bericht = "Hallo "	.$naam_ontvanger_1['naam'].
		",\n\nJij hebt een herinnering aangevraagd voor het volgende restaurant: " .$event_naam_1['naam'].
		".\nBeschrijving: " .$event_omschrijving_1['omschrijving'].
		".\nHet begint om: " .$event_tijd_begin_1['van'].
		" op " .$event_datum_start_1['dag'].
		" en het eindigt om " .$event_tijd_eind_1['tot'].
		" op " .$event_datum_eind_1['dag'].
		".\nDe plaats waar dit restaurant is, is: " .$event_locatie_1['locatie'].
		".\n\nDit bericht is automatisch gegenereerd en hier kan dus niet op gereageerd worden.\n\nMet vriendelijke groeten,\n\nleukedingeninalmere.nl";
	}

	#echo "<br />";
	#echo "<br />";
	#echo $bericht;
	#echo "<br />";
	
	$email = $mail_adres_ontvanger_1['email'];
	#echo "<br />";
	#echo $email;
	#echo "<br />";

	mail($email, $onderwerp, $bericht);
	#echo "Gelukt!";
}

?>
</body>
</html>