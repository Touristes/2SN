<?php
require_once("dataUser.php");
function generatePassword() {
  $password = substr(str_shuffle(md5(mt_rand())), 0, 8);
  return ($password);
}

function renewPassword($id) {

  $password = generatePassword();
  $mail = getUserInfo("email", $id);
  $login = getUserInfo("login", $id);
  if (isEmailExist($mail) == false) {
    echo "\nCette adresse mail n'est pas associée à un compte.\n";
    return (false);
  }
  setUserField($id, "password", md5($password));
  if (!sendPasswordMail($mail, $password, $login)) {
    echo "\nErreur technique le mail n'a pas pu être envoyé.\n";
    return (false);
  }
  //  echo "Votre nouveau mot de passe est : " . $password;
  echo "<br>Vous allez recevoir votre nouveau mot de passe par e-mail.<br>";
  return (true);
}

function sendPasswordMail($mail, $password, $login) {
  $passage_ligne = "\n";
  $sujet = "Your new password for why";

  $message_txt = "Bonjour ".$login.",".$passage_ligne;
  $message_txt .= "Un renouvellement de mot de passe a ete demande pour votre compte.".$passage_ligne;
  $message_txt .= "Voici votre nouveau mot de passe : ".$password.$passage_ligne;

  if (sendMail($mail, $message_txt, $sujet, $passage_ligne) == false)
    return (false);
  else
    return (true);
}

function configureSMTP() {
  ini_set( "SMTP", "ssl://smtp.gmail.com" );
  ini_set( "smtp_port", "465" );
  ini_set( "username", "whyproject.2sn@gmail.com");
  ini_set( "password", "whypassword");
  ini_set( "sendmail_from", "whyproject.2sn@gmail.com" );
  return (true);
}

function sendMail($mail, $message_txt, $sujet, $passage_ligne) {
  $boundary = "-----=".md5(mt_rand());
  $header = "From: \"Why project\"<noreply@whyproject.com>".$passage_ligne;
  $header .= "Reply-to: \"why project\" <whyproject.2sn@gmail.com>".$passage_ligne;
  $header .= "MIME-Version: 1.0".$passage_ligne;
  $header .= "Content-Type: multipart/alternative; boundary=\"$boundary\"".$passage_ligne;
  $header .= $passage_ligne.$passage_ligne;
  $message = $passage_ligne."--".$boundary.$passage_ligne;
  $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
  $message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;
  $message .= $passage_ligne.$message_txt.$passage_ligne;
  $message .= $passage_ligne."--".$boundary."--".$passage_ligne;

  configureSMTP();
  if (mail($mail,$sujet,$message,$header))
    return (true);
  else
    return (false);
}

//sendCreationMail($mail);
//sendDeleteMail($mail);
//sendPMNotificationMail($mail);
?>
