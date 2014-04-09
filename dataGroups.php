<?php
require_once "dataConnect.php";
require_once "dataUser.php";

function addUserToGroup($id_user,$group_name) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  $query = "INSERT INTO groups (name, id_user, created) values (\"".$group_name."\",\"".$id_user."\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
//isGroupExist($group_name);
//listUsersGroupsToArray($id_user);
//listUsersGroupsDisplay($id_user);
//isUserInGroup($id_user,$group_name);
?>
