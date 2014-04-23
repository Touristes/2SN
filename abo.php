<?php
include "sessionInit.php";

if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}

?>
<?php
include "sessionInit.php";
require_once "dataUser.php";
require_once "dataConnect.php";
require_once "dataSubscriber.php";
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css" />

<meta charset="UTF-8">
<title>2SN - Abo</title>
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
   <li class='active'><a href='accueil.php'><span>Home</span></a></li>
   <li class='last'><a href='#'><span>Messages</span></a></li>    
   <li><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Deconnexion</span></a></li>
</ul>
</div>




<div id="sidebarl">
test
</div>

<div id="sidebarr">
test


</div>

<div id="footer">


</div>
    
</body>
</html>
