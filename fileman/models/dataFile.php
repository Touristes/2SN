<?php
require('dataConnect.php');

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
function displayAllFile(){
	dbConnect();
	$sql = "SELECT * FROM file;";
	if (dbQuery($sql)){
		echo "Tout vos fichier uploader";
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
