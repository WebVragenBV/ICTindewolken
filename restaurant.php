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
		function getRandomRestaurants(cb){
    var output = [];
    console.log("1");
    getAllRestaurants(function(data){
        var i = 0;
        while(output.length<6 && i<20){
 
            var random = Math.floor(data.length*Math.random());
            var b = true;
            for(f in output){
 
                var o = "";
                try{o = JSON.stringify(output[f]);}catch(e){}
                console.log(data[random]);
                console.log(o);
                console.log(JSON.stringify(data[random]) === o);
                if(JSON.stringify(data[random]) === o){
                    b = false;
                }
            }
            if(b){
 
                output.push(data[random]);
 
            }
            b = true;
            console.log(output)
        }
        cb(output);
        i++
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
 
function getFotoLink(id, soort, cb){
    $.get("http://iwab.helenparkhurst.net/Zoek/foto.php?soort="+soort+"&id="+id ).done(function(data){
        cb(data);
    })
}
 
function getFirstEvents(cb){
    getAllEvents(function(data){
        cb(data.slice(0,6))
    })
}
 
function login(un, ww, cb){
    $.ajax({
        async: false,
        cache: false,
        type: 'post',
        dataType: 'json',
        data: ({
            'username': un,
            'password': ww
        }),
        url: '/Login/Authorize.php',
        success: function (data) {
            // retrieve a success/failure code from the server
            if (data === '1') {  // server returns a "1" for success
                cb()
                // success!
                // do whatever you need to do
            } else {
                alert("wrong login credentials");
                // fail!
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            // something went wrong with the request
            alert("something went wrong..");
        }
    });
 
 
}
function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}
var id = getURLParameter('id');
		getRestaurant(id, function(data){
		
    var title = data[0][0].titel;
    var text  = data[0][1].omschrijving;
    var location = data[0][2].locatie
    var category = data[0][3].soort
    var times = {ma: {}, di: {}, wo: {}, do: {}, vr: {}, za: {}, zo: {}};
    for(var i = 1; i<8; i++){
        times[data[i][0].dag].open = data[i][1].van;
        times[data[i][0].dag].closed = data[i][2].tot;
    }
    //set Title
    $("#title").text(title);
	//set Img
	getFotoLink(1,1);
	function getFotoLink(soort,id){
		$.get("http://iwab.helenparkhurst.net/Zoek/foto.php?soort="+soort+"&id="+id ).done(function(data){
			document.getElementById('img').src = 'http://iwab.helenparkhurst.net/Foto/fotos/'+data;
		})
	}
                $("#id").attr("value", id);
    //set Text
    $("#text").text(text);
    //set openingstijden
   for(t in times){
       $("#"+t).text(times[t].open + "-" + times[t].closed)
   }
 
    var src = "https://www.google.com/maps/embed/v1/place?key=AIzaSyAJ8pIED6AmovXhjV8_JKMTQOwVvrAqhhQ&q=" + location;
    $("#map").attr("src", src);
 
});
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
                <img id="img" style='width:250px;'>
                <p id="text"></p>
                <div>
                    Openingstijden: <br>
                    <table>
                        <tr>
                            <td>Dag</td>
                            <td>Openingstijd</td>
                        </tr>
                        <tr>
                            <td>Ma</td>
                            <td id="ma"></td>
                        </tr>
                        <tr>
                            <td>Di</td>
                            <td id="di"></td>
                        </tr>
                        <tr>
                            <td>Wo</td>
                            <td id="wo"></td>
                        </tr>
                        <tr>
                            <td>Do</td>
                            <td id="do"></td>
                        </tr>
                        <tr>
                            <td>Vr</td>
                            <td id="vr"></td>
                        </tr>
                        <tr>
                            <td>Za</td>
                            <td id="za"></td>
                        </tr>
                        <tr>
                            <td>Zo</td>
                            <td id="zo"></td>
                        </tr>
                    </table>
                </div>

                <iframe
                        id="map"
                        width="600"
                        height="450"
                        frameborder="0" style="border:0"
                        >
                </iframe>
        		<form action="Reactie/reactie.php?current=<?php echo $_GET['id']; ?>" method="post" id="reactie">
			<input value="2" type="hidden" name="id" id="id"></input> <!-- id van het event/restaurant -->
			<input value="restaurant" type="hidden" name="type" id="type"></input> <!-- event of restaurant -->
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