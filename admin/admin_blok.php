<!DOCTYPE html>
<html>
	<head>
		<title>LeukeDingenInAlmere.nl</title>
		<link rel='stylesheet' href='../css/main.css'>
		<link rel='stylesheet' href='../css/index.css'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans'>
        <link rel='icon' href='' type='image/x-icon'>
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
        <meta charset='utf-8'> 
        <meta name='robots' content='noindex, nofollow'>
        <meta name="description" content="">
        <meta name="keywords" content="">
	</head>
	<body>
	<?php include "blokkeer.php";?>
        <div id="wrap">
            <header>
                <div class="center">
                    <a href="index.php"><img src='../logo.jpg' alt='logo'><br>
                </div>
                <nav>
                    <ul class="center">
                        <li class='current' id='item1'><a href="../index.php">Home</a></li>
                        <li id='item2'><a href="../evenementen.php">Evenementen</a></li>
                        <li id='item3'><a href="../restaurants.php">Restaurants</a></li>
                        <li id='item4'><a href="../overons.php">Over ons</a></li>
						<li id='item5'><form action='../search.php'><input type='search' placeholder='Search' name='q'></form></li>
                    </ul>
                </nav>
            </header>
            <section id="content">
				<?php
				if($_SESSION['user']['admin'] == "yes"){
						$result = $db->prepare('SELECT id FROM `user`');
						$result->execute();
						echo "<select name='gebruiker_blok'>";
						echo "<option selected value = '0' name = 'default'>Selecteer</option>";
						while($row = $result->fetch(PDO::FETCH_ASSOC)) {
							$result_naam = $db->prepare('SELECT naam FROM `user` WHERE id = ?');
							$result_naam->bindValue(1, $row['id'], PDO::PARAM_STR);
							$result_naam->execute();
							$result_naam_1 = $result_naam->fetch(PDO::FETCH_ASSOC);
							echo "<option value='".$row['id']."'>".$result_naam_1['naam']."</option>";
						}
						echo "</select>";
						echo "<select name = 'wat_te_doen'>
								<option value = '1'>Blokkeren</option>
								<option value = '0'>Deblokkeren</option>
							</select>";
						echo "<br /><input type='submit' value='Uitvoeren' />";
					}
					else {
						echo "Je bent niet ingelogd als admin en kan daarom niemand blokkeren!";
					}
				?>
            </section>
            <div id="pusher"></div>
        </div>
        <footer>
            <p class="left">&copy; 2014</p>
            <p class="right">Powered by <a href="#" rel="nofollow">Stef Jager</a></p>        
        </footer>
	</body>
</html>