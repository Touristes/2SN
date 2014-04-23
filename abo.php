<?php
include "sessionInit.php";

if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}

?>
<?php
include "sessionInit.php";
require_once "dataUser.php";
require_once "dataConnect.php";
require_once "dataSubscriber.php";
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css" />

<meta charset="UTF-8">
<title>2SN - Abo</title>
</head>

<body>
<script>
$('#cssmenu').prepend('<div id="menu-button">Menu</div>');
	$('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
	</script>
    
    
<div id='cssmenu'>
<ul>
   <li class='active'><a href='accueil.php'><span>Home</span></a></li>
   <li class='last'><a href='#'><span>Messages</span></a></li>    
   <li><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Deconnexion</span></a></li>
</ul>
</div>




<div id="sidebarl">


<?


if(isset($_POST['requete']) && $_POST['requete'] != NULL) // on vérifie d'abord l'existence du POST et aussi si la requete n'est pas vide.
{

$requete = htmlspecialchars($_POST['requete']); // on crée une variable $requete pour faciliter l'écriture de la requête SQL, mais aussi pour empêcher les éventuels malins qui utiliseraient du PHP ou du JS, avec la fonction htmlspecialchars().

$result = SearchUser($requete);
if($result != "false") // si le nombre de résultats est supérieur à 0, on continue
{
	echo "<h3>Resultat de votre recherche :</h3></br>";
echo $result;

?>
<br/>
<br/>
<a href="abo.php">Faire une nouvelle recherche</a></p>
<?
} // Fini d'afficher les résultats ! Maintenant, nous allons afficher l'éventuelle erreur en cas d'échec de recherche et le formulaire.
else
{ // de nouveau, un peu de HTML
?>
<h3>Pas de résultats</h3>
<p>Nous n'avons trouvé aucun résultat pour votre requête "<? echo $_POST['requete']; ?>". <a href="abo.php">Réessayez</a> avec autre chose.</p>
<?
}// Fini d'afficher l'erreur ^^
}
else
{ // et voilà le formulaire, en HTML de nouveau !
?>
<p><h3>Vous pouvez rechercher un User particulier :</h3></p>
 <form action="abo.php" method="Post">
<input type="text" name="requete" size="20">
<input type="submit" value="Ok">
</form>
<?
}
// et voilà, c'est fini !
?>
<p><h3>Liste de tous les Users :</h3></p>
<?
$tab = getUserList();
foreach($tab as $val)
{
	echo $val . "</br>";
}
?>
</div>

<div id="sidebarr">
test


</div>

<div id="footer">


</div>
    
</body>
</html>
