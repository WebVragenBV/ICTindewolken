<?php
//Functie banners aanvragen
include '../connect.php';
$db = dbConnect();
$id = $_GET['id'];
$sql = "SELECT * FROM banner WHERE id=$id";
foreach($db->query($sql) as $row){
 $url=$row['url'];
 $foto=$row['naam'];
 echo "<a href='$url'><img src='foto/f$foto' width='600px' height='600px'></a>";
}
?>