<?php
include "sessionInit.php";
require_once "dataUser.php";
require_once "dataConnect.php";
require_once "dataSubscriber.php";

if(isset($_SESSION['login']))
  {
    $login = $_SESSION['login'];
    $id = getUserID($login);
    if (isset($_POST['login'])) {
      if (setUserField($id,"login",$_POST['login']) == false)
	echo "Error on field login";
	}
    if (isset($_POST['email'])) {
      if (setUserField($id,"email",$_POST['email']) == false)
        echo "Error on field email";
    }
    if (isset($_POST['name'])) {
      if (setUserField($id,"name",$_POST['name']) == false)
        echo "Error on field name";
    }
    if (isset($_POST['firstname'])) {
      if (setUserField($id,"firstname",$_POST['firstname']) == false)
        echo "Error on field firstname";
    }
    if (isset($_POST['postalcode'])) {
      if (setUserField($id,"postalcode",$_POST['postalcode']) == false)
        echo "Error on field postalcode";
    }
    if (isset($_POST['deluser']) || isset($_POST['changepasswd'])) {
      if (isset($_POST['deluser'])) {
	if (isset($_POST['passwd'])) {
	  if (userConnect($id,$login) == true) {
	    delUser($id);
	    echo "Votre utilisateur a ete supprime.";
	    include "sessionDestroy.php";
	    exit;
	  }
	  else
	    echo "Erreur de mot de passe.";
	  }
	else {
	echo "Si vous souhaitez vraiment effacer votre utilisateur, merci de rettapper votre mot de passe :";
	echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=deluser /><input type=password name=passwd />";
        echo "<input type=submit value=\"Valider\"></form>";}
      }
      if (isset($_POST['changepasswd'])) {
        if (isset($_POST['passwd']) || isset($_POST['newpasswd'])) {
          if (userConnect($id,$login) == true) {
            setUserField($id,"password",md5($_POST['newpasswd']));
            echo "Votre mot de passe a ete change.";
            exit;
          }
          else
            echo "Erreur de mot de passe.";
	}
        else {
	  echo "Si vous souhaitez modifier votre mot de mot, merci de le taper une nouvelle fois :";
	  echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=changepasswd /><input type=password name=passwd />";
	  echo "<br>Veuillez taper votre nouveau mot de passe : ";
	  echo "<input type=password name=newpasswd />";
	  echo "<br><input type=submit value=\"Valider\"></form>";}
      }
    }
    else {
    echo "Voici le compte-rendu de vos informations personnelles : ";
    echo "<form method=\"POST\" action=\"profil.php\"><ul><li>User name : <input type=text name=login  value=\"".$login."\" /></li>";
    echo "<li>E-Mail : <input type=text name=email  value=\"".getUserInfo("email",$id)."\" /></li>";
    echo "<li>Nombre d'abonnes : ".getSubscriberNumber($id)."</li>";
    echo "<li>Name : <input type=text name=name  value=\"".getUserInfo("name",$id)."\" /></li>";
    echo "<li>First name : <input type=text name=firstname  value=\"".getUserInfo("firstname",$id)."\" /></li>";
    echo "<li>Postal code : <input type=text name=postalcode value=\"".getUserInfo("postalcode",$id)."\" /></li>";
    echo "<li><input type=submit value=\"Modifiez vos infos personnelles\"/></li>";
    echo "</ul></form>";
    echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=changepasswd /><input type=submit value =\"Changer le mot de passe\" /></form>";
    echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=deluser /><input type=submit value =\"Effacer le compte\" /></form>";}
  }
else
  header('Location: index.php');
?>
