<?php
include '../connect.php';
include '../security/session.inc.php';
		$target = $_POST['target'];
		$db = dbConnect();
		$id = $_POST['id'];
		$reactie = $_POST['reactie'];
		$vote = $_POST['vote'];
		$userid = $_SESSION['user']['id'];
		$admin = $_SESSION['user']['admin'];
		$van = $_POST['van'];
If($admin == 'yes' || $van == $userid){
Update();
}
Else{
echo "Alleen de maker of Admin mag het bericht verwijderen of aanpassen";
}
	function Update(){
		$target = $_POST['target'];
		$db = dbConnect();
		$id = $_POST['id'];
		$reactie = $_POST['reactie'];
		$vote = $_POST['vote'];
		$userid = $_SESSION['user']['id'];
		$admin = $_SESSION['user']['admin'];
		$van = $_POST['van'];		
	if($target == 'update'){
			 $reactie = addslashes($reactie);
			 $vote = addslashes($vote);
			$sql = "UPDATE reacties Set vote=:vote, bericht=:bericht WHERE id=$id";
				$q = $db->prepare($sql);
				$q->execute(array(	
									':vote'=>$vote,
									':bericht'=>$reactie,
								));
							}
	elseif($target='kill')	{
			$sql = "DELETE FROM reacties WHERE id=$id";
				$q = $db->prepare($sql);
				$q->execute();
							}
	header ('Location:update_verwijderhtml.php');
	}
?>