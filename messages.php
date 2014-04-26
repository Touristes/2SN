<?php
include "sessionInit.php";
require_once "dataMessages.php";
require_once "dataUser.php";

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
<link rel="stylesheet" type="text/css" href="style1.css" />

<meta charset="UTF-8">
<title>2SN - Accueil</title>
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
   <li class='last'><a href='accueil.php'><span>Home</span></a></li>
   <li class='active'><a href='messages.php'><span>Messages</span></a></li>    
   <li><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Deconnexion</span></a></li>
</ul>
</div>
<div id="post">
<?php //Boite de reception, boite d'envoi, nouveau message
$login = $_SESSION['login'];
$id = getUserID($login);
?>
<form id="formMenuBox" method="POST" action="messages.php" name="formMenuBox">
<button type="submit" value ="Nouveau message" name="newMessage">+</button>
<button type="submit" value ="Boite de reception" name="receptionBox">Boite de reception</button>
<button type="submit" value ="Boite d'envoi" name="sendBox">Boite d'envoi</button>
</form>
<?php //contenu de la page
//Bouton nouveau message
if (isset($_POST['newMessage'])) {
	echo "<form id=\"signup\" method=\"POST\" action=\"messages.php\" name=\"formNewMessage\">";
	echo "<input type=text placeholder=\"login du destinataire\" name=messageReceiverLogin  required />";
	echo "<input type=text placeholder=\"Contenu de votre message\" name=messageContent required />";
	echo "<button type=\"submit\" value =\"newMessageSend\" name=\"newMessageSend\">Envoyer</button>";
	echo "</form>";
}
//Boite de reception
else if (isset($_POST['receptionBox'])) {
	$messageList = getMessageReceptionList($id);
        if ($messageList[0] == "")
        	echo "Votre boite de reception est vide";
	echo "<ul>";
	for ($i = 0; isset($messageList[$i]); $i++)
	{
		echo "<li><form id=\"formMessageID\" method=\"POST\" action=\"messages.php\" name=\"formMessageID\">"
		     ."<button type=\"submit\" name =\"Message\" value=\"".$messageList[$i]."\">"
		     .getMessageDate($messageList[$i])." : "
		     .getUserInfo("login", getMessageSender($messageList[$i]))."</button></form></li>";
	}
	echo "</ul>";
}
//Boite d'envoi
else if (isset($_POST['sendBox'])) {
	 $messageList = getMessageSendList($id);
	 if ($messageList[0] == "")
	 	echo "Votre boite d'envoi est vide";
	 echo "<ul>";
	 for ($i = 0; isset($messageList[$i]); $i++)
	 {
	 	echo "<li><form id=\"formMessageID\" method=\"POST\" action=\"messages.php\" name=\"formMessageID\">"
		  ."<button type=\"submit\" name=\"Message\" value=\"".$messageList[$i]."\">"
		     .getMessageDate($messageList[$i])." : "
		     .getUserInfo("login", getMessageReceiver($messageList[$i]))."</button></form></li>";
	 }
	 echo "</ul>";
}
//Envoi du noveau message
else if (isset($_POST['newMessageSend']))
{
	if (isUsernameExist($_POST['messageReceiverLogin']) == FALSE) {
		echo "<br>Le nom d'utilisateur ".$_POST['messageReceiverLogin']." n'existe pas.<br>";
		header('Refresh: 10; url=messages.php');
	}
	else
		addMessage($_POST['messageContent'], $id, getUserID($_POST['messageReceiverLogin']));
}
//Contenu du message
else if (isset($_POST['Message']))
{
	$id_message = $_POST['Message'];
	$id_sender = getMessageSender($id_message);
	$id_receiver = getMessageReceiver($id_message);
	echo "<br>Message du : ".getMessageDate($id_message);
	echo "<br>Envoyé par : ".getUserInfo("login", $id_sender);
	echo "<br>Reçu par : ".getUserInfo("login", $id_receiver);
	echo "<br>" . getMessageContent($id_message);
}
?>
</div>
<div id="footer">
</div>
</body>
</html>
