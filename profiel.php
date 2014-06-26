<!DOCTYPE html>
<html>
<head>
<?php
	include'security/session.inc.php';
	include "login/UpdateMail.php";
	include "login/UpdatePass.php";
	
?>
<title>LeukeDingenInAlmere.nl</title>
<link rel='stylesheet' href='css/main.css'>
<link rel='stylesheet' href='css/index.css'>
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans'>
<link rel='icon' href='' type='image/x-icon'>
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
<meta charset='utf-8'> 
<meta name='robots' content='noindex, nofollow'>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Stef Jager">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$(".getaway").click(function(){
		$("#logindiv").toggle(1000);
		$("#registerdiv").toggle(1000);
		});
	});
</script>
<style>
</style>
</head>
<body>
<?php include_once 'IPblok.php'; ?>
	<div id="wrap">
        <header>
        <div class="center">
        	<a href="index.php"><img src='logo.jpg' alt='logo'><br>
        </div>
        <nav>
        <ul class="center">
        	<li class='current' id='item1'><a href="index.php">Home</a></li>
                <li id='item2'><a href="evenementen.php">Evenementen</a></li>
                <li id='item3'><a href="restaurants.php">Restaurants</a></li>
                <li id='item4'><a href="overons.php">Over ons</a></li>
		<li id='item5'><form action='search.php'><input type='search' placeholder='Search' name='q'></form></li>
		<li id='item6'><a id="login">Login</a></li>
	</ul>
        </nav>
        </header>
        <section id="content">
        
        <?php if(isset($_SESSION['user'])): ?>
  	Je bent ingelogd als <?php echo $_SESSION['user']['naam']; ?>
  	<br>
  	je kunt hier <a href="login/logout.php">Uitloggen</a>
	<?php else: ?>
  	Je bent niet ingelogd, 
	<?php endif; ?>
	
	<?php if(isset($_SESSION['user'])): ?>
	<div id="contention">
		<div id="UpdateMail">
			<h1>update mail</h1>
			<form method="POST" action="profiel.php">
				<input type="text" name="naam" placeholder="name" required><br/>
				<input type="password" name="wachtwoord" placeholder="password" required><br />
				<input type="text" name="newemail" placeholder="email" required><br />
				<input type="submit">
			</form>
		</div>
		<div id="registerdiv">
			<h1>update password</h1>
			<form method="POST" action="profiel.php">
				<input type="text" name="naam" placeholder="name" required><br/>
				<input type="password" name="wachtwoord" placeholder="current password" required><br />
				<input type="password" name="newwachtwoord" placeholder="password" required><br />
				<input type="submit">
			</form>
		</div>
	</div>
	<?php else: ?>
  	je moet inloggen om je profiel bij te werken
	<?php endif; ?>
	
        </section>
        <div id="pusher"></div>
        </div>
        <footer>
            <p class="left">&copy; 2014</p>
            <p class="right"><a href="overons.html" rel="nofollow">Over ons</a> - <a href="mailto:johndoe@example.com" rel="nofollow">Contact</a></p>        
        </footer>
	</body>
</html>
</html>
