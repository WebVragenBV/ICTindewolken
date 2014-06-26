<?php
function transactieWijzigen($status,$transactieID)
{
	include_once '../../connect.php'; //database connectie include
	try
	{
		$db = dbConnect();
		$query = dbConnect()->prepare("UPDATE transacties SET status=:status WHERE transactieID=:transactieID");
		$query->bindParam(':status', $status);
		$query->bindParam(':transactieID', $transactieID);
		$query->execute();

		if ($status=='paid') {
			//sleep een seconden om fouten tegen te gaan, als seconden nul is
			if (date('s')==0)
				sleep(1);

			$factuurnummer = date('Y').date('m').date('d').date('H').date('i').date('s');

			//de betaling is gelukt. Maak een factuur
			include_once '../factuur.php';
			createFactuur('../pdf/'.$factuurnummer, "F");

			$query = dbConnect()->prepare("UPDATE transacties SET factuur=:factuur WHERE transactieID=:transactieID");
			$query->bindParam(':factuur', $factuurnummer);
			$query->bindParam(':transactieID', $transactieID);
			$query->execute();
		}
	}
	catch(PDOException $e){
    	$error = 'ERROR'. $e->getMessage();
    }
}

echo transactieWijzigen('paid','1204050202');
?>