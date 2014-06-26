<?php
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';
session_start();

$client = new Google_Client();
$client->setApplicationName("Inloggen en Registreren op WebVragen");

$oauth2 = new Google_Oauth2Service($client);

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  unset($_SESSION['login']);
  $client->revokeToken();
}

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $_SESSION['login'] = null;
  $_SESSION['login'] = $oauth2->userinfo->get();
  $user = $oauth2->userinfo->get();
  
} else {
  $authUrl = $client->createAuthUrl();
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
if(isset($personMarkup)): 
  print $personMarkup; //Print user Information 
endif;
 
//inloggen of uitloggen --------------------------------------------------------------
if(isset($authUrl)) {
    header('Location: http://www.iwab.helenparkhurst.net/login/page.php');
    //print "<a class='login' href='$authUrl'>Inloggen</a>";
  } else {
   print 'Ingelogd met Google';
   print '<br><br><a class="logout" href="?logout">Uitloggen</a>';
   echo $_SESSION['user']['google'];
   echo $_SESSION['login'];
  }
//------------------------------------------------------------------------------------
?>

</section>
</body>
</html>