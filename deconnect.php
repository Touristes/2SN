<?php
include "./Resources/sessionInit.php";
	$_SESSION['check'] = "0";
	include "./Resources/sessionDestroy.php";
	echo "<script type=\"text/javascript\">alert(\"Vous êtes déconnecté !!\");location =\"co.php\"</script>";
?>
