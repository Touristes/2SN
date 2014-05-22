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
?>