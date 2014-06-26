<?php
$result1 = $db->prepare("SELECT COUNT(`id`) as cnt FROM `ip_adres`");
$result1->execute();
$result2 = $result1->fetch(PDO::FETCH_OBJ);
echo "<p style='color: red; font-size: 55px; font-family: Comic Sans MS; text-align: center;'>Totaal aantal unieke bezoekers: ";
echo $result2->cnt;
echo ".</p>";
?>