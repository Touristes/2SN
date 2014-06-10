<?php
	/********* Reference ***********/
	chdir("../../");
	require_once('Controllers/dataControler.php');
	include "Resources/sessionInit.php"; 
	
	/********* Variables **********/
	
	$login 			= $_SESSION['login'];
	$filename 		= str_replace(" ", "_", $_POST["nom"]);
	$filesize 		= $_POST["taille"];
	$rep 			= $_POST["repertoire"];
	$rep_select 	= $_POST["repertoireselect"];
	$date 			= ".datetime(\"now\").";
	$id_user 		= getUserID($login);
	$url 			= "uploads/".$filename."";
	$description 	= "no description";
	$id_groups 		= 4;
	$id_repository 	= getRepoID($rep_select);

	// echo $rep_select;
	echo $id_user;
 	
 	$db = dbConnect();

 	$query_file = "INSERT INTO file (name, id_user, created, url, size, description) 
 	 		VALUES (\"".$filename."\",\"".$id_user."\","."datetime(\"now\")".",\"".$url."\",\"".$filesize."\",\"".$description."\");";
  	$sql = $db->prepare($query_file);
  	$result = $sql->execute();

  	$query_contain = "INSERT INTO contain (id_repository, id_file) 
 	 		VALUES (\"".$id_repository."\",\"".$id_user."\");";
 	$sql = $db->prepare($query_contain);
  	$result = $sql->execute(); 

  	/*******   Rafraichir la list des fichier  ********/
  	

