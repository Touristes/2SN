<?php
require_once "dataRef.php";

//ajoute le fichier sur le serveur
function addFileToServeur() {
	//Teste la taille du fichier avant de l'uploader
	if(filesize($_FILES['file']['tmp_name']) > 4194304) {
		return (false);
	}
	//Ajoute le fichier
	if(isset($_FILES['file'])) {
		$dir = 'Views/Images/Upload/';
		$fichier = $_FILES['file']['name'];
		if(!(move_uploaded_file($_FILES['file']['tmp_name'], $dir . $fichier))) {
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
