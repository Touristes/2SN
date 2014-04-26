<?php
require_once "mail.php";
require_once "dataUser.php";

if (isset($_POST['reinitPassword'])) {
    if ($_POST['mail'] == "") {
      echo "<b>Veuillez renseigner une adresse mail.</b>";
    }
    else if (isEmailExist($_POST['mail']) == false) {
      echo "<b>Veuillez renseigner une adresse mail valide.</b>";
      }
    else if (isEmailExist($_POST['mail']) == true) {
      $id = getUserIDWithMail($_POST['mail']);
      renewPassword($id);
      header('Refresh: 10; url=index.php');
    }
}
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta charset="UTF-8">
  <title>2SN Reinitialisation de mot de passe</title>
</head>
<body>
<div id="resetmdp">
  Si vous avez perdu votre mot de passe, veuillez entrer votre adresse si dessous.
  Un nouveau mot de passe sera envoye a votre adresse mail.<br />
<form id="signup" name="reinitPassword" method="POST" action="reinitPassword.php">
<input type="email" placeholder="john.doe@email.com" name="mail" required>
  <button type="submit" value="Reinitialiser le mot de passe" name="reinitPassword">Reinitialiser mon mot de passe</button>
</form>
<br><a href="index.php">Retour vers la page de connexion.</a>
</div>
</body>
</html>
