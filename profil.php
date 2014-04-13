<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style2.css" />
<meta charset="UTF-8">
<title>Profil</title>
</head>
<?php
include "sessionInit.php";
require_once "dataUser.php";
require_once "dataConnect.php";
require_once "dataSubscriber.php";
?>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='accueil.php'><span>Home</span></a></li>
   <li class='last'><a href='#'><span>Messages</span></a></li>    
   <li><a href='profil.php'><span>Mon Profil</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Deconnexion</span></a></li>
</ul>
</div>

<div id="infoprofil">
<?php
if(isset($_SESSION['login']))
  {
    $login = $_SESSION['login'];
    $id = getUserID($login);
    if (isset($_POST['login'])) {
      if (setUserField($id,"login",$_POST['login']) == false)
	echo "Error on field login";
      else {
          $login = $_POST['login'];
          $_SESSION['login'] = $login;
      }
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
	  }
	  else
	    echo "Erreur de mot de passe.";
	  }
	else {
	echo "Si vous souhaitez vraiment effacer votre utilisateur, merci de retaper votre mot de passe :";
	echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=deluser /><input type=password name=passwd />";
        echo "<input type=submit value=\"Valider\"></form>";}
      }
      if (isset($_POST['changepasswd'])) {
        if (isset($_POST['passwd']) || isset($_POST['newpasswd'])) {
          if (userConnect($id,$login) == true) {
            setUserField($id,"password",md5($_POST['newpasswd']));
            echo "Votre mot de passe a ete change.";
          }
          else
            echo "Erreur de mot de passe.";
	}
        else {
	  echo "Si vous souhaitez modifier votre mot de passe, merci de le taper une nouvelle fois :";
	  echo "<form method=\"POST\" action=\"profil.php\"><input type=hidden name=changepasswd /><input type=password name=passwd />";
	  echo "<br>Veuillez taper votre nouveau mot de passe : ";
	  echo "<input type=password name=newpasswd />";
	  echo "<br><input type=submit value=\"Valider\"></form>";}
      }
    }
    else {
    echo "Voici le compte-rendu de vos informations personnelles : ";
	 echo "</br></br></br>Nombre d'abonnes : ".getSubscriberNumber($id);
    echo "<form id=\"signup\" method=\"POST\" action=\"profil.php\"></br>User name : </br><input type=text name=login  value=\"".$login."\" />";
    echo "</br>E-Mail : </br><input type=text name=email  value=\"".getUserInfo("email",$id)."\" />";
    echo "</br>Name : </br><input type=text name=name  value=\"".getUserInfo("name",$id)."\" />";
    echo "</br>First name : </br><input type=text name=firstname  value=\"".getUserInfo("firstname",$id)."\" />";
    echo "</br>Postal code : </br><input type=text name=postalcode value=\"".getUserInfo("postalcode",$id)."\" />";
    echo "</br><button type=submit value=\"Modifiez vos infos personnelles\"/>Modifiez vos infos personnelles</button>";
    echo "</form>";
    echo "</br></br></br></br><form id=\"signup\" method=\"POST\" action=\"profil.php\"><button type=submit value =\"Changer le mot de passe\" name=changepasswd>Changer le mot de passe</button></form>";
    echo "</br><form id=\"signup\" method=\"POST\" action=\"profil.php\">
</br>	</br></br><button type=submit value =\"Effacer le compte\" name=deluser>Effacer le compte</button></form>";}
  }
else
  header('Location: index.php');
?>

</div>
<body>
</body>
</html>
