#!/usr/bin/php
<?php
// deamon.php for deamon in /Users/raffin_j/raffin_j/2sn/2SN/database
// 
// Made by jean-baptiste raffin
// Login   <raffin_j@etna-alternance.net>
// 
// Started on  Wed May 28 17:03:50 2014 jean-baptiste raffin
// Last update Mon Jun  9 09:57:48 2014 jean-baptiste raffin
//
chdir("../");
require_once "./Controllers/dataControler.php";

$db = dbConnect();
if ($db == FALSE)
  return (0);
$query = "select date('now', '-7 day');";
$result = $db->query($query);
while ($row = $result->fetchArray())
  {
	$time = $row[0];
  }
$queryPath = "select path from picture where posted <= '".$time."';";
$result = $db->query($queryPath);
for ($i = 0; $row = $result->fetchArray(); $i++)
  {
	unlink($row[0]);
  }
$delete_video = "DELETE FROM video where posted <='".$time."';";
$db->query($delete_video);
$delete_picture = "DELETE FROM picture where posted <= '".$time."';";
$db->query($delete_picture);
$delete_post = "DELETE FROM post WHERE created <= '".$time."';";
$db->query($delete_post);
dbClose($db);
