<?php
	include '../connect.php';
	$db = dbConnect();
	$id = 1;
	$sql = "SELECT naam FROM restaurant WHERE ID = '$id'";
	foreach($db->query($sql) as $result){
	}
	$name = $result[0];
	$space = " ";
	$balkje = "_";	
	$name = str_replace($space,$balkje,$name);
	$name = strtolower($name);
	$allowedExts = array("gif", "jpeg", "jpg", "png","x-png","pjpeg");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if (	($_FILES["file"]["size"] < 2000000000)
			&& in_array($extension, $allowedExts)) {
					if ($_FILES["file"]["error"] > 0) {
					echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
					} 			
					else {

						echo "Upload: " . $_FILES["file"]["name"] . "<br>";
						echo "Type: " . $_FILES["file"]["type"] . "<br>";
						echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
						echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

						//check for filetype
						switch ($_FILES['file']['type']) {
							case 'image/gif':
								$image = @imagecreatefromgif($_FILES['file']['tmp_name']);
								break;

							case 'image/jpeg':
								$image = @imagecreatefromjpeg($_FILES['file']['tmp_name']);
								break;

							case 'image/jpg':
								$image = @imagecreatefromjpeg($_FILES['file']['tmp_name']);
								break;

							case 'image/png':
								$image = @imagecreatefrompng($_FILES['file']['tmp_name']);
								break;

							case 'image/x-png':
								$image = @imagecreatefrompng($_FILES['file']['tmp_name']);
								break;

							case 'image/pjpeg':
								$image = @imagecreatefromjpeg($_FILES['file']['tmp_name']);
								break;
						}

						if(!$image) {
						}
						else {
							$naam = explode(".", $_FILES['file']['name']);
							array_pop($naam);
							$naam1 = implode(".", $naam);
							imagepng($image , "fotos/".$name.".png");
						}

						// $type = $_FILES["file"]["type"];
						// $imagetype = str_replace("image/",".",$type);
						// $imagetype = ".jpg";
						// 	if (file_exists("fotos/" . $name . ".jpg")) {
						// 		$file = "fotos/" . $name . ".jpg";
						// 		unlink($file);
						// 		move_uploaded_file($_FILES["file"]["tmp_name"],
						// 		"fotos/" . $name . $imagetype);
						// 		echo "Stored in: " . "fotos/" . $name . $imagetype;
						// 		echo "<br> Vervangen en opgeslagen";
						// }			 		
						// 	else {
						// 		move_uploaded_file($_FILES["file"]["tmp_name"],
						// 		"fotos/" . $name . $imagetype);
						// 		echo "Stored in: " . "fotos/" . $name . $imagetype ;
						// 		echo "<br> Opgeslagen";
						// }
						//header("Location:foto.html");	
	  }
	} 
	else 	{
	  echo "Dit bestand voldoet niet aan de eisen";
	  echo "<br><a href='foto.html'>Terug</a>";
			}

?>



