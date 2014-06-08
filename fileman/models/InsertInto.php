<?php
	/********* Reference ***********/
	//require_once('./display_file.php');
	//require_once('dataRepo.php');
	chdir("../../");
	require_once('Controllers/dataControler.php');
	include "Resources/sessionInit.php"; 
	
	// /********* Variables **********/
	
	$login 			= $_SESSION['login'];
	$filename 		= str_replace(" ", "_", $_POST["nom"]);
	$filesize 		= $_POST["taille"];
	$rep 			= $_POST["repertoire"];
	$date 			= ".datetime(\"now\").";
	$id_user 		= getUserID($login);
	$url 			= "uploads/".$filename."";
	$description 	= "no description";
	$id_groups 		= 4;
	// $id_repository 	= getRepoID($rep);

	echo $filename;echo "\n";echo $_SESSION['login'];echo "\n";echo $id_user;echo $rep;
	// echo $id_repository;
 	
 	$db = dbConnect();

 	// createRepo($name, $id_groups, $id_user);

 	//  	$query_repo = "INSERT INTO repository (name, id_groups, created, id_user) 
 	//  			VALUES (\"".$rep."\",\"".$id_groups."\","."datetime(\"now\")".",\"".$id_user."\");";
 	// $sql = $db->prepare($query_repo);
  // 		$result = $sql->execute(); 

 	$query_file = "INSERT INTO file (name, id_user, created, url, size, description) 
 	 		VALUES (\"".$filename."\",\"".$id_user."\","."datetime(\"now\")".",\"".$url."\",\"".$filesize."\",\"".$description."\");";
  	$sql = $db->prepare($query_file);
  	$result = $sql->execute();



  // 		$query_contain = "INSERT INTO contain (id_repository, id_file) 
 	//  		VALUES (\"".$id_repository."\",\"".$id_user."\");";
 	// $sql = $db->prepare($query_contain);
  // 		$result = $sql->execute(); 

  	/*******   Rafraichir la list des fichier  ********/
  	

