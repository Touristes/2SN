#!/usr/local/bin/php
<?php
// deamon.php for deamon in /Users/raffin_j/raffin_j/2sn/2SN/database
// 
// Made by jean-baptiste raffin
// Login   <raffin_j@etna-alternance.net>
// 
// Started on  Wed May 28 17:03:50 2014 jean-baptiste raffin
// Last update Thu May 29 11:00:27 2014 jean-baptiste raffin
//
require_once 'dataConnect.php'

$date = date();
dbConnect();
$query = "SELECT * FROM post WHERE date BETWEEN '' AND '';";
dbquery($query);
dbClose();
