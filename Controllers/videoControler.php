<?php
require_once "../dataRef.php";
require_once "../Models/videoModel.php";
require_once "../videoView.php";

//Lance l'affichage de la video
function affVideo($id_post) {
//Test si le post contiens un lien video
if (($links = isPostContainVideoLink($id_post)) == false) {
	return (false);
}
else {
	for ($i = 0; isset($links[$i]); $i++) {
		videoView($links[$i]);
	}
	return ($links);
}

//Lance les contrôlles avant enregistrement de la vidéo
function newVideo($id_post) {
	if (($links = isPostContainVideoLink($id_post)) == false) {
	return (false);
}
else {
	add
	for ($i = 0; isset($links[$i]); $i++) {
		addVideo($id_user, $id_post, $links[$i]);
	}
	return ($links);
}
}
?>
