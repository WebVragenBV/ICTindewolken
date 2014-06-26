<!DOCTYPE html>
<html>
	<head>
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
		<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
		<script>
		function getFotoLink(number, soort, id, cb){
			$.get("http://iwab.helenparkhurst.net/Zoek/foto.php?soort="+soort+"&id="+id ).done(function(data){
				cb("http://iwab.helenparkhurst.net/Foto/fotos/" + data, number);
			})
		}
		getFirstEvents(function(data){
			for(var i in data){
				getFotoLink(i, 0,data[i][0]['id'], function(fotolink, i){
					document.getElementById('events').innerHTML += "<div style='background:url(" + fotolink + ")'><b>" + data[i][1]['titel'] + "</b> " + data[i][2]['omschrijving'].substring(0,80) + "... <a href='evenement.php?id=" + data[i][0]['id'] + "'>Lees meer</a>";
					if(i == 0) {
						$('#sliderimg').css('background-image', 'url("'+fotolink+'")');
						document.getElementById('slidercaption').innerHTML = "<b>" + data[i][1]['titel'] + "</b> "+ data[i][2]['omschrijving'];
					}
				})
			}
		})
		getRandomRestaurants(function(data){
			for(var i in data){
				getFotoLink(i, 1,data[i][4]['id'], function(fotolink, i){
					document.getElementById('restaurants').innerHTML += "<div style='background:url(" + fotolink + ")'><b>" + data[i][0]['titel'] + "</b> " + data[i][1]['omschrijving'].substring(0,80) + "... <a href='restaurant.php?id=" + data[i][4]['id'] + "'>Lees meer</a>";
				})
			}
		})
		function getRandomRestaurants(cb){
			var output = [];
			getAllRestaurants(function(data){
				var i = 0;
				while(output.length<6){
					var random = Math.floor(data.length*Math.random());
					var b = true;
					for(f in output){
						var o = "";
						try{o = JSON.stringify(output[f]);}catch(e){}
						if(JSON.stringify(data[random]) === o){
							b = false;
						}
					}
					if(b){
						output.push(data[random]);
					}
					b = true;
				}
				cb(output);
				i++
			})
		}
		function getAllRestaurants(cb){
			$.getJSON("http://iwab.helenparkhurst.net/Reactie/ophalenrestaurant.php?Term=-1").done(function(data){
				cb(data);
			})
		}
		function getAllEvents(cb){
			$.getJSON("http://iwab.helenparkhurst.net/Reactie/ophalenevent.php?Term=-1").done(function(data){
				cb(data);
			})
		}
		function getFirstEvents(cb){
			getAllEvents(function(data){
				cb(data.slice(0,6))
			})
		}
		</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
                        <li class='current' id='item1'><a href="#">Home</a></li>
                        <li id='item2'><a href="evenementen.php">Evenementen</a></li>
                        <li id='item3'><a href="restaurants.php">Restaurants</a></li>
                        <li id='item4'><a href="overons.php">Over ons</a></li>
						<li id='item5'><form action='search.php'><input type='search' placeholder='Search' name='q'></form></li>
						<li id='item6'><a href="inloggen.php" id="login">Login</a></li>
					</ul>
                </nav>
            </header>
            <section id="content">
                <section id='slider'>
					<figure>
						<div id="img" id="sliderimg" style='background:url(http://edno.bg/assets/SAW_2013/UN/UN03.jpg)' alt='slider'></div>
						<figcaption id='slidercaption'></figcaption>
					</figure>
				</section>
				<h2>Opkomende evenementen</h2>
				<section id='events'></section>
				<h2>Restaurants</h2>
				<section id='restaurants'></section>
            </section>
            <div id="pusher"></div>
        </div>
        <footer>
            <p class="left">&copy; 2014</p>
            <p class="right"><a href="overons.php" rel="nofollow">Over ons</a> - <a href="mailto:johndoe@example.com" rel="nofollow">Contact</a></p>        
        </footer>
	</body>
</html>