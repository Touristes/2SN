<?php
require_once "dataConnect.php";
//La seule fonction à utiliser est getSharedRepertories($id_user)
//Elle renvoie un tableau avec la structure si dessous :
//array[0][0][0] => id_repertory 1
//array[0][0][1] => name 1
//array[0][0][2] => id_groups 1
// ...
//array[0][1][0] => id_repertory 2
//...
//array[1][0][0][0] => id_file 1 contenu dans le repertoire 1
//...
//array[1][0][1][0] => id_file 2 contenu dans le repertoire 1
//...
//array[1][1][0][0] => id_file 1 contenu dans le repertoire 2
//...


//Renvoie la liste des repertoire partagés avec un utilisateur dans un tableau
function getSharedRepertories($id_user) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_repository from share where id_user = \"".$id_user."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
  {
    $array[0][$i] = getRepositoryInfo($row[0]);
    $array[1][$i] = getFileList($row[0]);
  }
  dbClose($db);
  return ($array);
}

//Liste dans un tableau la liste des fichiers par répertoire
function getFileList($id_repository) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_file from contain where id_repository = \"".$id_repository."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
  {
    $array[$i] = getFileInfo($row[0]);
  }
  dbClose($db);
  return ($array);
}

//Renvoie dans un tableau la liste des infos du fichier
function getFileInfo($id_file) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select * from file where id_file = \"".$id_file."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
  {
    $array[$i] = $row[0];
  }
  dbClose($db);
  return ($array);
}

//Renvoie dans un tableau la liste des infos du répertoire
function getRepositoryInfo ($id_repository) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select * from file where id_file = \"".$id_file."\";";
  $result = $db->query($query);
  for ($i = 0 ;$row = $result->fetchArray(); $i++)
  {
    $array[$i] = $row[0];
  }
  dbClose($db);
  return ($array);
}
?>
