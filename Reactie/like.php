<?php
include '../connect.php';
$db = dbConnect();
$vote = $_POST['vote'];
$id = $_POST['id'];
$van = 
$type = $_POST['type'];
if ($type == 'restaurant'){
$type = "reactie_stem";
}
elseif ($type == 'event'){
$type = "event_stem";
}
if (!ini_get('magic_quotes_gpc'))
 $van = addslashes($van);
elseif ($vote == 'like'){
$vote = 1;
}
elseif ($vote == 'dislike'){
$vote = -1;
}
		$sql = "SELECT COUNT(*) FROM $type WHERE van = '$van'";
foreach ($db->query($sql) as $row){
	}
	$count = $row[0];
if ($count > 0){
	echo "U kunt niet 2 maal reageren";
}
elseif ($count == 0){
	$sqlb = "INSERT INTO $type (r_id,vote,van) VALUES (:r_id,:vote,:van)";
	$q = $db->prepare($sqlb);
	$q->execute(array(':r_id'=>$id,
					':vote'=>$vote,
					':van'=>$van,
					));
}
 header ('Location:reactie.html')
?>