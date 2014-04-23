<?php
require_once "mail.php";

if (isset($_POST['reinitPassword'])) {
    if ($_POST['email'] == "") {
      echo "<br>Veuillez renseigner une adresse mail.<br>";
    }
    else if (isEmailExist($_POST['email']) == false) {
      echo "<br>Veuillez renseigner une adresse mail valide.<br>";
      }
    else if (isEmailExist($_POST['email']) == true) {
      $id = getUserIDWithMail($_POST['email']);
      renewPassword($id);
      exit;
    }
  }
?>
<html>
<br>Si vous avez perdu votre mot de passe, veuillez entrer votre adresse si dessous.<br />
Un mail sera envoye dans les prochaines minutes contenant votre nouveau mot de passe.<br />
<form id="reinitPassword">
  <input type="text" name="email" />
  <button type="submit" value="Reinitialiser le mot de passe" name="reinitPassword"></button>
</form>
</html>
