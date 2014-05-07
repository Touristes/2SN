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

?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style1.css" />

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
<button type="submit" value ="newMessage" name="newMessage">+</button>
<button type="submit" value ="Boite de reception" name="receptionBox">Boite de reception</button>
<button type="submit" value ="Boite d'envoi" name="sendBox">Boite d'envoi</button>
</form>
<?php //contenu de la page
//Nouveau message
if (isset($_POST['newMessage'])) {
	echo "<form id=\"fromNewMessage\" method=\"POST\" action=\"messages.php\" name=\"formNewMessage\">";
	if ($_POST['newMessage'] != "newMessage") {
		echo "<input type=text name=messageReceiverLogin value=\"".$_POST['newMessage']."\" required />";
	}
	else
		echo "<input type=text placeholder=\"login du destinataire\" name=messageReceiverLogin  required />";
	echo "<br><textarea placeholder=\"Contenu de votre message\" name=messageContent cols=\"40\" rows=\"5\" required></textarea>"
	. "<br><button type=\"submit\" value =\"newMessageSend\" name=\"newMessageSend\">Envoyer</button>"
	. "</form>";
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
	}
	else {
		 addMessage($_POST['messageContent'], $id, getUserID($_POST['messageReceiverLogin']));
		 echo "Votre message a bien été envoyé.";
	}
}
//Contenu du message
else if (isset($_POST['Message']))
{
	$id_message = $_POST['Message'];
	$id_sender = getMessageSender($id_message);
	$id_receiver = getMessageReceiver($id_message);
	echo "<form id=\"formMessage\" method=\"POST\" action=\"messages.php\" name=\"formMessage\">";
	if ($id == $id_sender)
		echo "<button type=\"submit\" value =\"".getUserInfo("login",$id_receiver)."\" name=\"newMessage\">Relancer</button>";
	else if ($id == $id_receiver)
		echo "<button type=\"submit\" value =\"".getUserInfo("login",$id_sender)."\" name=\"newMessage\">Repondre</button>";
	echo "<button type=\"submit\" value =\"".$id_message."\" name=\"delMessage\">Supprimer</button></form>";
	echo "<br>Message du : ".getMessageDate($id_message);
	echo "<br>Envoyé par : ".getUserInfo("login", $id_sender);
	echo "<br>Reçu par : ".getUserInfo("login", $id_receiver);
	echo "<br>" . getMessageContent($id_message);
}
//Effacement du message
else if (isset($_POST['delMessage']))
{
	$id_message = $_POST['delMessage'];
	if (delMessage($id_message))
		echo "Votre message a bien été effacé.";
	else
		echo "Le message que vous tentez d'effacer n'existe pas.";
}
//Affichage de la boite de reception par défaut
else {
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
?>
</div>
<div id="footer">
</div>
</body>
</html>
