<!DOCTYPE html>
<html>
	<head>
	<?php
	include "login/login.php";
	include "login/register.php";
	if(isset($_SESSION['user']))
{
  echo '<p style="position:fixed;top:0px;right:0px;z-index:120000;color:black;">Welkom! je bent ingelogd als ';
  echo $_SESSION['user']['naam'];
  echo '<br/>';
  echo '<a href="logout.php">Logout</a>';
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
			.getaway{
			text-decoration:underline;
			}
			.getaway:hover{
			text-color:blue;
			}
			#logindiv{
			text-align:center;
			}
			#registerdiv{
			text-align:center;
			}
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
					<div id="logindiv">
						<form method="POST" action="inloggen.php">
							<input type="text" name="naam" placeholder="naam" required><br>
							<input type="password" name="wachtwoord" placeholder="wachtwoord" required><br>
							<input type="submit" value="Login"></input>
						</form>
					<a class="getaway">of maak een account aan</a>
					</div>
					<div style="display:none;" id="registerdiv">
						<form method="POST" action="inloggen.php">
							<input type="text" name="naam" placeholder="naam" required><br>
							<input type="password" name="wachtwoord" placeholder="wachtwoord" required><br>
							<input type="text" name="email" placeholder="email adres" required><br>
							<input type="submit" value="Maak account"></input>
						</form>
						<a class="getaway">of log in met een account</a>
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