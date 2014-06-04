#!/usr/bin/php
<?php
// deamon.php for deamon in /Users/raffin_j/raffin_j/2sn/2SN/database
// 
// Made by jean-baptiste raffin
// Login   <raffin_j@etna-alternance.net>
// 
// Started on  Wed May 28 17:03:50 2014 jean-baptiste raffin
// Last update Wed Jun  4 17:10:10 2014 jean-baptiste raffin
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
$delete_video = "DELETE FROM video where posted <='".$time."';";
$db->query($delete_video);
$delete_picture = "DELETE FROM picture where posted <= '".$time."';";
$db->query($delete_picture);
$delete_post = "DELETE FROM post WHERE created <= '".$time."';";
$db->query($delete_post);
dbClose($db);