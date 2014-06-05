<?php
	/**************************************************/
	chdir("../../");
	require_once('Controllers/dataControler.php');
	// chdir("./fileman/models/");

	//$filename = $_POST["nom"];
	$filename = str_replace(" ", "_", $_POST["nom"]);
	$filesize = $_POST["taille"];
	$filerep = $_POST["repertoire"];
	$date =	".datetime(\"now\").";//"."datetime(\"now\")"."
	$id_user = 1;
	$url = "uploads/".$filename."";
	$description = "no description";
	
	echo $fileman;
	//echo $filename;echo $filesize;echo $filerep;echo $date;echo $id_user;echo $description;
 		$query = "INSERT INTO file (name, id_user, created, url, size, description) 
 	 			VALUES (\"".$filename."\",\"".$id_user."\","."datetime(\"now\")".",\"".$url."\",\"".$filesize."\",\"".$description."\");";
  	$db = dbConnect();
  	$sql = $db->prepare($query);
  	$result = $sql->execute();

?>