<?php

function isChuckInThere($string) {
	if (preg_match_all("(chuck\snorris)",strtolower($string), $out)) {
		return (true);
	}
	else
		return (false);
}

function affChuck() {
	echo "<img class=\"chuck\" src=\"Views/Images/Others/chuck_no.png\" />";
}


function isIt($id_user) {
isItChuckAccount($id_user);
isItSparta($id_user);
isItSouthPark($id_user);
isItStarWars($id_user);
isItSimpsons($id_user);
isItCharlieSheen($id_user);
}

function isItChuckAccount($id_user) {
	$name = strtolower(getUserInfo("name", $id_user));
	$firstName = strtolower(getUserInfo("firstname", $id_user));
	if ($name == "norris" && $firstname == "chuck")
		changeBackgroundToChuck();
	else
		return (false);
	return (true);
}

function changeBackgroundToChuck() {
	echo "<style type=\"text/css\">
	body
	{
		background-image: url('Views/Images/Others/chuckBackground.jpg');
	}
	</style> ";
}

function isItSparta($id_user) {
	$postalcode = getUserInfo("postalcode", $id_user);
	$name = strtolower(getUserInfo("name", $id_user));
	$firstname = strtolower(getUserInfo("firstname", $id_user));
	if (($postalcode == 23100) || ($name == "leonidas" || $firstname == "leonidas")) {
		echo "<style type=\"text/css\">
		body
		{
			background-image: url('Views/Images/Others/sparta.jpg');
		}
		</style> ";
		return (true);
	}
	return(false);
}

function isItSouthPark($id_user) {
	$firstname = strtolower(getUserInfo("name", $id_user));
	$name = strtolower(getUserInfo("firstname", $id_user));
	if (($name == "eric" && $firstname == "cartman") || ($name == "kenny" && $firstname == "mccormick") 
		|| ($name == "butters" && $firstname == "stoch") || ($name == "kyle" && $firstname == "broflovski")
		|| ($name == "stan" && $firstname == "march")) {
		echo "<style type=\"text/css\">
	body
	{
		background-image: url('Views/Images/Others/southpark.jpg');
	}
	</style> ";
	echo "<script type=\"text/javascript\">alert(\"Servietsky : On s'fume un pétard ?\"); </script>";
	return (true);
}
return(false);
}

function isItStarWars($id_user) {
	$name = strtolower(getUserInfo("name", $id_user));
	$firstname = strtolower(getUserInfo("firstname", $id_user));
	if (($name == "skywalker") || ($name == "obiwan") || ($name == "yoda") || ($name == "vador") || ($name == "solo")) {
		echo "<style type=\"text/css\">
		body
		{
			background-image: url('Views/Images/Others/starwars.jpg');
		}
		</style> ";
		echo "<script type=\"text/javascript\">alert(\"Luke, why did you kissed your own sister ??! \"); </script>";
		return (true);
	}
	return(false);
}

function isItSimpsons($id_user) {
	$name = strtolower(getUserInfo("name", $id_user));
	$firstname = strtolower(getUserInfo("firstname", $id_user));
	if (($name == "simpson") || ($name == "simpsons")) {
		echo "<style type=\"text/css\">
		body
		{
			background-image: url('Views/Images/Others/simpsons.jpg');
		}
		</style> ";
		echo "<script type=\"text/javascript\">alert(\"Here take a duff !\"); </script>";
		echo "<script type=\"text/javascript\">alert(\"D'oh !\"); </script>";
		return (true);
	}
	return(false);
}

function isItCharlieSheen($id_user) {
	$name = strtolower(getUserInfo("name", $id_user));
	$firstname = strtolower(getUserInfo("firstname", $id_user));
	if (($name == "sheen") || ($name == "charlie")) {
		echo "<script type=\"text/javascript\">alert(\"Suivez la ligne blanche !\"); </script>";
		return (true);
	}
	return(false);
}

function nyanCat() {
	$random = mt_rand(30, 43);
	if ($random ==  42)
		videoView("http://www.youtube.com/embed/QHLq0yCEUts&autoplay=1");
}

function addTrollPic() {
	echo "<img class=\"chuck\" src=\"Views/Images/Others/troll.png\" />";
}

