<?php
include "sessionInit.php";
require_once "dataMessages.php";

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
   <li class='active'><a href='accueil.php'><span>Home</span></a></li>
   <li class='last'><a href='messages.php'><span>Messages</span></a></li>    
   <li><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Deconnexion</span></a></li>
</ul>
</div>
<div id='boiteMessagesGauche'>
<?php //Boite de reception, boite d'envoi, nouveau message 
$id = getUserID($login);
$login = $_SESSION['login'];
?>
<form id="signup" method="POST" action="message.php" name="formMenuBox">
<button type="submit" value ="Nouveau message" name="newMessage"></button>
<button type="submit" value ="Boite de reception" name="receptionBox">Boite de reception</button>
<button type="submit" value ="Boite d'envoi" name="sendBox">Boite d'envoi</button>
</form>
</div>
<div id='enteteHaut'>
<?php //Destinataire ou expéditeur => selon message reçu, envoyé ou nouveau message ?>
</div>
<div id='contenuMessages'>
<?php //affiche le contenu du message selectionné ou liste (date + expediteur ou envoi)
if (isset($_POST['formMenuBox']))
{
	if (isset($_POST['newMessage'])) {
		echo "<form id=\"signup\" method=\"POST\" action=\"message.php\" name=\"formNewMessage\">";
		echo "<input type=text placeholder=\"login du destinataire\" name=messageReceiverLogin  required />"; //Ajouter un menu déroullant
		echo "<input type=text placeholder=\"Contenu de votre message\" name=messageContent required />";
		echo "<button type=\"submit\" value =\"newMessageSend\" name=\"newMessageSend\">Envoyer</button>";
		echo "</form>";
	}
	else if (isset($_POST['receptionBox'])) {
		$messageList = getMessageReceptionList($id);
		echo "<ul>";
		for ($i = 0; isset($messageList[$i]); $i++)
		{
			echo "<li><form id=\"signup\" method=\"POST\" action=\"message.php\" name=\"formMessageID\">"
				."<button type=\"submit\" value =\"messageÏD\" name=\"".$messageList[$i]."\">"
				.getMessageDate($messageList[$i])." : ".getMessageSender($messageList[$i])."</button></li>";
		}
		echo "</ul>";
	}
	else if (isset($_POST['sendBox'])) {
		$messageList = getMessageSendList($id);
		echo "<ul>";
		for ($i = 0; isset($messageList[$i]); $i++)
		{
			echo "<li><form id=\"signup\" method=\"POST\" action=\"message.php\" name=\"formMessageID\">"
				."<button type=\"submit\" name =\"messageÏD\" value=\"".$messageList[$i]."\">"
				.getMessageDate($messageList[$i])." : ".getMessageSender($messageList[$i])."</button></li>";
		}
		echo "</ul>";
	}
}
else if (isset($_POST['formNewMessage']))
{
	if (isUsernameExist($_POST['messageReceiverLogin']) == FALSE) {
		echo "<br>Le nom d'utilisateur ".$_POST['messageReceiverLogin']." n'existe pas.<br>";
		header('Refresh: 10; url=message.php');
		}
	else
		addMessage($_POST['messageContent'], $id, getUserID($_POST['messageReceiverLogin']));
}
else if (isset($_POST['formMessageID']))
{
	$id_message = $_POST['messageID'];
	$id_sender = getMessageSender($id_message);
	$id_receiver = .getMessageReceiver($id_message);
	
	echo "<br>Message du : ".getMessageDate($id_message);
	echo "<br>Envoyé par : ".getUserInfo($id_sender);
	echo "<br>Reçu par : ".getUserInfo($id_receiver);
	
	echo "<br>" . getMessageContent($id_message);
}
?>
</div>
</body>
</html>
