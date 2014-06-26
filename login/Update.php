<h1>Register</h1>
<form method="POST">
    <input type="password" name="wachtwoord" placeholder="Current password" required><br />
    <input type="text" name="naam" placeholder="new username" required><br />
    <input type="password" name="newwachtwoord" placeholder="new password" required><br />
    <input type="text" name="newemail" placeholder="new email" required><br />
    <input type="submit">
</form>

<?php
include'../security/session.inc.php';
if(isset($_POST['wachtwoord']))
{
  $newnaam = $_POST['newnaam'];
  $newwachtwoord = $_POST['newwachtwoord'];
  $wachtwoord = $_POST['wachtwoord'];
  $geactiveerd = 1;
  if (!ini_get('magic_quotes_gpc'))
  {
    $newnaam = addslashes($newnaam);
    $newwachtwoord = addslashes($newwachtwoord);
    $wachtwoord = addslashes($wachtwoord)
  }
  $wachtwoord = hash('sha512', $wachtwoord);
  $newwachtwoord = hash
  require'../connect.php';



}
?>