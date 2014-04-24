
<?php
require_once "dataConnect.php";

function addMessage($content, $id_user, $id_receiver) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  $query = "INSERT INTO message (message, id_user, id_receiver, created) values (\"".$content."\",\"".$id_user."\",\"".$id_receiver."\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
function delMessage($id_message) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "delete from message where id_message = \"".$id_message."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
function getMessageContent($id) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select message from message where id_message = \"".$id_message."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
		$content = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($content);
}
function getMessageReceptionList($id_user){
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_message from message where id_receiver = \"".$id_user."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
    {
        $array[$i] = $row[0];
    }
  dbClose($db);
  return ($array);
}
function getMessageReceptionListByDate($id_user, $date) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_message from message where id_receiver = \"".$id_user."\" and created like \"".$date."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
    {
        $array[$i] = $row[0];
    }
  dbClose($db);
  return ($array);
}
function getMessageSendList($id_user) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_message from message where id_user = \"".$id_user."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
    {
        $array[$i] = $row[0];
    }
  dbClose($db);
  return ($array);
}
function getMessageSendListByDate($id_user, $date) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_message from message where id_user = \"".$id_user."\" and created like \"".$date."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
    {
        $array[$i] = $row[0];
    }
  dbClose($db);
  return ($array);
}
?>
