<?php
include "../security/session.inc.php";
		include "../connect.php";
$db = dbConnect();

			if(isset($_POST['gebruiker_blok']) && isset($_POST['wat_te_doen'])) {
				$wie = $_POST['gebruiker_blok'];
				$blok = $_POST['wat_te_doen'];


				$invoegen = $db->prepare("UPDATE user SET blok = :blok WHERE id = :wie");
				$invoegen->execute( array(
					':blok'=>$blok,
					':wie'=>$wie,
				));
			}
?>