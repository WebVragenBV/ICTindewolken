<?php
header('Access-Control-Allow-Origin: *');
include '../connect.php';
$db = dbConnect();
$zoek = $_GET['zoekterm']; 
if (!ini_get('magic_quotes_gpc')) // check if the option is enabled 
 $zoek = addslashes($zoek);
 $order = $_GET['sorteer'];
 $json = array();
 if ($order == "soort"){
$order = "naam";
}
$sql = "SELECT * FROM event WHERE naam LIKE '%$zoek%'
						OR omschrijving LIKE '%$zoek%' 
						OR locatie LIKE '%$zoek%' ORDER BY $order ASC"; 				
	foreach ($db->query($sql) as $row) {
		$array = array(
						"Soort" => "Event",
						"ID" => $row['id'],
						"Titel" => $row['naam'],
						"Omschrijving" => $row['omschrijving'],
						"Locatie" => $row['locatie'],
						);
		if($array != null){
			array_push($json,$array);
		}
    }
if ($order == "van_datum"){
$order = "naam";
}
$sql = "SELECT * FROM restaurant WHERE naam LIKE '%$zoek%'
						OR omschrijving LIKE '%$zoek%' 
						OR soort LIKE '%$zoek%' 
						OR locatie LIKE '%$zoek%' ORDER BY $order ASC"; 
	foreach ($db->query($sql) as $row) {
		$array = array(
						"Soort" => "restaurant",
						"ID" => $row['id'],
						"Titel" => $row['naam'],
						"Omschrijving" => $row['omschrijving'],
						"Locatie" => $row['locatie'],
						);
		if($array != null){
			array_push($json,$array);
		}
    }
$sql = "SELECT COUNT(*) FROM statestiek_zoek WHERE woord = '$zoek'";
foreach ($db->query($sql) as $row){
	}
if ($row[0] == 1){
$sql = "SELECT count FROM statestiek_zoek WHERE woord = '$zoek'";
foreach ($db->query($sql) as $count){
	$count = $count[0] + 1;
	}
$sql = "UPDATE statestiek_zoek SET count = ? WHERE woord = ?";
$q = $db->prepare($sql);
$q->execute(array($count,$zoek));

}
elseif ($row[0] == 0){
$sql = "INSERT INTO statestiek_zoek (woord,count) VALUES (:woord,:count)";
$q = $db->prepare($sql);
$q->execute(array(':woord'=>$zoek,
                  ':count'=>1));

}
echo json_encode($json);
?>