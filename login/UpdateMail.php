<?php
include'connect.php';
if(isset($_POST['wachtwoord'], $_POST['newemail'], $_POST['naam']))
{
  $naam = $_POST['naam'];
  $newemail = $_POST['newemail'];  
  $wachtwoord = $_POST['wachtwoord'];
  $wachtwoord = filter_var($wachtwoord, FILTER_SANITIZE_STRING);
  $naam = filter_var($naam, FILTER_SANITIZE_STRING);
  $newemail = filter_var($newemail, FILTER_SANITIZE_EMAIL);
  $geactiveerd = 1;
  if (!ini_get('magic_quotes_gpc'))
  {
    $newemail = addslashes($newemail);
    $wachtwoord = addslashes($wachtwoord);
    $naam = addslashes($naam);
  }
  if (empty($naam) or empty($wachtwoord) or empty($newemail))
  {
    echo 'invalid!';
  }
  else
  {
  $wachtwoord = SuperJSJHash($wachtwoord);
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
    $query=dbConnect()->prepare("SELECT * FROM user WHERE email = :newemail");
    $query->bindParam(':newemail', $newemail);
    $query->execute();
    if ( $query->rowCount() > 0 ) 
    {
      echo 'email already used';
    }
    else
    {
    $code_ac = openssl_random_pseudo_bytes(42);
    $newactiverings_code = bin2hex($code_ac);
    $geactiveerd = 1;
    $setdeactive=0;
    $query = dbConnect()->prepare("UPDATE user SET geactiveerd=:setdeactive, email=:newemail, activerings_code=:newactiverings_code WHERE naam=:naam AND wachtwoord=:wachtwoord");
    $query->bindParam(':setdeactive', $setdeactive);  
    $query->bindParam(':newemail', $newemail);
    $query->bindParam(':newactiverings_code', $newactiverings_code);
    $query->bindParam(':naam', $naam);
    $query->bindParam(':wachtwoord', $wachtwoord);
    if ($query->execute())
    {
      $to= $newemail;
      $address = "www.iwab.helenparkhurst.net/login/verify.php?code=" . "$newactiverings_code" . "&username=" . "$naam";
      $link = str_replace(' ', '%20', $address);
      $query = dbConnect()->prepare("UPDATE user SET url_activering=:url_activering WHERE naam=:naam AND email=:newemail");
      $query->bindParam(':naam', $naam);
      $query->bindParam(':newemail', $newemail);
      $query->bindParam(':url_activering', $link);
      if ($query->execute())
      {
         echo 'An email has been sent to your account, please use this link to verify your new email address.';
         mail($to,"Email verification", "please click this link to verify your nem mail address: " . "$link");
      }
      else
      {
        echo 'ERROR';
      }
    }
  }
  }
}
}
?>