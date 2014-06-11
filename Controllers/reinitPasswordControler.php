<?php
require_once "./Models/mail.php";
require_once "./Controllers/frontControler.php";

//Traitement du formulaire de renouvellement de mot de passe
if (isset($_POST['reinitPassword'])) {
  if ($_POST['mail'] == "") {
    echo "<b>Merci de renseigner une adresse mail.</b>";
  }
  else if (isEmailExist($_POST['mail']) == false) {
    echo "<b>Merci de renseigner une adresse mail valide.</b>";
  }
  else if (isEmailExist($_POST['mail']) == true) {
    $id = getUserIDWithMail($_POST['mail']);
    renewPassword($id);
    //redirection a 10 sec apres envoi du mail
    header('Refresh: 10; url=index.php');
  }
}
?>