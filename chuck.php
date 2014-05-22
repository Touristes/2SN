<?php

function isChuckInThere($string) {
	if (preg_match_all("(chuck\snorris)",strtolower($string), $out) {
		return (true);
	}
	else
		return (false);
}

function affChuck() {
	echo "<img src=\"chuck_no.jpg\" />";
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
background-image: url('chuckBackground.jpg');
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
		background-image: url('sparta.jpg');
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
		background-image: url('southpark.jpg');
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
		background-image: url('starwars.jpg');
		}
		</style> ";
	echo "<script type=\"text/javascript\">alert(\"Use the force, luke.\"); </script>";
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
		background-image: url('simpsons.jpg');
		}
		</style> ";
	echo "<script type=\"text/javascript\">alert(\"Here take a duff !\"); </script>";
	echo "<script type=\"text/javascript\">alert(\"D'oh !\"); </script>";
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

?>