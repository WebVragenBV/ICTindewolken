<?php
header('Access-Control-Allow-Origin:*');
include '../connect.php';
$id = $_GET['id'];
$soort = $_GET['soort'];
if($soort == '0')
	$soort = 'event';
else
	$soort = 'restaurant';

	$db = dbConnect();
	$checkUsers = "SELECT naam FROM ".$soort." WHERE id = :id";
	$userStmt = $db->prepare($checkUsers);
	$userStmt->bindParam(':id', $id); 
	$userStmt->execute();
	$result = $userStmt->fetchAll();

	$name = $result[0]['naam'];
	$space = " ";
	$balkje = "_";	
	$name = str_replace($space,$balkje,$name);
	$name = strtolower($name);
	$name = $name.".png";
	echo $name;
?>