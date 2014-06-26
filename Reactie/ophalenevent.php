<?php
header('Access-Control-Allow-Origin:*');
include '../connect.php';
$db = dbConnect();
$ophalen = addslashes($_GET['Term']);
if($ophalen == -1){
$sql = "SELECT * FROM event ORDER BY van_datum ASC;";
$all=array();
foreach ($db->query($sql) as $row) {
		$array = array(
						array("id" => $row['id']),
						array("titel" => $row['naam']),
						array("omschrijving" => $row['omschrijving']),
						array("locatie" => $row['locatie']),
						array("van_datum" => $row['van_datum']),
						array("tot_datum" => $row['tot_datum']),
						array("start_tijd" => $row['start_tijd']),
						array("eind_tijd" => $row['eind_tijd']),
						array("restaurant" => $row['restaurant']),
						);
		array_push($all,$array);
    }
	echo json_encode($all);
}
else{
$sql = "SELECT * FROM event WHERE id = $ophalen;";
foreach ($db->query($sql) as $row) {
		$array = array(
						array("id" => $row['id']),
						array("titel" => $row['naam']),
						array("omschrijving" => $row['omschrijving']),
						array("locatie" => $row['locatie']),
						array("van_datum" => $row['van_datum']),
						array("tot_datum" => $row['tot_datum']),
						array("start_tijd" => $row['start_tijd']),
						array("eind_tijd" => $row['eind_tijd']),
						array("restaurant" => $row['restaurant']),
						);
		echo json_encode($array);
    }
	}
?>