<?php

function affPersonnalInformations($id, $login) {
   echo "<div class=\"ribbon\">
    <div class=\"theribbon\">
      Voici le compte-rendu de vos informations personnelles : </div>
      <div class=\"ribbon-background\"></div>
    </div>
    </br>Nombre d'abonnés : ".getSubscriberNumber($id).
    "<form id=\"formUserMod\" method=\"POST\" action=\"profil.php\"></br>
    User name : </br><input type=text name=login  value=\"".$login."\" <br>
    </br>E-Mail : </br><input type=text name=email  value=\"".getUserInfo("email",$id)."\" />
    </br>Name : </br><input type=text name=name  value=\"".getUserInfo("name",$id)."\" />
    </br>First name : </br><input type=text name=firstname  value=\"".getUserInfo("firstname",$id)."\" />
    </br>Postal code : </br><input type=text name=postalcode value=\"".getUserInfo("postalcode",$id)."\" /><br>
    <button id=\"but1\"type=submit value=\"Modifiez vos infos personnelles\"/>Modifiez vos infos personnelles</button>
    </form>
    <form id=\"formUserMod\" method=\"POST\" action=\"profil.php\">
    <button id=\"but2\"type=submit value =\"Changer le mot de passe\" name=changepasswd>Changer le mot de passe</button></form>
    <form id=\"formUserMod\" method=\"POST\" action=\"profil.php\">
    <button id=\"but3\"type=submit value=\"Effacer le compte\" name=deluser>Effacer le compte</button></form>";
}

function affDelAccountPassword() {
       echo "Si vous souhaitez vraiment effacer votre utilisateur, merci de re-saisir votre mot de passe :
       <form method=\"POST\" action=\"profil.php\"><input type=hidden name=deluser /><input type=password name=passwd />
       <input type=submit value=\"Valider\"></form>";
}

function affPasswordChange() {
       echo "Si vous souhaitez modifier votre mot de passe, merci de le saisir une nouvelle fois :
       <form method=\"POST\" action=\"profil.php\"><input type=hidden name=changepasswd /><input type=password name=passwd />
       <br>Veuillez saisir votre nouveau mot de passe : 
       <input type=password name=newpasswd />
       <br><input type=submit value=\"Valider\"></form>";
}
?>