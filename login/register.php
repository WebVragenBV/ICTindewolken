<?php
if(isset($_POST['naam'], $_POST['wachtwoord'], $_POST['email']))
{
  $naam = $_POST['naam'];
  $email = $_POST['email'];
  $wachtwoord = $_POST['wachtwoord'];
  $wachtwoord = filter_var($wachtwoord, FILTER_SANITIZE_STRING);
  $naam = filter_var($naam, FILTER_SANITIZE_STRING);
  $email = filter_var($naam, FILTER_SANITIZE_EMAIL);
  $blok = 0;
  $geactiveerd = 0;
  $type_account = 1;
  if (!ini_get('magic_quotes_gpc'))
  {
  $naam = addslashes($naam);
  $email = addslashes($email);
  $wachtwoord = addslashes($wachtwoord);
  }
  $wachtwoord = SuperJSJHash($wachtwoord);
  if (empty($naam) or empty($wachtwoord) or empty($email))
  {
    echo 'invalid!';
  }
  else
  {
    require'/connect.php';
    $query=dbConnect()->prepare("SELECT * FROM user WHERE (naam=:naam)");
    $query->bindParam(':naam', $naam);
    $query->execute();
    if ( $query->rowCount() > 0 ) 
    {
      echo 'Username already taken';
    }
    else
    {
      $query=dbConnect()->prepare("SELECT * FROM user WHERE (email=:email)");
      $query->bindParam(':email', $email);
      $query->execute();
      if ( $query->rowCount() > 0 ) 
      {
        echo 'email already used';
      }
      else
      {      
        $code_ac = openssl_random_pseudo_bytes(42);
        $activerings_code = bin2hex($code_ac);
        $query=dbConnect()->prepare("INSERT INTO user (naam, wachtwoord, email, activerings_code, blok, geactiveerd, type_account) VALUES (:naam, :wachtwoord, :email, :activerings_code, :blok, :geactiveerd, :type_account)");
        $query->bindParam(':naam', $naam);
        $query->bindParam(':wachtwoord', $wachtwoord);
        $query->bindParam(':email', $email);
        $query->bindParam(':activerings_code', $activerings_code);
        $query->bindParam(':blok', $blok);
        $query->bindParam(':geactiveerd', $geactiveerd);
        $query->bindParam(':type_account', $type_account);
        if($query->execute())
        {
          $to= $email;
          $address = "www.iwab.helenparkhurst.net/login/verify.php?code=" . "$activerings_code" . "&username=" . "$naam";
          $link = str_replace(' ', '%20', $address);
          $query = dbConnect()->prepare("UPDATE user SET url_activering=:url_activering WHERE naam=:naam AND email=:email");
          $query->bindParam(':naam', $naam);
          $query->bindParam(':email', $email);
          $query->bindParam(':url_activering', $link);
          if ($query->execute())
          {
            echo 'An email has been sent to your account, please use this link to activate your account.';
            mail($to,"Email verification", "please click this link to verify your account: " . "$link");
          }
          else
          {
            echo 'error'; 
          }
        } 
        else
        {
          echo 'Sorry, an error has occured. please try again later.';
        }
      }
    }
  }
}
?>