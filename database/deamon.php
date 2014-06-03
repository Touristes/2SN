#!/usr/local/bin/php
<?php
// deamon.php for deamon in /Users/raffin_j/raffin_j/2sn/2SN/database
// 
// Made by jean-baptiste raffin
// Login   <raffin_j@etna-alternance.net>
// 
// Started on  Wed May 28 17:03:50 2014 jean-baptiste raffin
// Last update Tue Jun  3 17:25:15 2014 jean-baptiste raffin
//
require_once 'dataConnect.php'

$date = date('Y-m-d');
$week = mktime(0, 0, 0, date('Y'), date('m'), date('d')-7);
dbConnect();
$query = "DELETE * FROM post WHERE date BETWEEN '" + $week "' AND '" + $date + "';";
dbquery($query);
dbClose();