function addActuPic() {
	echo "<img class=\"chuck\" src=\"Views/Images/Others/actu.png\" />";
}
function callCaptainObvious() {
	$random = mt_rand(1, 50);
	$array[1] = "Manger est le meilleur remède contre la faim.";
	$array[2] = "Dans 365 jours, nous serons dans un an.";
	$array[3] = "Tu es sur [Why].";
	$array[4] = "Tu es devant un ordinateur.";
	$array[5] = "Demain est un autre jour.";
	$array[6] = "Quelqu’un dans le monde va acheter un calendrier dans les 12 prochains mois.";
	$array[7] = "Le futur arrive.";
	$array[8] = "Dans deux... non, trois... non, attends, dans des années, il y en aura une qui sera divisible par deux.";
	$array[9] = "Dans 2 ans, nous serons 2 ans dans le futur.";
	$array[10] = "Les gens morts ne sont pas vivants.";
	$array[11] = "Si quelque chose devient difficile, ce ne sera plus facile.";
	$array[12] = "Si tu détestes quelqu'un, ça indique probablement que tu ne l'aimes pas.";
	$array[13] = "Quand tu as soif, rien n'est meilleur que de boire liquide.";
	$array[14] = "En haut, il y a la barre de menu.";
	$array[15] = "Quand tu cliques sur profil, tu vas sur la page profil.";
	$array[16] = "Quand tu te déconnectes, tu es déconnecté.";
	$array[17] = "Tu es devant un écran.";
	$array[18] = "Tu es sur un site web.";
	$array[19] = "Quand tu cliques sur Mes Messages, tu accèdes à la partie message.";
	$array[20] = "Ton écran est sale.";
	$array[21] = "Tu vas cliquer sur OK.";
	$array[22] = "Arrêtes de me cliquer dessus, c'est déplacé.";
	$array[23] = "La nuit, on ne voit plus le soleil.";
	$array[24] = "Tu es sur la faq.";
	$array[25] = "Une combinaison de plusieurs lettres forme parfois un mot.";
	$array[26] = "Les personnes sont des gens.";
	$array[27] = "Un train fonctionne grâce à des rails, comme Charlie Sheen.";
	$array[28] = "Il y a des chats sur le net.";
	$array[29] = "Le protocole HTTP, c'est un protocole de communication.";
	$array[30] = "Une fenêtre viens de s'afficher.";
	$array[31] = "C'est ton Capitaine qui te parle.";
	$array[32] = "Tu as ta main sur un dispositif de pointage.";
	$array[34] = "Tu es concient de ta respiration, maintenant.";
	$array[35] = "Le Français moyen est très moyen.";
	$array[35] = "Les tubes musicaux sont vides de sens, car un tube sonne creux.";
	$array[36] = "La télévision est un outil de propagande très efficace, si tu n'es pas d'accord c'est que tu la regardes.";
	$array[37] = "L'Etna est un volcan.";
	$array[38] = "Tiens-toi bien, le cheval blanc d'Henri IV, était non seulement un cheval, mais il était blanc aussi.";
	$array[39] = "Un jour, il y a autant d'années que tu as eu d'anniversaires, tu es né.";
	$array[40] = "Jean-François Copé aime vraiment les pains au chocolat.";
	$array[41] = "Lorsque tu additionnes 17 à 230 puis soustraies la racine cubique de 192, tu fais des maths.";
	$array[42] = "Dans le portrait de Napoléon 1er dans son cabinet, de Jacques-Louis David, Napoléon n'avait pas de dragon ball.";
	$array[43] = "R2D2 est le personnage le plus censuré de l'histoire du cinéma, tous ses mots ont été remplacés par des bips.";
	$array[44] = "Si tu marches suffisament longtemps dans une direction sans dévier, tu attendras une étendue d'eau.";
	$array[45] = "Selon une multitude d'études sur le sujet, à l'origine de l'univers, le big bang aurait fait bang.";
	$array[46] = "La deuxième guerre mondiale est arrivée après la première.";
	$array[47] = "RoboCop est un policier robotisé.";
	$array[48] = "Savais-tu que le couteau suisse était d'origine Suisse ?";
	$array[49] = "Les gens sortent leur appareil photo presque sans réfléchir et comptent sur la technologie pour se souvenir à leur place.";
	$array[50] = "Star Trek a été tourné sur terre.";
	//En ajouter plusieurs pour décrire les autres easter eggs
	echo "<script type=\"text/javascript\">alert(\"".$array[$random]."\"); </script>";
}

?>
