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
        <meta name="author" content="Stef Jager">
		<style>
			tr{
			background-color:lime;
			font-size:40px;
			}
		</style>
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

				include '../connect.php';
				include '../security/session.inc.php';
				$admin=$_SESSION['user']['admin'];
				if($admin='yes'){
					$db=dbConnect();
					echo "	<table><tr>
								<th>Id</th>
								<th>Status</th>
								<th>Bedrag</th>
								<th>Datum</th>
								<th>user_id</th>
								<th>soort</th>
								<th>factuur</th>
							</tr>";
					$sql = "SELECT * FROM transacties";
					foreach ($db->query($sql) as $row) {
							echo"<tr>
									<td>".$row['id']."</td>
									<td>".$row['status']."</td>
									<td>".$row['bedrag']."</td>
									<td>".$row['datum']."</td>
									<td>".$row['user_id']."</td>
									<td>".$row['soort']."</td>
									<td><a href='pdf/".$row['factuur'].".pdf'>link</a></td>
								<tr>";
						}
					echo "</table>";
				}
				elseif($admin='no'){
				echo "Alleen een admin mag deze informatie zien";
				echo "<br><a href='../login/login.php'>Inloggen</a>";
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
