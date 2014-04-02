<?php
function dbConnect() {
  $dbname = 'database.db';
  $db = new SQLite3($dbname);
  if (isset($db))
    return ($db);
  else
    {
      echo "SQL error";
      return (FALSE);
    }
}
function dbClose($db) {
  $db->close();
}
function dbQuery($query) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $result = $db->query($query);
  dbClose($db);
  return ($result);
}
function dbSelectDisplay($query) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
	echo $row[$i] . " ";
      echo "<br>";
    }
  dbClose($db);
  return (0);
}
function dbSelectToArray($query) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $result = $db->query($query);
  for ($j = 0 ;$row = $result->fetchArray(); $j++)
    {
      for ($i = 0; isset($row[$i]); $i++)
        $array[$i][$j] = $row[$i];
    }
  dbClose($db);
  return ($array);
}
function dbSearchDisplay($field_searched, $content, $table, $field_wanted) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select \"".$field_wanted."\" from \"".$table."\" where \"".$field_searched
    ."\" like \"".$content."\";";
  $result = $db->query($query);
  while ($row = $result->fetchArray())
    {
      for ($i = 0; isset($row[$i]); $i++)
        echo $row[$i] . " ";
      echo "<br>";
    }
  dbClose($db);
  return (0);
}
function dbSearchToArray($field_searched, $content, $table, $field_wanted) {
  $db = dbConnect();
  if ($db == FALSE)
    return (0);
  $query = "select \"".$field_wanted."\" from \"".$table."\" where \"".$field_searched
    ."\" like \"".$content."\";";
  $result = $db->query($query);
  for ($j = 0; $row = $result->fetchArray(); $j++)
    {
      for ($i = 0; isset($row[$i]); $i++)
        $array[$i][$j] = $row[$i];
    }
  dbClose($db);
  return ($array);
}
?>
