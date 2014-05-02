<?php
include "sessionInit.php";
require_once "dataRef.php";
if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
if (isUsernameExist($_POST['login']) == false)
  header('location : Accueil.php');
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css" />

<meta charset="UTF-8">
  <title>[Why] - <?php $_POST['login'] ?></title>
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
    $login = $_POST['login'];
    $id = getUserID($login);
    echo "Profil de l'utilisateur ".$login." : <br>"
    ."Nombre d'abonnes : ".getSubscriberList($id)."<br>"
    ."Nombre d'abonnements :".getSubscriptionList($id)."<br>"
    ."<form id=\"\" method=\"POST\" action=\"message.php\"><button type=\"submit\" value=\"".$login
    ."\" name=\"mailReceiver\">Envoyer un message</button></form><br>";
?>
</div>

<div id="sidebarr">
<?php      $post = showPostByUser($id);
	for ($i = 0; isset($post[0][$i]); $i++)
	  {
	    echo "Post du ".$post[4][$i]."<br>";
	    // echo "Catergorie ".getCategory($post[3][$i])."<br>";
	    echo "Contenu : ".$post[1][$i];
	    echo "Tags : ".$post[5][$i]."<br>";
	  }
?>
</div>

<div id="footer">


</div>

</body>
</html>
