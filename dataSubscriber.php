<?php
require_once "dataConnect.php";
require_once "dataUser.php";

//addSubscriber($id_subscriber, $id_user);
//delSubscriber($id_subscriber);
//getSubscriberName($id_subscriber);

function getSubscriberNumber($id_user){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from subscriber where id_user = \"".$id_user."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  dbClose($db);
  return ($i);
}

function isSubrscriberOf($id_subscriber, $id_user) {
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from subscriber where id_subscriber = \"".$id_subscriber."\" and id_user = \"".$id_user."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	$ID = $row[$i];
    }
  dbClose($db);
  if ($i > 0)
    return ("true");
  return ("false");
}
?>
