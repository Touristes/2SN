<?php
// voteController.php for 2sn in /Users/raffin_j/raffin_j/2sn/2SN/Controllers
// 
// Made by jean-baptiste raffin
// Login   <raffin_j@etna-alternance.net>
// 
// Started on  Thu Jun 12 09:18:29 2014 jean-baptiste raffin
// Last update Thu Jun 12 12:00:19 2014 jean-baptiste raffin
//
chdir("../");
require_once("./Controllers/frontControler.php");

$vote["good"] = $_POST["good"];
$vote["bad"] = $_POST["bad"];
$vote["id_user"] = $_POST["user"];
$vote["id_post"] = $_POST["post"];
if ($vote["good"] == NULL)
  $res = -1;
else
  $res = 1;
$resultat = vote($res, $vote["id_user"], $vote["id_post"]);
echo "ha y est";
?>