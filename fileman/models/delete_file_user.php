<?php
	/**************************************************/
	chdir("../../");
	require_once('Controllers/dataControler.php');
	include "Resources/sessionInit.php"; 

	$login 			= $_POST['loginname'];
	$filename 		= $_POST['filename'];
	$id_user 		= getUserID($login);

	$query = "DELETE FROM file WHERE name = \"".$filename."\" AND id_user = \"".$id_user."\";";
  	$db = dbConnect();
  	$sql = $db->prepare($query);
  	$result = $sql->execute();

  	echo "<div class='alert alert-success col-md-3'>";
  	if ($result){
  		echo $filename." à été supprimer ";
  	}
  	echo "</div>";
?>