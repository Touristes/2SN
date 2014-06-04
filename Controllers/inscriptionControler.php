<?php
if (isset($_POST['pseudo1']))
{
$password = $_POST['pass'];
$email = $_POST['mail'];
$login = $_POST['pseudo1'];

$test = isUsernameExist($login);
$test1 = isEmailExist($email);

if ($test == false && $test1 == false)
{
	addUser($login, $email, $password);
	include "./Resources/sessionInit.php";
	$_SESSION['login'] = $login;
	$_SESSION['check'] = "1";
	echo "<script type=\"text/javascript\">alert(\"Compte créé avec succès !!\");location =\"accueil.php\"</script>";
}
else if ($test == true)
{
echo '<script language="Javascript">
alert ("Ce pseudo existe déjà !" )
</script>';
}
else if ($test1 == true)
{
echo '<script language="Javascript">
alert ("Cet email existe déjà !" )
</script>';
}
}
?>