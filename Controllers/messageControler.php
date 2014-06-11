<?php //contenu de la page
//Nouveau message
if (isset($_POST['newMessage'])) {
  echo "<form id=\"fromNewMessage\" method=\"POST\" action=\"messages.php\" name=\"formNewMessage\">";
  if ($_POST['newMessage'] != "newMessage") {
    echo "<input id=\"receiver\" type=text name=messageReceiverLogin value=\"".$_POST['newMessage']."\" required />";
  }
  else
    echo "<input id=\"receiver\"type=text placeholder=\"login du destinataire\" name=messageReceiverLogin  required />";
  echo "<br><textarea id=\"content\"placeholder=\"Contenu de ton message\" name=messageContent cols=\"40\" rows=\"5\" required></textarea>"
    . "<br><button type=\"submit\" value =\"newMessageSend\" name=\"newMessageSend\">Envoyer</button>"
    . "</form>";
}
//Boite de reception
else if (isset($_POST['receptionBox'])) {
  $messageList = getMessageReceptionList($id);
  if ($messageList[0] == "")
    echo "<br>Ta boîte de réception est vide !";
  echo "<ul id=\"messageList\">";
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
    echo "<br>Ta boîte d'envoi est vide !";
  echo "<ul id=\"messageList\">";
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
      echo "<br> Ton message a bien été envoyé.";
    }
  }
//Contenu du message
else if (isset($_POST['Message']))
  {
    $id_message = $_POST['Message'];
    $id_sender = getMessageSender($id_message);
    $id_receiver = getMessageReceiver($id_message);
    echo "<form id=\"formMessage\" method=\"POST\" action=\"messages.php\" name=\"formMessage\">";
    echo "<button id=\"delMessage\" type=\"submit\" value =\"".$id_message."\" name=\"delMessage\">"
      ."</button>";
    if ($id == $id_sender)
      echo "<button id=\"response\" type=\"submit\" value =\"".getUserInfo("login",$id_receiver)."\" name=\"newMessage\">Relancer</button>";
    else if ($id == $id_receiver)
      echo "<button id=\"response\" type=\"submit\" value =\"".getUserInfo("login",$id_sender)."\" name=\"newMessage\">Répondre</button>";
    echo "</form>";
    echo "<div id=\"messageContent\">";
    if ($id == $id_sender)
      echo "<br><small>Message envoyé à ".profilLinkForm(getUserInfo("login", $id_receiver))."</small>";
    else if ($id == $id_receiver)
      echo "<br><small>Message reçu par ".profilLinkForm(getUserInfo("login", $id_receiver))."</small>";
    echo "<br><div id=\"messageText\">" . getMessageContent($id_message) ."</div>";
    echo "<small>Reçu le : ".getMessageDate($id_message)."</small>";
    echo "</div>";
  }
//Effacement du message
else if (isset($_POST['delMessage']))
  {
    $id_message = $_POST['delMessage'];
    if (delMessage($id_message))
      echo "<br>Ton message a bien été effacé !";
    else
      echo "<br>Le message que tu tentes d'effacer n'existe pas.";
  }
//Affichage de la boite de reception par défaut
else {
  $messageList = getMessageReceptionList($id);
  if ($messageList[0] == "")
    echo "<br>Ta boîte de réception est vide !";
  echo "<ul id=\"messageList\">";
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