<?php
require_once "dataRef.php";

//ajoute le fichier sur le serveur
function addFileToServeur($_FILE) {
	//Teste la taille du fichier avant de l'uploader
	if(filesize($_FILES['picture']['tmp_name']) > 4194304) {
		return (false);
	}
	//Ajoute le fichier
	if(isset($_FILES['picture'])) { 
		$dir = 'images/upload/';
		$fichier = basename($_FILES['picture']['name']);
		if(!move_uploaded_file($_FILES['picture']['tmp_name'], $dir . $fichier)) {
			return(false);
		}
	}
	return (true);
}

//efface le fichier du serveur
function delFileFromServeur($path) {
	if (unlink($path) == false) {
		return (false);
	}
	return (true);
}

?>