<?php
	/**************************************************/
	require_once('dataConnect.php');

	$filename = $_POST["nom"];
	$filesize = $_POST["taille"];
	$filerep = $_POST["repertoire"];
	$date =	"2010/10/10";
	$id_user = 1;
	$url = "uploads/".$filename."";
	$description = "no description";
	
	//echo $filename;echo $filesize;echo $filerep;echo $date;echo $id_user;echo $description;

	$query = "DELETE FROM file WHERE name = \"".$name."\";";
  	$db = dbConnect();
  	$sql = $db->prepare($query);
  	$result = $sql->execute();

  	// echo "<div class='alert alert-success col-md-3'>";
  	// if ($result){
  	// 	echo $filename." à été uploadé ";
  	// }
  	// echo "</div>";
?>