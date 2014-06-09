<?php
	//require_once('fileman_function.php');
	chdir("../../");
	require_once('Controllers/dataControler.php');
	//require_once('Controllers/dataUser.php');
	include "Resources/sessionInit.php"; 

	$login 			= $_POST['loginname'];
	$rep 			= $_POST['repname'];
	$id_user 		= getUserID($login);
	$id_groups 		= 0;

	echo $login;
	echo $id_user;

	if ($rep == ""){
		echo "tu dois entrer un de repertoire";
		return false;
	}

	$db = dbConnect();
	$query_repo = "INSERT INTO repository (name, id_groups, created, id_user) VALUES (\"".$rep."\",\"".$id_groups."\","."datetime(\"now\")".",\"".$id_user."\");";
 	$sql = $db->prepare($query_repo);
  	$result = $sql->execute(); 

  	echo "le repertoire ".$rep." a été crée";
	//createRepo($name, $id_groups, $id_user);

?>
