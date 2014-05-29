<?php
	echo "InsertInto.php";
	/**************************************************/
	require_once('dataConnect.php');

	$filename = $_POST["nom"];
	$filesize = $_POST["taille"];
	$filerep = $_POST["repertoire"];
	$date =	"2010/10/10";
	$id_user = 1;
	$url = "uploads/file";
	$description = "no description";
	
	echo $filename;echo $filesize;echo $filerep;echo $date;echo $id_user;echo $description;


	  	$db =dbConnect();
	  	if ($db == FALSE){
	  		echo "connection db KO";	
	    	return (FALSE);
	    }
	    echo "connection db OKKK";	

	 // $sql = "INSERT INTO file (name, id_user, created, url, size, description) VALUES (\"".$filename."\",\"".$id_user."\",\"".$date."\",\"".$url."\",\"".$filesize."\",\"".$description."\");";
	 $sql = "INSERT INTO file (name, id_user, created, url, size, description) VALUES ('".$_POST["nom"]."',1,'$date','uploads/file',23,'$description');";

		$result = $db->query($sql);
	  	if ($result == FALSE)
	    {
	      dbClose($db);
	      var_dump($sql);
	      return (FALSE);
	    }
	  	dbClose($db);
	  	echo "SQL Well done execute";
	  	return (TRUE);
?>