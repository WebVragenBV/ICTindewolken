/*
TEST
*/

<?PHP
include'../security/session.inc.php';
include '../connect.php';
$rawuser = $_GET['username'];
$naam = str_replace('%20', ' ', $rawuser);
$activerings_code = $_GET['code'];
$geactiveerd=1;
$query = dbConnect()->prepare("UPDATE user SET geactiveerd=:geactiveerd WHERE naam=:naam AND activerings_code=:activerings_code");
$query->bindParam(':naam', $naam);
$query->bindParam(':activerings_code', $activerings_code);
$query->bindParam(':geactiveerd', $geactiveerd);
if ($query->execute())
{
  echo 'Account activated, you can now login';
}
else
{
  echo 'invalid link, please recheck your mail';
}
?>
