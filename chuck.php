<?php

function isChuckInThere($string) {
	if (preg_match_all("(chuck\snorris)",strtolower($string), $out) {
		return (true);
	}
	else
		return (false);
}

function affChuck() {
	echo "<img src=\"Views/Images/Others/chuck_no.jpg\" />";
}

function isItChuckAccount($id_user) {
$name = strtolower(getUserInfo("name", $id_user));
$firstName = strtolower(getUserInfo("firstname", $id_user));
if ($name == "norris" && $firstname == "chuck")
	changeBackgroundToChuck{);
else
	return (false);
return (true);
}

function changeBackgroundToChuck{) {
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
if (($postalcode == 23100) || ($name == "leonidas" || $firstname == "leonidas") {
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
if ($random == 42)
	videoView("http://www.youtube.com/embed/QHLq0yCEUts&autoplay=1");
}

function addTrollPic() {
	echo "<img src=\"troll.jpg\" />";
}

function callCaptainObvious() {
	$random = mt_rand(1, 20);
	$array[1] = "Manger est le meilleur remède contre la faim.";
	$array[2] = "Dans 365 jours, nous serons dans un an.";
	$array[3] = "Vous êtes sur Why.";
	$array[4] = "Vous êtes devant votre ordinateur";
	$array[5] = "Demain est un autre jour";
	$array[6] = "Quelqu’un dans le monde va acheter un calendrier dans les 12 prochains mois.";
	$array[7] = "Le futur arrive.";
	$array[8] = "Dans 2 ... non, trois ..., non attendez, dans des années, il y en aura une qui sera divisible par deux.";
	$array[9] = "Dans 2 ans, nous serons 2 ans dans le futur.";
	$array[10] = "Les gens morts ne sont pas vivants.";
	$array[11] = "Si quelque chose devient difficile, ce ne sera plus facile.";
	$array[12] = "Si vous detestez quelqu'un, ça indique probablement que vous ne l'aimez pas.";
	$array[13] = "Quand vous avez soif, rien n'est meilleur que de boire liquide.";
	$array[14] = "En haut, il y a la barre de menus.";
	$array[15] = "Quand vous cliquez sur profil, vous allez sur la page profil.";
	$array[16] = "Quand vous vous déconnetez, vous êtes déconnectés.";
	$array[17] = "Vous êtes devant un écran.";
	$array[18] = "Vous êtes sur un site web.";
	$array[19] = "Quand vous cliquez sur messages, vous accedez à la partie message.";
	$array[20] = "Votre écran est sale.";
	//En ajouter plusieurs pour décrire les autres easter eggs
	echo "<script type=\"text/javascript\">alert(\"".$array[$random]."\"); </script>";
}

?>