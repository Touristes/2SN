<?php
include "sessionInit.php";
require_once "dataRef.php";
require_once "userProfilModel.php";

//Test si l'utilisateur sest connecté
if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
if (isUsernameExist($_POST['loginProfilView']) == false) {
  echo "<SCRIPT LANGUAGE=\"JavaScript\">document.location.href=\"acceuil.php\"</SCRIPT>";
}
$login = $_POST['loginProfilView'];
if ($login == $_SESSION['login']) {
  echo "<SCRIPT LANGUAGE=\"JavaScript\">document.location.href=\"profil.php\"</SCRIPT>";
}
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css" />

<meta charset="UTF-8">
  <title>[Why] - <?php echo $login ?></title>
</head>

<body>
<script>
$('#cssmenu').prepend('<div id="menu-button">Menu</div>');
	$('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
	</script>
    
<?php //Menu ?>
<div id='cssmenu'>
<ul>
   <li class='last'><a href='accueil.php'><span>Home</span></a></li>
   <li><a href='messages.php'><span>Messages</span></a></li>    
   <li class='last'><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
</ul>
</div>




<div id="sidebarl">
<?php
	//Traitement formulaire abonnement
	//Abonnement
	  if (isset($_POST['Subscribe'])) {
	addSubscription(getUserID($_SESSION['login']), getUserID($login));
	}
	//Désabonnement
	  else if (isset($_POST['Unsubscribe'])) {
	delSubscription(getUserID($_SESSION['login']), getUserID($login));
	}
    //Informations utilisateur
    $id = getUserID($login);
    echo "Profil de l'utilisateur ".$login."<br>"
    ."Nombre d'abonnes : ".getSubscriberNumber($id)."<br>"
    ."Nombre d'abonnements : ".getSubscriptionNumber($id)."<br>";
	//Formulaire d'envoi de message, renvoie vers message.php
    echo "<form id=\"formNewMessage\" method=\"POST\" action=\"messages.php\"><button type=\"submit\" value=\""
    .$login."\" name=\"newMessage\">Envoyer un message</button></form>";
	//Bouton abonnement ou désabonnement
	if (isSubrscriberOf(getUserID($_SESSION['login']), getUserID($login)) == "false") {
		echo "<form id=\"formSubscribe\" method=\"POST\" action=\"profilView.php\">"
			."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
			."<button type=\"submit\" value=\"Subscribe\" name=\"Subscribe\">S'abonner</button></form>";
			}
	else {
		echo "<form id=\"formUnsubscribe\" method=\"POST\" action=\"profilView.php\">"
			."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
			."<button type=\"submit\" value=\"Unsubscribe\" name=\"Unsubscribe\">Se désabonner</button></form>";
			}
?>
</div>
<div id="sidebarr">
      <?php
      //Affichage des Posts dans une limite de 5
      //(id_post integer primary key autoincrement, title varchar, id_user integer, text varchar, id_category , id_type, created date
      $post = showPostByUser($id);
for ($i = 0; isset($post[0][$i]) && $i < 5; $i++)
	  {
	    echo "<b>".$post[1][$i]."</b><br>";
	    echo "Post du ".$post[6][$i]."<br>";
	    // echo "Catergorie ".getCategory($post[4][$i])."<br>";
	    echo "Contenu : <br>".$post[3][$i]."<br><br>";
	    //echo "Tags : ".$post[5][$i]."<br>";
	  }
	  ?>
</div>

<div id="footer">


</div>

</body>
</html>
