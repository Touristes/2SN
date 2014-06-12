<?php
require_once "Controllers/videoControler.php";
require_once "Controllers/pictureControler.php";
//ajoute un post à partir d'un tableau en entrée
function addPost($post)
{
  $db = dbConnect();
  $title = $post[1];
  $content = $post[2];
  $id_user = getUserID($post[0]);
  if ($post['5'] == "troll") {
   $troll = 1;
   incrementUserTotalPostTroll($id_user);
 }
 else {
   $troll = 0;
   incrementUserTotalPostActu($id_user);
 }
 if (isPostContainVideoLinkViaContent($content) != false) {
   $query = 'INSERT INTO post (title, id_user, text, id_category, id_type, troll, created, points ) VALUES ("'
    .$title.'",'.$id_user.',"'.$content.'",'.getCategoryID("Video").','.'3,'.$troll.','.'datetime(\'now\')'.','.'0'.');';
incrementUserTotalPostVideo($id_user);
}
else if ($post[3] == getCategoryID("Picture")) {
  $query = 'INSERT INTO post (title, id_user, text, id_category, id_type, troll, created, points ) VALUES ("'
   .$title.'",'.$id_user.',"'.$content.'",'.getCategoryID("Picture").','.'3,'.$troll.','.'datetime(\'now\')'.','.'0'.');';
incrementUserTotalPostImage($id_user);
}
else {
	$query = 'INSERT INTO post (title, id_user, text, id_category, id_type, troll, created, points ) VALUES ("'
   .$title.'",'.$id_user.',"'.$content.'",'.getCategoryID("Text").','.'3,'.$troll.','.'datetime(\'now\')'.','.'0'.');';
incrementUserTotalPostText($id_user);
}
$result = dbQuery($query);
if ($result == 0)
{
 dbClose($db);
 return ("An error occured[ERR DBQUERY]");
}
if (isPostContainVideoLinkViaContent($content) != false) {
  newVideo(getPostID($id_user, getDBDateTime()), $id_user);
}
else if ($post[3] == getCategoryID("Picture"))
  controlerPictureAdd($id_user, getPostID($id_user, getDBDateTime()), $_FILES);
dbClose($db);
return (0);
}
//Efface un post à partir de son id
function delPost($id)
{
  $db = dbConnect();
  if ($db == FALSE)
  {
   dbClose($db);
   return("[ERR DBCONNECT]");
 }
 else
 {
   $query = "DELETE FROM post where id_post=".$id.";";
   $result = dbQuery($query);
   if ($result == 0)
   {
    dbClose($db);
    return("[ERR DBQUERY]");
  }
  else
  {
    dbClose($db);
    return(0);
  }
}
}

//Renvoie le tableau contenant un post à partir de son ID
function showPost($id)
{
  $db = dbConnect();
  if ($db == 0)
  {
   dbClose($db);
   return("[ERR DBCONECT]");
 }
 else
 {
   $query = "SELECT * FROM post WHERE id_post=".$id.";";
   $result = dbSelectToArray($query);
   if ($result == false)
   {
    dbClose($db);
    return("[ERR DBQUERY]");
  }
  else
  {
    dbClose($db);
    return($result);
  }
}
}

//Renvoie la liste de tous les posts dans un tableau
function showAllPost()
{
  $db = dbConnect();
  if ($db == FALSE)
   return("[ERR DBCONNECT]");
 else
 {
   $query = "SELECT * FROM post ORDER BY created DESC, id_post DESC;";
   $allpost = dbSelectToArray($query);
   if ($allpost == false)
   {
    dbClose($db);
    return ("[ERR DBTOARRAY]");
  }
  else
  {
    dbClose($db);
    return ($allpost);
  }
}
}
//affiche les posts par catégorie
function getPostsByCategory($name) {
  $id_category = getCategoryID($name);
  $db = dbConnect();
  if ($db == 0)
  {
    dbClose($db);
    return("[ERR DBCONECT]");
  }
  else
  {
    $query = "SELECT * FROM post WHERE id_category = \"".$id_category."\" order by created desc, id_post desc;";
    $result = dbSelectToArray($query);
    if ($result == false)
    {
      dbClose($db);
      return(false);
    }
    else
    {
      dbClose($db);
      return($result);
    }
  }
}
//affiche les posts par catégorie et par utilisateur
function getPostsByCategoryAndUser($name, $id_user) {
  $id_category = getCategoryID($name);
  $db = dbConnect();
  if ($db == 0)
  {
    dbClose($db);
    return("[ERR DBCONECT]");
  }
  else
  {
    $query = "SELECT * FROM post WHERE id_user = \"".$id_user."\" and id_category = \"".$id_category."\" order by created desc, id_post desc;";
    $result = dbSelectToArray($query);
    if ($result == false)
    {
      dbClose($db);
      return("[ERR DBQUERY]");
    }
    else
    {
      dbClose($db);
      return($result);
    }
  }
}

