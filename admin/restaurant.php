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
							include '../connect.php';
							$db=dbConnect();
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
							//verwerken als restaurant
							if (empty($_POST['soort'])) {
								$error.="<pre class='error'>Je moet de soort van het restaurant invoeren</pre>";
							}
							if (empty($_POST['ma']) && empty($_POST['matot'])) {
								$error.="<pre class='error'>Je moet de hele tijd invoeren van maandag</pre>";
							}
							if (empty($_POST['di']) && empty($_POST['ditot'])) {
								$error.="<pre class='error'>Je moet de hele tijd invoeren van dinsdag</pre>";
							}
							if (empty($_POST['wo']) && empty($_POST['wotot'])) {
								$error.="<pre class='error'>Je moet de hele tijd invoeren van woensdag</pre>";
							}
							if (empty($_POST['do']) && empty($_POST['dotot'])) {
								$error.="<pre class='error'>Je moet de hele tijd invoeren van donderdag</pre>";
							}
							if (empty($_POST['vr']) && empty($_POST['vrtot'])) {
								$error.="<pre class='error'>Je moet de hele tijd invoeren van vrijdag</pre>";
							}
							if (empty($_POST['za']) && empty($_POST['za'])) {
								$error.="<pre class='error'>Je moet de hele tijd invoeren van zaterdag</pre>";
							}
							if (empty($_POST['zo']) && empty($_POST['zotot'])) {
								$error.="<pre class='error'>Je moet de hele tijd invoeren van zondag</pre>";
							}

							//kijken of er errors zijn zo ja dan showen, anders verwerken in database
							if (empty($error)) {
								//verwerk in database
								//verwerk restaurant
								$insertTry = "INSERT INTO restaurant (naam,omschrijving,soort,locatie) VALUES (:naam,:omschrijving,:soort,:locatie)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':naam'=>$_POST['naam'],':omschrijving'=>$_POST['omschrijving'],':soort'=>$_POST['soort'],':locatie'=>$_POST['locatie']));

								//verwerk openingstijden
								$checkUsers = "SELECT id FROM restaurant WHERE naam = :naam AND omschrijving = :omschrijving";
								$userStmt = $db->prepare($checkUsers);
								$userStmt->execute(array(':naam'=>$_POST['naam'],':omschrijving'=>$_POST['omschrijving']));
								$idrestaurant = $userStmt->fetchAll();
								
								//maandag openingstijden invoeren
								$insertTry = "INSERT INTO restaurant_tijden (`r_id`,dag,van,tot) VALUES (:id,:dag,:van,:tot)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':id'=>$idrestaurant[0]['id'],':dag'=>'ma',':van'=>$_POST['ma'],':tot'=>$_POST['matot']));

								//dinsdag openingstijden invoeren
								$insertTry = "INSERT INTO restaurant_tijden (`r_id`,dag,van,tot) VALUES (:id,:dag,:van,:tot)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':id'=>$idrestaurant[0]['id'],':dag'=>'di',':van'=>$_POST['di'],':tot'=>$_POST['ditot']));

								//woensdag openingstijden invoeren
								$insertTry = "INSERT INTO restaurant_tijden (`r_id`,dag,van,tot) VALUES (:id,:dag,:van,:tot)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':id'=>$idrestaurant[0]['id'],':dag'=>'wo',':van'=>$_POST['wo'],':tot'=>$_POST['wotot']));

								//donderdag openingstijden invoeren
								$insertTry = "INSERT INTO restaurant_tijden (`r_id`,dag,van,tot) VALUES (:id,:dag,:van,:tot)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':id'=>$idrestaurant[0]['id'],':dag'=>'do',':van'=>$_POST['do'],':tot'=>$_POST['dotot']));

								//vrijdag openingstijden invoeren
								$insertTry = "INSERT INTO restaurant_tijden (`r_id`,dag,van,tot) VALUES (:id,:dag,:van,:tot)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':id'=>$idrestaurant[0]['id'],':dag'=>'vr',':van'=>$_POST['vr'],':tot'=>$_POST['vrtot']));

								//zaterdag openingstijden invoeren
								$insertTry = "INSERT INTO restaurant_tijden (`r_id`,dag,van,tot) VALUES (:id,:dag,:van,:tot)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':id'=>$idrestaurant[0]['id'],':dag'=>'za',':van'=>$_POST['za'],':tot'=>$_POST['zotot']));

								//zondag openingstijden invoeren
								$insertTry = "INSERT INTO restaurant_tijden (`r_id`,dag,van,tot) VALUES (:id,:dag,:van,:tot)";
								$insertStmt = $db->prepare($insertTry);
								$insertStmt->execute(array(':id'=>$idrestaurant[0]['id'],':dag'=>'zo',':van'=>$_POST['zo'],':tot'=>$_POST['zotot']));
								echo '<pre class="success">Het restaurant is toegevoegd</pre>';
							} else {
								//show errors
								echo $error;
							}
						} catch (PDOException $e) {
							$tryerror = $e->getMessage();
							//print_r($tryerror);
						}
					} else {
						//Formulier showen om event/restaurant toe te voegen
					?>
						<form method="post">
							<p><label for="naam">Naam</label><input type="text" name="naam" id="naam"></p>
							<p><label for="omschrijving">Omschrijving</label><textarea name="omschrijving" id="omschrijving"></textarea></p>
							<p><label for="locatie">Locatie</label><input type="text" name="locatie" id="locatie"></p>
							<p><label for="soort">Soort</label><input name="soort" id="soort"></p>
							<p><label for="ma">Ma</label><input type="time" name="ma" id="ma"> - <input type="time" name="matot"></p>
							<p><label for="di">Di</label><input type="time" name="di" id="di"> - <input type="time" name="ditot"></p>
							<p><label for="wo">Wo</label><input type="time" name="wo" id="wo"> - <input type="time" name="wotot"></p>
							<p><label for="do">Do</label><input type="time" name="do" id="do"> - <input type="time" name="dotot"></p>
							<p><label for="vr">Vr</label><input type="time" name="vr" id="vr"> - <input type="time" name="vrtot"></p>
							<p><label for="za">Za</label><input type="time" name="za" id="za"> - <input type="time" name="zatot"></p>
							<p><label for="zo">Zo</label><input type="time" name="zo" id="zo"> - <input type="time" name="zotot"></p>
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