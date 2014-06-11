<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>
<?php

function affPersonnalInformations($id, $login) {
   echo "<div class=\"ribbon\">
    <div class=\"theribbon\">
      Voici le compte-rendu de tes informations personnelles : </div>
      <div class=\"ribbon-background\"></div>
    </div>
    </br>Nombre d'abonnés : ".getSubscriberNumber($id).
    "<form id=\"formUserMod\" method=\"POST\" action=\"profil.php\"></br>
    Nom d'utilisateur : </br><input type=text name=login  value=\"".$login."\" <br>
    </br>E-Mail : </br><input type=text name=email  value=\"".getUserInfo("email",$id)."\" />
    </br>Nom : </br><input type=text name=name  value=\"".getUserInfo("name",$id)."\" />
    </br>Prénom : </br><input type=text name=firstname  value=\"".getUserInfo("firstname",$id)."\" />
    </br>Code postal : </br><input type=text name=postalcode value=\"".getUserInfo("postalcode",$id)."\" /><br>
    <button id=\"but1\"type=submit value=\"Modifier les infos personnelles\"/>Modifier les infos personnelles</button>
    </form>
    <form id=\"formUserMod\" method=\"POST\" action=\"profil.php\">
    <button id=\"but2\"type=submit value =\"Changer le mot de passe\" name=changepasswd>Changer le mot de passe</button></form>
    <form id=\"formUserMod\" method=\"POST\" action=\"profil.php\">
    <button id=\"but3\"type=submit value=\"Effacer le compte\" name=deluser>Effacer le compte</button></form>";
}

function affDelAccountPassword() {
       echo "Si tu souhaites vraiment supprimer ton compte, merci de re-saisir ton mot de passe :
       <form method=\"POST\" action=\"profil.php\"><input type=hidden name=deluser /><input type=password name=passwd />
       <input type=submit value=\"Valider\"></form>";
}

function affPasswordChange() {
       echo "Si tu souhaites modifier ton mot de passe, merci de le saisir une nouvelle fois :
       <form method=\"POST\" action=\"profil.php\"><input type=hidden name=changepasswd /><input type=password name=passwd />
       <br>Merci de re-saisir ton nouveau mot de passe : 
       <input type=password name=newpasswd />
       <br><input type=submit value=\"Valider\"></form>";
}
?>
</html>