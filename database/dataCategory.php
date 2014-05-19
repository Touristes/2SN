<?php
require_once "dataPost.php";
//category : id_category / name / created
initDefaultCategories();

//ajoute une categorie
function addCategory($name) {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  if (getCategoryID($name) == false) {
  $query = "INSERT INTO category (name, created) values (\"".$name."\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  }
  dbClose($db);
  return (TRUE);
}

//Recupère l'id d'une categorie
function getCategoryID($name) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select id_category from category where name = \"".$name."\";";
  $result = $db->query($query);
  $i = 0;
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
       $ID = $row[$i];
    }
  dbClose($db);
  if ($i != 1)
    return (FALSE);
  return ($ID);
}

//Recupere le nom d'une catégorie
function getCategoryName($id_category) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select name from category where id_category = \"".$id_category."\";";
  $result = $db->query($query);
  $i = 0;
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
       $ID = $row[$i];
    }
  dbClose($db);
  if ($i != 1)
    return (FALSE);
  return ($ID);
}

//initialise des catégories par défaut
function initDefaultCategories() {
  $db =dbConnect();
  if ($db == FALSE)
    return (FALSE);
  if (getCategoryID("Text") == false) {
  $query = "INSERT INTO category (name, created) values (\"Text\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  }
  if (getCategoryID("Picture") == false) {
  $query = "INSERT INTO category (name, created) values (\"Picture\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  }
    if (getCategoryID("Video") == false) {
  $query = "INSERT INTO category (name, created) values (\"Video\",date('now'));";
  $result = $db->query($query);
  if ($result == FALSE)
    {
      dbClose($db);
      return (FALSE);
    }
  }
  dbClose($db);
  return (TRUE);
}
?>
