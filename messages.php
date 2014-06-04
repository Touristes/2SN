<?php
include "./Resources/sessionInit.php";
require_once "./Controllers/frontControler.php";
require_once "./Models/userProfilModel.php";

if (!isset($_SESSION['check']))
{
	echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
	echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}

?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./Views/Styles/style1.css" />
	<link rel="stylesheet" type="text/css" href="./Views/Styles/styleMessage.css" />
	<link rel="stylesheet" type="text/css" href="./Views/Styles/styleFooter.css"/>

	<meta charset="UTF-8">
	<title>[Why] - Messagerie</title>
</head>

<body>
	<div id="cadrage">
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
                        <li ><a href='accueil.php'><img src="Views/Images/logo.png" width="50px;"></a></li>
				<li class='last'><a href='accueil.php'><span>Home</span></a></li>
				<li class='active'><a href='messages.php'><span>Messages</span></a></li>
				<li><a href='profil.php'><span>Mon Profil</span></a></li>
				<li><a href='abo.php'><span>Abonnements</span></a></li>
				<li class='last'><a href='./Resources/deconnect.php'><span>Déconnexion</span></a></li>
			</ul>
		</div>
		<div id="post">
<?php //Boite de reception, boite d'envoi, nouveau message
$login = $_SESSION['login'];
$id = getUserID($login);
?>
<form id="formMenuBox" method="POST" action="messages.php" name="formMenuBox">
	<button type="submit" value ="newMessage" name="newMessage">Nouveau message</button>
	<button type="submit" value ="Boite de reception" name="receptionBox">Boîte de réception</button>
	<button type="submit" value ="Boite d'envoi" name="sendBox">Boîte d'envoi</button>
</form>
<?php //contenu de la page
include "./Controllers/messageControler.php";
?>
</div>
<div id="footer">
	<a href='contactForm.php'><span id="b-left">Contact</span></a>
	<a href='faq.php'><span id="b-middle">Faq</span></a>
	<a href='co.php'><span id="b-right">Inscription</span></a>
</div>
</body>
</html>