//affiche les posts par catégorie et par dont l'utilisateur s'est abonné
function getPostsByCategoryAndSubscriptions($name, $id_user) {
  $id_category = getCategoryID($name);
  $db = dbConnect();
  if ($db == 0)
  {
    dbClose($db);
    return("[ERR DBCONECT]");
  }
  else
  {
    $query = "SELECT a.*, b.id_user from subscriber b, posts a where b.id_subscriber = \"".$id_user
		."\" and b.id_subscriber = a.id_user and a.id_category = \"".$id_category."\" order by a.created desc, a.id_post desc;";
    $result = dbSelectToArray($query);
    if ($result == false)
    {
      dbClose($db);
      return("[ERR DBQUERY]");
    }
    else
    {
      dbClose($db);
      return($result);
    }
  }
}

//renvoie true ou si le post appartient à la catégorie name
function isPostByCategory($name, $id_post) {
  $id_category = getCategoryID($name);
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_post from post where id_post = \"".$id_post."\" and id_category = \"".$id_categrory."\";";
  $result = $db->query($query);
  for ($i = 0 ; $row = $result->fetchArray(); $i++)
  {
   $ID = $row[$i];
 }
 dbClose($db);
 if ($result == FALSE)
  return (FALSE);
if ($i > 0)
  return (TRUE);
return (FALSE);
}
//Renvoie un taleau avec la liste des posts pour un utilisateur donné
function showPostByUser($id)
{
  $db = dbConnect();
  if ($db == 0)
  {
    dbClose($db);
    return("[ERR DBCONECT]");
  }
  else
  {
    $query = "SELECT * FROM post WHERE id_user = \"".$id."\" order by created desc, id_post desc;";
    $result = dbSelectToArray($query);
    if ($result == 0)
    {
      dbClose($db);
      return("[ERR DBQUERY]");
    }
    else
    {
      dbClose($db);
      return($result);
    }
  }
}
//Recupère l'ID d'un post à partir de son nom et de la date du post
//Ne fonctionne pas si l'utilisateur a posté plusieurs fois dans la même journée
function getPostID($author, $datetime)
{
  $db = dbConnect();
  if ($db == 0)
  {
   dbClose($db);
   return("[ERR DBCONECT]");
 }
 else
 {
   $query = "SELECT id_post FROM post WHERE id_user = ".$author." and created = Datetime('".$datetime."');";
   $result = $db->query($query);
   for ($i = 0 ; $row = $result->fetchArray(); $i++)
   {
     $ID = $row[$i];
   }
   dbClose($db);
   return($ID);
 }
}

//si la variable troll est à un il l'affiche si c'est à 0 non.
function showTrollPost($troll)
{
  $query = "SELECT * FROM post WHERE troll=".$troll." order by created, id_post desc;";
  $result = dbSelectToArray($query);
  if ($result == 0)
    return("[ERR DBQUERY]");
  return($result);
}

//Affiche les posts par utilisateur en fonction de s'ils sont troll ou actu : 1 pour troll et 0 pour actu
function showTrollPostByUser($troll, $id_user)
{
	$query = "SELECT * FROM post WHERE troll=".$troll." AND id_user=".$id_user." order by created desc, id_post desc;";
  $result = dbSelectToArray($query);
  if ($result == 0)
    return("[ERR DBQUERY]");
  return($result);
}

//Fonction de news du jour
function dailyNews()
{
  $db = dbConnect();
  $query = "SELECT MAX(vote) as maxi FROM vote;";
  $result = $db->query($query);
  dbClose($db);
  return($result);
}

//Fonction de verification de vote
function verPost($id_user, $id_post)
{
  $db = dbConnect();
  $query = "SELECT id_user FROM vote WHERE id_post = '".$id_post."';";
  $result = $db->query($query);
  while($row = $result->fetchArray())
   var_dump($row);
 dbClose($db);
 return(true);
}

//Fonction de vote
function vote($vote, $id_user, $id_post)
{
  echo "je suis arrive";
  $db = dbConnect();
  $query = "SELECT vote FROM post WHERE id_post='".$id_post."';";
  $old_vote = dbQuery($query);
  var_dump($old_vote);
  echo "\n";
  $vote += $old_vote;
  $query2 = "UPDATE post SET vote='".$vote."' WHERE id_post='".$id_post."';";
  $test = dbQuery($query2);
  echo "et encore la";
  var_dump($test);
  echo $id_user;
  echo $id_post;
  $query3 = "INSERT INTO vote (id_user,id_post) VALUES ('".$id_user."', '".$id_post."');";
  $result = dbQuery($query3);
  var_dump($result);
  return ($result);
}

?>
