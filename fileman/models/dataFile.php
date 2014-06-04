<?php
require('../Controllers/dataControler.php');

function insertFile($n, $i, $c, $s, $d){
	dbConnect();
	$sql = "INSERT INTO file (name, id_user, created, url, size, description) VALUES (\"".$n."\",\"".$i."\",\"".$c."\",\"".$s."\",\"".$d.\");";
	if (dbQuery($sql)){
		echo "fichier ajouté en base";
	}
	dbClose();
}
function deleteFile($name){
	dbConnect();
	$sql = "DELETE FROM file WHERE name = \"".$name."\";";
	if (dbQuery($sql)){
		echo "fichier ajouté en base";
	}
	dbClose();
}
function displayAllFileUser(){

  $db = dbConnect();
  $sql = $db->prepare('SELECT name FROM file;');
  $result = $sql->execute();
  echo "Voila Tes Fichiers";
  while ($row = $result->fetchArray())
  {
     echo "<pre>";
     echo "<form action='delete_file.php' method='POST'>";
     echo "<table><tr>";
     echo "<td width='20%;'><label id='label-dbname' for='name-database' name='label-dbname'>".$row[name]."</label></td>";  
     echo '<td><a type="submit" id="button-delete" value="Delete" class="btn btn-danger" role="button" name="delete">Delete</a></td>';
     echo  "</tr></table>";     
     echo "</form>";
     echo "</pre>";
  }
  dbClose();
}
function displayPublicFile(){
	dbConnect();
	$sql = "INSERT INTO file (name, id_user, created, size, description) VALUES (value1, value2, value3, value4, value5);";
	if (dbQuery($sql)){
		echo "fichier public uploader";
	}
	dbClose();
}
function displayFileFor($user){
	dbConnect();
	$sql = "INSERT INTO file (name, id_user, created, size, description) VALUES (value1, value2, value3, value4, value5);";
	if (dbQuery($sql)){
		echo "fichier ajouté en base";
	}
	dbClose();
}
