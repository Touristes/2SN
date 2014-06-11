<?php
chdir("../");
include "./Resources/sessionInit.php";
$_SESSION['check'] = "0";
include "./Resources/sessionDestroy.php";
echo "<script type=\"text/javascript\">alert(\"Tu es maintenant déconnecté !!\");location =\"../co.php\"</script>";
?>
