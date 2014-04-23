<?php
require_once "dataConnect.php";
require_once "dataGroups.php";

function SearchUser($search) {
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select login from user where login like \"".$search."\" limit 1;";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $login = $row[$i];
    }
  dbClose($db);
  if ($i == 0)
    return ("false");
  else
    return ($login);
}

function addUser($login, $email, $password) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  initDefaultUserGroups();
  $query = "INSERT INTO user (login, email, password, created, modified, last_connexion) values (\"".$login."\",\"".$email."\",\"".md5($password)."\",date('now'),date('now'),date('now'));";
  $result = $db->query($query);
  if ($result == FALSE) 
    {
      dbClose($db);
      return (FALSE);
    }
  $ID = getUserID($login);
  $ID_groups = getGroupID("user");
  $query = "INSERT INTO belong (id_groups, id_user) values (\"".$ID_groups."\",\"".$ID."\");";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
function addAdmin($login, $email, $password) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  initDefaultUserGroups();
  $query = "INSERT INTO user (login, email, password, created, modified, last_connexion) values (\"".$login."\",\"".$email."\",\"".md5($password)."\",date('now'),date('now'),date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $ID = getUserID($login);
  $ID_groups = getGroupID("admin");
  $query = "INSERT INTO belong (id_groups, id_user) values (\"".$ID_groups."\",\"".$ID."\");";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
function getUserID($login) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where login like \"".$login."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
       $ID = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($ID);
}
function getUserIDWithMail($email) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where email like \"".$email."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	$ID = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($ID);
}

function getUserInfo($field, $ID) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select \"".$field."\" from user where id_user like \"".$ID."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	$info = $row[$i];
    }
  dbClose($db);
  if ($i > 1)
    return (FALSE);
  return ($info);
}
function delUser($id) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "delete from user where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "delete from groups where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "delete from belong where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "delete from subscriber where id_user = \"".$id."\" or id_subscriber = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  dbClose($db);
  return (TRUE);
}
function isUsernameExist($login){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where login like \"".$login."\";";
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
function isEmailExist($email){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_user from user where email like \"".$email."\";";
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
function userConnect($login, $password){
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $id = getUserID($login);
  $query = "select id_user from user where id_user = \"".$id."\" and password = \"".md5($password)."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  if ($i > 0)
    {
      $query = "update user set last_connexion = date('now') where id_user = \"".$id."\";";
      $result = $db->query($query);
      dbClose($db);
      return ("true");
    }
  dbClose($db);
  return ("false");
}
function setUserField($id, $field, $newContent){
  $db = dbConnect();
  if ($db == FALSE)
    return (FALSE);
  $query = "update user set \"".$field."\"=\"".$newContent."\" where id_user = \"".$id."\";";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  $query = "update user set modified = date('now') where id_user = \"".$id."\";";
  $result = $db->query($query);
  dbClose($db);
  return (TRUE);
}
function isUserAdmin($id){
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $id_groups = getGroupID("admin");
  $query = "select id_user from belong where id_groups = \"".$id_groups."\" and id_user = \"".$id."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        $ID = $row[$i];
    }
  dbClose($db);
  if ($i > 0)
    return (true);
  return (false);
}
?>
