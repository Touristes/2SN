<?php
require_once "dataRef.php";

//Test si le post contient un lien vidéo, et renvoie la liste oui
function isPostContainVideoLink($id_post) {
	if (($links = getLinks($id_post)) == false)
		return (false);
	if ($links = videoSupportedSites($links) == false)
		return (false);
	return ($links);
}

//Test si le post contient un lien vidéo, et renvoie la liste oui
function isPostContainVideoLinkViaContent($content) {
	if (($links = getLinksViaContent($content)) == false)
		return (false);
	$links = videoSupportedSites($links);
	if ($links == false)
	  	return (false);;
	return ($links);
}

//Récupères tous les liens d'un post
function getLinks($id_post) {
	$tab = showPost($id_post);
	$content = $tab[3];
	if (preg_match_all("|(http.*)|u", $content, $links)) {
		return ($links[0]);
	}
	else
		return (false);
}

//Récupères tous les liens d'un post
function getLinksViaContent($content) {
  if (preg_match_all("|(http.*)|u", $content, $links)) {
		return ($links[0]);
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
		if(preg_match_all('#^(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=watch\/)[^"&\n]+|(?<=embed\/)[^"&\n]+|(?<=(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+#',$video, $video)) {
			$tmp_links[$j] = "http://youtube.com/embed/".$video[0][0];
			$j++;
		}
	}
	if ($j > 0)
		return ($tmp_links);
	else
		return (false);
}
?>
