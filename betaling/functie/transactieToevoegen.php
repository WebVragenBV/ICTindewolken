<?php
include'../../connect.php';
function transactieToevoegen($geslaagd, $bedrag, $user_id, $soort, $transactie_id)
{
	$query=dbConnect()->prepare("INSERT INTO transactie (geslaagd, bedrag, datum, user_id, soort, transactie_id) VALUES (:geslaagd, :bedrag, NOW(), :user_id, :soort, :transactie_id)");
	$query->bindParam(':geslaagd', $geslaagd);
	$query->bindParam(':bedrag', $bedrag;
	$query->bindParam(':user_id', $user_id);
	$query->bindParam(':soort', $soort);
	$query->bindParam(':transactie_id', $transactie_id);
	$query->execute();
}
?>