<!DOCTYPE html>
<html>
	<head>
	<?php
	include "login/UpdateMail.php";
	include "login/UpdatePass.php";
	include'security/session.inc.php';
	if(isset($_SESSION['user']))
{
  echo '<p style="position:fixed;top:0px;right:0px;z-index:120000;color:black;">Welkom! je bent ingelogd als ';
  echo $_SESSION['user']['naam'];
  echo '<br/>';
  echo '<a href="login/logout.php">Logout</a>';
  if ($_SESSION['user']['admin']=='yes')
  {
    echo 'You are admin</p>';
  }
  else
  {
    echo 'You are NOT admin</p>';
  }
}
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
						<div style="position:absolute;right:150px;top:400px;">
						  <a href="login/logout.php"><button style="height:100px;width:100px;margin:3px;color:red;border: 2px solid #900;">Log uit</button></a>
					    </div>
					</div>
					
				</div>
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