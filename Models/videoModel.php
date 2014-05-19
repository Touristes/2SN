<?php
require_once "dataRef.php";

//Test si le post contient un lien vidéo, et renvoie la liste oui
function isPostContainVideoLink($id_post) {
	if (($links = getLinks($id_post)) == false)
		return (false);
	if ($links = videoSupportedSites($links) == false)
		return (false);
	else
		return ($links);
}

//Récupères tous les liens d'un post
function getLinks($id_post) {
	$tab = showPost($id_post);
	$content = $tab[3];
	if (preg_match_all("|(http.*^[:blank:])|U", $content, $links, PREG_PATTERN_ORDER)) {
		return ($links);
	}
	else
		return (false);
}

//Transforme les vidéos pour leur donner la nomenclature voulue
function videoSupportedSites($links) {
	$tmp_links;
	$j = 0;
	for ($i = 0 ; isset($links[$i]); $i++) {
		$video = $links[$i];
		if(preg_match('#^(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=watch\/)[^"&\n]+|(?<=embed\/)[^"&\n]+|(?<=(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+', $video)) {
			$tmp_links[$j] = "http://youtube.com/embed/".$video;
			$j++;
		}
	}
	if ($j > 0)
		return ($tmp_links);
	else
		return (false);
}
?>
