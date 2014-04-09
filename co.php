
<?php
session_start();
require_once "dataUser.php";
if (isset($_POST['login']))
{
$password = $_POST['pass'];
$login = $_POST['login'];

$test = userConnect($login, $password);


if ($test == "true")
{
	session_start();
	$_SESSION['login'] = $login;
	$_SESSION['check'] = "1";
	echo "<script type=\"text/javascript\">alert(\"Connexion reussie !!\");location =\"acc.php\"</script>";

}
else if ($test == "false")
{
echo '<script language="Javascript">
alert ("Login ou mot de passe inconnus !" )
</script>';
}
}
?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta charset="UTF-8">
<title>2SN Connexion</title>
</head>
<body>
<SCRIPT language="javascript">
   function ValiderMail(formulaire) {
      if (formulaire.mail.value.indexOf("@",0)<0) {alert("Adresse mail saisie invalide.\n")}
     else if (formulaire.pseudo.value == "") {alert("Pseudo saisi invalide.\n")}
	 else if (formulaire.pass.value == "") {alert("Mot de passe saisi invalide.\n")}
	  else {
         formulaire.submit()
      }
   }
    function ValiderMail1(formulaire1) {
 	if (formulaire1.login.value == "") {alert("Pseudo saisi invalide.\n")}
	 else if (formulaire1.pass.value == "") {alert("Mot de passe saisi invalide.\n")}
	  else {
         formulaire1.submit()
      }
   }
</SCRIPT>
<div id="connect">
<form id="signup" name="formulaire1" method="post" action="">
    <input type="email" placeholder="Login" name="login" required>
    <input type="password" placeholder="Mot de passe" name="pass" required>
    <button type="button" onClick="ValiderMail1(this.form)">Connexion</button>    
</form>

</div>
<div id="inscription">
Nouveau sur 2SN ?</br></br>
<form id="signup" name="monform" method="post" action="traite.php">
    <input type="email" placeholder="john.doe@email.com" name="mail" required>
    <input type="text" placeholder="Choisis ton pseudo !" name="pseudo" required>                  
    <input type="password" placeholder="Choisis ton mot de passe !" name="pass" required>
    <button type="button" onClick="ValiderMail(this.form)">Inscris toi !</button>    
</form>
</div>


<div id="presentation">
</div>
<div id="footer">

</div>
</body>
</html>
