<?php
	include '../connect.php';
	$db = dbConnect();
	$allowedExts = array("gif", "jpeg", "jpg", "png","x-png","pjpeg");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	$url=$_POST['url'];
	$name=$_FILES["file"]["name"];
	$space = " ";
	$balkje = "_";	
	$name = str_replace($space,$balkje,$name);
	$name = strtolower($name);
	if (($_FILES["file"]["size"] < 2000000000) && in_array($extension, $allowedExts)) {
					if ($_FILES["file"]["error"] > 0) {
					echo "Return Code: " .$_FILES['file']['error']. "<br>";
					} 			
					else {
						echo "Upload: " .$_FILES['file']['name']. "<br>";
						echo "Type: " .$_FILES['file']['type']. "<br>";
						echo "Size: " .($_FILES['file']['size'] / 1024). " kB<br>";
						echo "Temp file: " .$_FILES['file']['tmp_name']. "<br>";
						$type = $_FILES['file']['type'];
						$imagetype = str_replace("image/",".",$type);
						$imagetype = ".jpg";
						$naam = $name.$imagetype;
						move_uploaded_file($_FILES["file"]["tmp_name"], "foto/f" .$naam);
						echo "Stored in: fotos/f" .$naam;
						echo "<br> Opgeslagen";
							$sql = "INSERT INTO banner (naam,url) VALUES (:naam,:url)";
							$q = $db->prepare($sql);
							$q->execute(array(':naam'=>$naam,
											  ':url'=>$url));
 

						header("Location:aanvragen-verwerken.php");	
	  }
	} 
	else 	{
	  echo "Dit bestand voldoet niet aan de eisen";
	  echo "<br><a href='foto.php'>Terug</a>";
			}

?>