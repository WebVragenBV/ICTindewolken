<?php
include '../connect.php';
include '../security/session.inc.php';

$db = dbConnect();
$id = $_POST['id'];
$event = $_POST['type'];
 $reactie = $_POST['reactie'];
 $van =  $_SESSION['user']['id'];
 $vote = $_POST['vote'];
 $ip = $_SERVER['REMOTE_ADDR'];
 if ($event = "restaurant"){
 $event = 2;
 }
 if ($event = "event"){
 $event = 1;
 }
 $reactie = addslashes($reactie);
 $vote = addslashes($vote);
$sql = "INSERT INTO reacties (event,vote,r_id,bericht,van,ip) VALUES (:event,:vote,:r_id,:bericht,:van,:ip)";
	$q = $db->prepare($sql);
	$q->execute(array(	':event'=>$event,
						':vote'=>$vote,
						':r_id'=>$id,
						':bericht'=>$reactie,
						':van'=>$van,
						':ip'=>$ip,
					));
 header('Location:../evenement.php?id='.$_GET['current'])
?>