<?php 
// include: ../security/session.inc.php 
	session_start(); 
	ini_set('session.save_path', '../tmp'); 
	ini_set('session.name', 'hash');
	if (!isset($_SESSION['ip'])){ 
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; 
		if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) 
		trigger_error("Session Hijacking detected!", E_USER_WARNING);}
?> 
