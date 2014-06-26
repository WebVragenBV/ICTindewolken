<?php
include'security/SuperJSJHash.php';
if(isset($_POST['wachtwoord'], $_POST['newwachtwoord'], $_POST['naam']))
{
  $naam = $_POST['naam'];
  $newwachtwoord = $_POST['newwachtwoord'];  
  $wachtwoord = $_POST['wachtwoord'];
  $wachtwoord = filter_var($wachtwoord, FILTER_SANITIZE_STRING);
  $newwachtwoord = filter_var($newwachtwoord, FILTER_SANITIZE_STRING);
  $naam = filter_var($naam, FILTER_SANITIZE_STRING);
  if (!ini_get('magic_quotes_gpc'))
  {
    $newwachtwoord = addslashes($newwachtwoord);
    $wachtwoord = addslashes($wachtwoord);
    $naam = addslashes($naam);
  }
  if (empty($naam) or empty($wachtwoord) or empty($newwachtwoord))
  {
    echo 'invalid!';
  }
  else
  {
  $wachtwoord = SuperJSJHash($wachtwoord);
  $newwachtwoord = SuperJSJHash($newwachtwoord);
  $query=dbConnect()->prepare("SELECT * FROM user WHERE naam=:naam AND wachtwoord=:wachtwoord");
  $query->bindParam(':naam', $naam);
  $query->bindParam(':wachtwoord', $wachtwoord);
  $query->execute();
  if ( $query->rowCount() == 0 ) 
  {
    echo 'Password or username incorrect';
  }
  else
  {
    $query = dbConnect()->prepare("UPDATE user SET wachtwoord=:newwachtwoord WHERE naam=:naam AND wachtwoord=:wachtwoord"); 
    $query->bindParam(':newwachtwoord', $newwachtwoord);
    $query->bindParam(':naam', $naam);
    $query->bindParam(':wachtwoord', $wachtwoord);
    if ($query->execute())
    {
      echo 'Password updated for user: ';
      echo $naam;
    }
    else
    {
      echo 'ERROR';
    }
  }
}
}
?>