<?php
session_start();
	$_SESSION['check'] = "0";
	include "sessionDestroy.php";
	echo "<script type=\"text/javascript\">alert(\"Vous etes deconnecte !!\");location =\"co.php\"</script>";
?>
