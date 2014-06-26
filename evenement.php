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
		<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
		<script>
		function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}
var id = getURLParameter('id');
		function getRandomRestaurants(cb){
    var output = [];
    getAllRestaurants(function(data){
        var i = 0;
        while(output.length<6){
            console.log("length:"+output.length);
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
function getEvent(id, cb){
    $.getJSON("http://iwab.helenparkhurst.net/Reactie/ophalenevent.php?Term="+id).done(function(data){
        cb(data);
    })
}
function getRestaurant(id, cb){
    $.getJSON("http://iwab.helenparkhurst.net/Reactie/ophalenrestaurant.php?Term="+id).done(function(data){
        cb(data);
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

function getFotoLink(id, soort, cb){
    $.get("http://iwab.helenparkhurst.net/Zoek/foto.php?soort="+soort+"&id="+id ).done(function(data){
        cb(data);
    })
}

		getEvent(id, function(data){
            var title = data[1].titel;
            var text  = data[2].omschrijving;
            var location = data[3].locatie
            var vantot = data[6].start_tijd + " " + data[4].van_datum + " tot " + data[7].eind_tijd + " " + data[5].tot_datum;
            var imglocation = "http://iwab.helenparkhurst.net/Foto/fotos/"+title.replace(/ /g, "_").toLowerCase()+".png"

            $("#id").attr("value", id);
            //set Title
            $("#title").text(title);
            //set Text
            $("#text").text(text);
            //set openingstijden
            $("#vantot").text(vantot)
            $('#img').attr("src", imglocation)

            var src = "https://www.google.com/maps/embed/v1/place?key=AIzaSyAJ8pIED6AmovXhjV8_JKMTQOwVvrAqhhQ&q=" + location;
            $("#map").attr("src", src);

        });</script>
	<script type="text/javascript">
	function RangeChange(){
	var value = document.getElementById("vote").value;
	document.getElementById("range").value=value;
	}
	</script>
	</head>
	<body>
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
						<li id='item6'><a href="inloggen.php" id="login">Login</a></li>
                    </ul>
                </nav>
            </header>
            <section id="content">
        <h1 id="title"></h1>
        <img id="img">
        <p id="text"></p>
        <p id="vantot"></p>


        <iframe
                id="map"
                width="600"
                height="450"
                frameborder="0" style="border:0"
                >
        </iframe>
        <form action="Reactie/reactie.php?current=<?php echo $_GET['id']; ?>" method="post" id="reactie">
			<input value="2" type="hidden" name="id" id="id"></input> <!-- id van het event/restaurant -->
			<input value="event" type="hidden" name="type" id="type"></input> <!-- event of restaurant -->
			<input id="vote" name="vote" type="range" onchange="RangeChange()" step="0.1" min="1" max="10" value="6" required></input><input readonly value="6" style="border:none;" id="range" type="input"></input><br>
			<textarea form="reactie" type="text" id="reactie" name="reactie" style="height:200px;width:200px;" required></textarea><br>
			<input type="submit" value="Reageer!"></input>
		</form>
    </section>
            <div id="pusher"></div>
        </div>
        <footer>
            <p class="left">&copy; 2014</p>
            <p class="right"><a href="overons.php" rel="nofollow">Over ons</a> - <a href="mailto:johndoe@example.com" rel="nofollow">Contact</a></p>             
        </footer>
	</body>
</html>