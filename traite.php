<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta charset="UTF-8">
<title>2SN Inscription</title>
</head>

<SCRIPT language="javascript">
   function ValiderMail(formulaire) {
     if (formulaire.mail.value.indexOf("@",0)<0) {alert("Adresse mail saisie invalide.\n")}
     else if (formulaire.pseudo1.value == "") {alert("Pseudo saisi invalide.\n")}
	 else if (formulaire.pass.value == "") {alert("Mot de passe saisi invalide.\n")}
	 else if (!formulaire.conditions.checked) {alert("Tu dois accepter les conditions.\n")}
	 else if (formulaire.pass.value == formulaire.pass1.value) {formulaire.submit()}
	 else { alert("Mot de passe de confirmation invalide.\n")}
   }
</SCRIPT>

<div id="final">
<center><font size="15">Rejoins 2SN aujourd'hui !</font></center></br></br>
<form id="signup" name="monform" method="post" action="">
    <input type="email" placeholder="john.doe@email.com" name="mail" value="<?php echo $_POST['mail'] ?>" required></br></br>
    <input type="text" placeholder="Choisis ton pseudo !" name="pseudo1" value="<?php echo $_POST['pseudo'] ?>"required></br></br>        
    <input type="password" placeholder="Choisis ton mot de passe !" name="pass" value="<?php echo $_POST['pass'] ?>" required></br></br>
    <input type="password" placeholder="Confirme ton mot de passe !" name="pass1" required></br></br>
	<input type="checkbox" name="conditions" value="ok"/> J'accepte les conditions.
    <button type="button" onClick="ValiderMail(this.form)">Creer mon compte</button>    
</form>

<?php

require_once "dataUser.php";
if (isset($_POST['pseudo1']))
{
$password = $_POST['pass'];
$email = $_POST['mail'];
$login = $_POST['pseudo1'];

$test = isUsernameExist($login);
$test1 = isEmailExist($email);

if ($test == FALSE && $test1 == FALSE)
{
	addUser($login, $email, $password);
	include "sessionInit.php";
	$_SESSION['login'] = $login;
	$_SESSION['check'] = "1";
	echo "<script type=\"text/javascript\">alert(\"Compte cree avec succes !!\");location =\"accueil.php\"</script>";

}
else if ($test == TRUE)
{
echo '<script language="Javascript">
alert ("Ce pseudo existe deja !" )
</script>';
}
else if ($test1 == TRUE)
{
echo '<script language="Javascript">
alert ("Cette email existe deja !" )
</script>';		
}
}
?>

</div>
<body>
</body>
</html>
