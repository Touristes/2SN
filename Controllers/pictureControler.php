<?php
require_once "dataRef.php";
require_once "Models/pictureModel.php";

//Test l'image à partir de son chemin
function pictureTest() {
//Test si le fichier à l'extension souhaitée (.png, .jpeg, .jpeg, bmp, ou .gif)
	if(!(preg_match('/\.(png|jpeg|jpg|gif|bmp)$/i', $_FILES['file']['name']))) {
		return (FALSE);
	}
//Test si le fichier est d'une taille supérieure à 4Mo
	if ($_FILES['file']['size'] > 4194304) {
		return (FALSE);
	}
	return (TRUE);
}

//appelle le controlleur d'ajout
function controlerPictureAdd($id_user, $id_post) {
//ajoute l'image sur le serveur
	if (addFileToServeur() == false) {
		return (false);
	}
$path = "images/upload/" . basename($_FILES['file']['name']);
//ajoute l'image sur la base de données
	if (addPicture ($id_user, $id_post, $path) == false) {
		delFileFromServeur($path);
		return (false);
	}
	$id_picture = getPictureID($id_post);
//teste la viabilité de l'image
	if (pictureTest() == false) {
		delPicture($id_picture);
		delFileFromServeur($path);
		return (false);
	}
	return(true);
}

//appelle le controlleur de suppression
function controlerPictureRemove($id_picture) {
//supprime l'image sur le serveur
	$path = getPicturePath($id_picture);
	delFileFromServeur($path);
	delPicture($id_picture);
	return(true);
}

//Lance l'affichage de l'image
function controlerPictureDisplay($id_post) {
affPicture(getPicturePath(getPictureID($id_post)));
}
?>
