<?php
$ip = $_SERVER['REMOTE_ADDR'];
include_once 'connect.php';
$db = dbConnect();

function controle_nieuw ($ip)
{
	global $db;
	$query = $db->prepare('SELECT COUNT(`id`) as cnt FROM `ip_adres` WHERE ip = ?');
	$query->bindValue(1, $ip, PDO::PARAM_STR);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_OBJ);
	$x = $result->cnt == 1 ? true : false;
	return $x ; 
}

if (controle_nieuw($ip) === false)
{
	$query = $db->prepare('INSERT INTO `ip_adres` (`ip`) VALUES (?)');
	$query->bindValue(1, $ip, PDO::PARAM_STR);
	$query->execute();
}	
else if(controle_nieuw($ip) === true) 
{
	function controle_blok ($ip)
	{
		global $db;
		$query2 = $db->prepare('SELECT (`blok`) as cnt FROM `ip_adres` WHERE ip = ?');
		$query2->bindValue(1, $ip, PDO::PARAM_STR);
		$query2->execute();
		$result2 = $query2->fetch(PDO::FETCH_OBJ);
		$y = $result2->cnt == 1 ? true : false;
		return $y ; 
	}
	if (controle_blok($ip) === true)
		header ("location: http://iwab.helenparkhurst.net/geblokkeerd.php");	
}
?>