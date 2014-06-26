<!DOCTYPE html>
<html>
	<head>
		<title>LeukeDingenInAlmere.nl</title>
		<link rel='stylesheet' href='css/main.css'>
		<link rel='stylesheet' href='css/search.css'>
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
        $(document).ready(function(){
            function getURLParameter(name) {
                return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
            }
            var q = getURLParameter('q');
            document.getElementById('query').innerHTML = q;
            $.getJSON("http://www.iwab.helenparkhurst.net/Zoek/zoeken.php?sorteer=soort&zoekterm="+q, function(data) {
                var response = data;
                var results = document.getElementById('results');
                response.forEach(function(response) {
                    if(results.innerHTML != "") {
                        results.innerHTML += "<br>";
                    }
                    if(response['soort'] == "evenement") {
                        results.innerHTML += "<a href='evenement.html?id=" + response['ID'] + "' class='result'><span class='title'>" + response["Titel"] + "</span><span class='description'>" + response["Omschrijving"] + "</span><span class='location'>" + response["Locatie"] + "</span></a>";  
                    } else {
                        results.innerHTML += "<a href='restaurant.html?id=" + response['ID'] + "' class='result'><span class='title'>" + response["Titel"] + "</span><span class='description'>" + response["Omschrijving"] + "</span><span class='location'>" + response["Locatie"] + "</span></a>";  
                    }
                });
                if(results.innerHTML == "") {
                    results.innerHTML = 'Er zijn geen resultaten gevonden.'
                }
            });
        });
        </script>
	</head>
	<body>
        <div id="wrap">
            <header>
                <div class="center">
                    <a href="index.html"><img src='logo.jpg' alt='logo'><br>
                </div>
                <nav>
                    <ul class="center">
                        <li id='item1'><a href="index.html">Home</a></li>
                        <li id='item2'><a href="evenementen.html">Evenementen</a></li>
                        <li id='item3'><a href="restaurants.html">Restaurants</a></li>
                        <li id='item4'><a href="overons.html">Over ons</a></li>
						<li id='item5'><form action='search.html'><input type='search' placeholder='Search' name='q'></form></li>
						<li id='item6'><a href="inloggen.php" id="login">Login</a></li>
                    </ul>
                </nav>
            </header>
            <section id="content">
				<h2>Zoekresultaten voor "<span id="query"></span>"</h2>
                <div id="results"></div>
            </section>
            <div id="pusher"></div>
        </div>
        <footer>
            <p class="left">&copy; 2014</p>
            <p class="right"><a href="overons.html" rel="nofollow">Over ons</a> - <a href="mailto:johndoe@example.com" rel="nofollow">Contact</a></p>             
        </footer>
	</body>
</html>