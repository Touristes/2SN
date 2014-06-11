<?php
require_once('dataConnect.php');

// function createRepo($name, $id_groups, $id_user){
//   $db = dbConnect();
//   if ($db == FALSE)
//     return (0);
//   $query = "INSERT INTO repository (name, id_groups, created, id_user) VALUES (\"".$name."\",\"".$id_groups."\","."datetime(\"now\")".",\"".$id_user."\");";
//   $result = $db->query($query);
//   if ($result == FALSE)
//     {
//       dbClose($db);
//       return (FALSE);
//     }
//   }
// }

function getRepoID($name){
  
	$db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_repository from repository where name like \"".$name."\";";
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

function ListRepo($iduser){
	$db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select name from repository where id_user like \"".$iduser."\";";
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

?>