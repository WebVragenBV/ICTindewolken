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
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	</head>
	<body>
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
				if (isset($_POST['toevoegen'])) {
					try{
			    		$db = new PDO('mysql:host=localhost;dbname=groepb_ict', 'groepb_ict', 'Tdx0ZKXT');
						$error="";
						//controlleren of er velden niet zijn ingevuld.
						if (empty($_POST['naam'])) {
							$error.="<pre class='error'>Je moet een naam invoeren</pre>";
						}
						if (empty($_POST['omschrijving'])) {
							$error.="<pre class='error'>Je moet een omschrijving invoeren</pre>";
						}
						if (empty($_POST['locatie'])) {
							$error.="<pre class='error'>Je moet een locatie invoeren</pre>";
						}
						//verwerken als event in database
						if (empty($_POST['vandatum'])) {
							$error.="<pre class='error'>Je moet een begin datum invoeren</pre>";
						}
						if (empty($_POST['totdatum'])) {
							$error.="<pre class='error'>Je moet een eind datum invoeren</pre>";
						}
						if (empty($_POST['starttijd'])) {
							$error.="<pre class='error'>Je moet een start tijd invoeren</pre>";
						}
						if (empty($_POST['eindtijd'])) {
							$error.="<pre class='error'>Je moet een eind tijd invoeren</pre>";
						}

						if (!empty($_POST['restaurant'])) {
							$restaurant = (int)$_POST['restaurant'];
						} else {
							$restaurant = 0;
						}

						//kijken of er errors zijn zo ja dan showen, anders verwerken in database
						if (empty($error)) {
							//verwerk in database
							$insertTry = "INSERT INTO event (naam,omschrijving,`van_datum`,`tot_datum`,`start_tijd`,`eind_tijd`,locatie,restaurant) VALUES (:naam,:omschrijving,:vandatum,:totdatum,:starttijd,:eindtijd,:locatie,:restaurant)";
							$insertStmt = $db->prepare($insertTry);
							$insertStmt->execute(array(':naam'=>$_POST['naam'],':omschrijving'=>$_POST['omschrijving'],':vandatum'=>$_POST['vandatum'],':totdatum'=>$_POST['totdatum'],':starttijd'=>$_POST['starttijd'],':eindtijd'=>$_POST['eindtijd'],':locatie'=>$_POST['locatie'],':restaurant'=>$restaurant));
							
							echo '<pre class="success">Het event is toegevoegd</pre>';
						} else {
							//show errors
							echo $error;
						}
					} catch (PDOException $e) {
						$tryerror = $e->getMessage();
						//print_r($tryerror);
					}
				} else {
					//Formulier showen om event toe te voegen
				?>
					<form method="post">
						<p><label for="naam">Naam</label><input type="text" name="naam" id="naam"></p>
						<p><label for="omschrijving">Omschrijving</label><textarea name="omschrijving" id="omschrijving"></textarea></p>
						<p><label for="locatie">Locatie</label><input type="text" name="locatie" id="locatie"></p>
						<p><label for="vandatum">Van datum</label><input type="date" name="vandatum" id="vandatum"></p>
						<p><label for="totdatum">Tot datum</label><input type="date" name="totdatum" id="totdatum"></p>
						<p><label for="starttijd">Start tijd</label><input type="time" name="starttijd" id="starttijd"></p>
						<p><label for="eindtijd">Eind tijd</label><input type="time" name="eindtijd" id="eindtijd"></p>
						<p><label for="restaurant">Restaurant ID</label><input type="text" name="restaurant" list="restaurantlist" id="restaurant">
							<datalist id="restaurantlist">
							<?php
							try{
					    		$db = new PDO('mysql:host=localhost;dbname=groepb_ict', 'groepb_ict', 'Tdx0ZKXT');
								$checkUsers = "SELECT id,naam FROM restaurant";
								$userStmt = $db->prepare($checkUsers);
								$userStmt->execute();
								$restaurant = $userStmt->fetchAll();

								for ($i=0;$i<count($restaurant);$i++) { 
									echo '<option value="'.$restaurant[$i]['id'].'">'.$restaurant[$i]['naam'].'</option>';
								}
							} catch (PDOException $e) {
								$tryerror = $e->getMessage();
								//print_r($tryerror);
							}
							?>
							</datalist>
						</p>
						<p><input type="submit" value="toevoegen" name="toevoegen"></p>
					</form>
				<?php
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