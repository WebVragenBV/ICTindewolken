<?php
header('Access-Control-Allow-Origin:*');
include '../connect.php';
$db = dbConnect();
$ophalen = addslashes($_GET['Term']);
if($ophalen == -1){
$sql = "SELECT * FROM restaurant";
$all = array();
foreach ($db->query($sql) as $row) {
		$array = array(
						array("titel" => $row['naam']),
						array("omschrijving" => $row['omschrijving']),
						array("locatie" => $row['locatie']),
						array("soort" => $row['soort']),
						array("id" => $row['id']),
						);
		array_push($all,$array);
		}
		echo json_encode($all);
    }
Else{
$sql = "SELECT * FROM restaurant WHERE id = $ophalen;";
$array = array();
foreach ($db->query($sql) as $row) {
		$restaurant = array(
						array("titel" => $row['naam']),
						array("omschrijving" => $row['omschrijving']),
						array("locatie" => $row['locatie']),
						array("soort" => $row['soort']),
						array("id" => $row['id']),
						);
		$r_id = $row['id'];
		array_push($array,$restaurant);
    }
$sql = "SELECT * FROM restaurant_tijden WHERE r_id = $r_id;";
foreach ($db->query($sql) as $row) {
		$van=substr($row['van'], 0, -3);;
		$tot=substr($row['van'], 0, -3);;
		$tijden = array(
						array("dag" => $row['dag']),
						array("van" => $van),
						array("tot" => $tot),
						);
			array_push($array,$tijden);
    }
	echo json_encode($array);
$sql = "SELECT * FROM reacties WHERE r_id = $r_id AND event=2;";
foreach ($db->query($sql) as $row) {
		$array = array(
						array("bericht" => $row['bericht']),
						array("van" => $row['van']),
						array("vote" => $row['vote']),
						);
		echo json_encode($array);
    }
}

?>