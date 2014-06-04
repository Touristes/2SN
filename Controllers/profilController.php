<?php
require_once "./Views/profilView.php";

function profilController() {
  if(isset($_SESSION['login']))
  {
    $login = $_SESSION['login'];
    $id = getUserID($login);
    //Traitement du formulaire de mise a jour des donnees personnelles
    if (isset($_POST['login'])) {
      if (setUserField($id,"login",$_POST['login']) == false)
       echo "Error on field \"login\"";
     else {
      $login = $_POST['login'];
      $_SESSION['login'] = $login;
    }
  }
  if (isset($_POST['email'])) {
    if (setUserField($id,"email",$_POST['email']) == false)
      echo "Error on field \"email\"";
  }
  if (isset($_POST['name'])) {
    if (setUserField($id,"name",$_POST['name']) == false)
      echo "Error on field \"name\"";
  }
  if (isset($_POST['firstname'])) {
    if (setUserField($id,"firstname",$_POST['firstname']) == false)
      echo "Error on field \"firstname\"";
  }
  if (isset($_POST['postalcode'])) {
    if (setUserField($id,"postalcode",$_POST['postalcode']) == false)
      echo "Error on field \"postcode\"";
  }
    //Changement de mot de passe  et effacement de l utilisateur
  if (isset($_POST['deluser']) || isset($_POST['changepasswd'])) {
    	//suppression de l utilisateur avec controle du mot de passe
    if (isset($_POST['deluser'])) {
     if (isset($_POST['passwd'])) {
       if (userConnect($id,$login) == true) {
         delUser($id);
         echo "Votre compte a été supprimé avec succès !";
         include "deconnect.php";
       }
       else
         echo "Erreur de mot de passe.";
     }
     else
		affDelAccountPassword();
     }
     if (isset($_POST['changepasswd'])) {
      	//Changement du mot de passe
      if (isset($_POST['passwd']) || isset($_POST['newpasswd'])) {
        if (userConnect($id,$login) == true) {
          setUserField($id,"password",md5($_POST['newpasswd']));
          echo "Votre mot de passe a été modifié.";
        }
        else
          echo "Erreur de mot de passe.";
      }
      else
		affPasswordChange();
     }
   }
    //Affichage des info personnelles
   else {
   affPersonnalInformations($id, $login);
	}
  }
  else
    header('Location: index.php');
}
?>