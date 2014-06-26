<?php
include'security/session.inc.php';
include'security/SuperJSJHash.php';
require'connect.php';
if(isset($_POST['naam'], $_POST['wachtwoord']))
{
  $wachtwoord=$_POST['wachtwoord'];
  $naam=$_POST['naam'];
  $wachtwoord = filter_var($wachtwoord, FILTER_SANITIZE_STRING);
  $naam = filter_var($naam, FILTER_SANITIZE_STRING);
  $blok=0;
  $geactiveerd=1;
  $wachtwoord = SuperJSJHash($wachtwoord);
  $query=dbConnect()->prepare("SELECT * FROM user WHERE (naam=:naam AND wachtwoord=:wachtwoord AND geactiveerd=:geactiveerd AND blok=:blok)");
  $query->bindParam(':naam', $naam);
  $query->bindParam(':wachtwoord', $wachtwoord);
  $query->bindParam(':geactiveerd', $geactiveerd);
  $query->bindParam(':blok', $blok);
  try
  {
    $query->execute();
  }
  catch(PDOException $e)
  {
    echo 'ERROR';
  }
  if ($row = $query->fetch())
  {
    $_SESSION['user']['naam'] = $row['naam'];
    $_SESSION['user']['id'] = $row['id'];
    if ($row['type_account'] == 4)
    {
      $_SESSION['user']['admin'] = 'yes';
    }
    else
    {
       $_SESSION['user']['admin'] = 'no';
    }
    header("Location:../profiel.php");
  }
  else
  {
    sleep(1);
    echo 'Account not activated, blocked or non existent';
  }
}
?>