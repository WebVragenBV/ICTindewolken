<h1>register</h1>
<form method="POST" action="../login/register.php">
    <input type="text" name="naam" placeholder="name" required>
    <input type="password" name="wachtwoord" placeholder="password" required><br />
    <input type="text" name="email" placeholder="email" required><br />
    <input type="submit">
</form>

<br/>

<h1>login</h1>
<form method="POST" action="../login/login.php">
    <input type="text" name="naam" placeholder="name" required>
    <input type="password" name="wachtwoord" placeholder="password" required><br />
    <input type="submit">
</form>

<br/>

<h1>update mail</h1>
<form method="POST" action="../login/UpdateMail.php">
    <input type="text" name="naam" placeholder="name" required>
    <input type="password" name="wachtwoord" placeholder="password" required><br />
    <input type="text" name="newemail" placeholder="email" required><br />
    <input type="submit">
</form>

<br/>

<h1>update password</h1>
<form method="POST" action="../login/UpdatePass.php">
    <input type="text" name="naam" placeholder="name" required>
    <input type="password" name="wachtwoord" placeholder="current password" required><br />
    <input type="password" name="newwachtwoord" placeholder="password" required><br />
    <input type="submit">
</form>



<?php
include'../security/session.inc.php';

if(isset($_SESSION['user']))
{
  echo '<p style="position:fixed;top:0px;right:0px;z-index:120000;">Welkom! je bent ingelogd als ';
  echo $_SESSION['user']['naam'];
  echo '<br/>';
  echo '<a href="logout.php">Logout</a>';
  if ($_SESSION['user']['admin']=='yes')
  {
    echo 'You are admin</p>';
  }
  else
  {
    echo 'You are NOT admin</p>';
  }
}
else
{
  if(isset($_SESSION['user']['google']))
  {
    echo 'Welkom! je bent ingelogd als ';
    echo $_SESSION['user']['google'];
    echo '<br/>';
    echo '<a class="logout" href="?logout">Uitloggen</a>';
  }
  else
  {
    echo '<a href="login.php">Login</a><br /><a href="register.php">Register</a>';
    echo '<br/>';
  }
}




require_once '../login/GoogleLogin/src/Google_Client.php';
require_once '../login/GoogleLogin/src/contrib/Google_Oauth2Service.php';
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
  $_SESSION['user']['google'] = $oauth2->userinfo->get();
  $user = $oauth2->userinfo->get();
  
} else {
  $authUrl = $client->createAuthUrl();
}


if(isset($personMarkup)): 
  print $personMarkup; //Print user Information 
endif;
 
//inloggen of uitloggen --------------------------------------------------------------
if(isset($authUrl)) {
    print "<a class='login' href='$authUrl'>Inloggen met een google account</a>";
  } else {
   print '<br><br><a class="logout" href="?logout">Uitloggen</a>';
  }
//------------------------------------------------------------------------------------

?>