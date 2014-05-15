<?php

function addPost($post)
{
  $db = dbConnect();
  $title = $post[1];
  $content = $post[2];
  $id_user = getUserID($post[0]);
  $troll = 0;
  $query = 'INSERT INTO post (title, id_user, text, id_category, id_type, troll, created ) VALUES ("'
  	.$title.'",'.$id_user.',"'.$content.'",2,'.'3,'.$troll.','.'date(\'now\')'.');';
  $result = dbQuery($query);
  if ($result == 0)
	{
	  dbClose($db);
	  return ("An error occured[ERR DBQUERY]");
	}
  else
	{
	  dbClose($db);
	  return (0);
	}
}

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

//function showMultiplePost($field, $value);

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
      $query = "SELECT * FROM post WHERE id_user=".$id." order by created, id_post desc;";
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


function getPostID($author, $date)
{
  $db = dbConnect();
  if ($db == 0)
	{
	  dbClose($db);
	  return("[ERR DBCONECT]");
	}
  else
	{
	  $query = "SELECT id_post FROM post WHERE id_user = {SELECT id_user FROM users WHERE name = ".$author.";} AND created = ".$date.";";
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


?>

