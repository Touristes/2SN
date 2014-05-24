<?php
	echo "Passé dans InsertInto";
	/**************************************************/
	require_once('dataConnect.php');
	$filename = $_POST["nom"];
	$filesize = $_POST["taille"];
	$filerep = $_POST["repertoire"];
	echo $filename;
	echo $filesize;
	echo $filerep;

	//$sql = "INSERT INTO file (name, id_user, created, url, size, description) VALUES ('ana','ana','ana','ana','ana','banana');";
	//VALUES ("'.$title.'",'.$id_user.',"'.$content.'",2,'.'3,'.'date(\'now\')'.');';
	// $query = 'INSERT INTO post (title, id_user, text, id_category, id_type, created ) VALUES ("'.$title.'",'.$id_user.',"'.$content.'",2,'.'3,'.'date(\'now\')'.');';
 	// $result = dbQuery($query);
	$sql = 'INSERT INTO file (name, id_user, created, url, size, description) VALUES ("'.$filename.'",'001','.'date(\'now\')'.',"'.$filesize.'",'10',"azertyu");';

	if (dbQuery($sql)){
		echo "Well done insert";
	} else {
		echo "not inserted";
	}