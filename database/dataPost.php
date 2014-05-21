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
  $troll = 0;
  if (isPostContainVideoLinkViaContent($content) != false) {
	$query = 'INSERT INTO post (title, id_user, text, id_category, id_type, troll, created ) VALUES ("'
		.$title.'",'.$id_user.',"'.$content.'",'.getCategoryID("Video").','.'3,'.$troll.','.'datetime(\'now\')'.');';
  }
  else if ($post[3] == getCategoryID("Picture")) {
        $query = 'INSERT INTO post (title, id_user, text, id_category, id_type, troll, created ) VALUES ("'
	  .$title.'",'.$id_user.',"'.$content.'",'.getCategoryID("Picture").','.'3,'.$troll.','.'datetime(\'now\')'.');';
  }
  else {
	$query = 'INSERT INTO post (title, id_user, text, id_category, id_type, troll, created ) VALUES ("'
		.$title.'",'.$id_user.',"'.$content.'",'.getCategoryID("Text").','.'3,'.$troll.','.'datetime(\'now\')'.');';
  }
  $result = dbQuery($query);
  if ($result == 0)
	{
	  dbClose($db);
	  return ("An error occured[ERR DBQUERY]");
	}
  if (isPostContainVideoLinkViaContent($content) != false) {
		newVideo(getPostID($id_user, date("Y-m-d H:i:s")));
  }
  else if ($post[3] == getCategoryID("Picture"))
    controlerPictureAdd($id_user, $id_post, $_FILES);
  else
	{
	  dbClose($db);
	  return (0);
	}
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

//Renvoi le tableau contenant un post à partir de son ID
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
	  if ($allpost == 0)
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
      $query = "SELECT * FROM post WHERE id_category = \"".$id_category."\" order by created, id_post desc;";
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
      $query = "SELECT * FROM post WHERE id_user = \"".$id_user."\" and id_category = \"".$id_category."\" order by created, id_post desc;";
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
//renvoie true ou si le post appartient à la catégorie name
function isPostByCategory($name, $id_post) {
  $id_category = getCategoryID($name);
  $db = dbConnect();
  $i = 0;
  if ($db == FALSE)
    return (0);
  $query = "select id_post from post where id_post = \"".$id_post."\" and id_category = \"".$id_categrory."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
$ID = $row[$i];
    }
  dbClose($db);
  if ($i == 1)
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
      $query = "SELECT * FROM post WHERE id_user = \"".$id."\" order by created, id_post desc;";
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
	  $query = "SELECT id_post FROM post WHERE id_user = {SELECT id_user FROM users WHERE name = ".$author.";} AND created like ".$datetime.";";
	  $result = dbQuery($query);
	  if ($result = 0)
		{
		  dbClose($db);
		  return("[ERR DBQUERY]");
		}
	  else
		{
		  dbCLose($db);
		  return($result);
		}
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

//si la variable troll est à un il l'affiche si c'est à 0 non.
function showTrollPostByUser($troll, $id_user)
{
	$query = "SELECT * FROM post WHERE troll=".$troll." AND id_user=".$id_user." order by created, id_post desc;";
    $result = dbSelectToArray($query);
    if ($result == 0)
      return("[ERR DBQUERY]");
    return($result);
}
?>
