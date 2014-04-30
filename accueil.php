<?php
include "sessionInit.php";
include "dataRef.php";

if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}

?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style1.css" />

<meta charset="UTF-8">
<title>2SN - Accueil</title>
</head>

<body>
<div id="cadrage">
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
   <li ><a href='messages.php'><span>Messages</span></a></li> 
   <li><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Deconnexion</span></a></li>
</ul>
</div>
	  <div id="post">
	  <form id="signup" name="monform" method="post" action="send_post.php">
	  <textarea clos="60" rows="1" name="title" placeholder="title" required></textarea>
	  <textarea cols="60" rows="5" name="posts" required></textarea>
	  <div id="post1">
	  <p>
	  Tags: 
	  <input type="checkbox" name="actus"/><label for="actus">actualité</label>
	  <input type="checkbox" name="tuto"/><label for="tuto">tutoriel</label>
	  <input type="checkbox" name="troll"/><label for="troll">troll</label>
	  </p>
	  <input type="file" name="file"/>
	  </div>
	 <?php /* <div id="post1">
	  <input type="text" placeholder="Ajoute un lien" name="mail"   required>
	  </div>*/ ?>
	  <button type="submit">Post !</button>
	  </form>
</div>

<div id="sidebarl">
test


</div>
<div id="gen">
<?php
$post = showAllPost();

for ($i = 0 ; $post[0][$i] ; $i++)
  {
	echo "<div id='post'>";
	echo $post[1][$i];
	echo " Par id utilisateur : ";
	echo $post[2][$i];
	echo "</br>";
	echo $post[3][$i];
	echo "<br/>";
	echo "</div>";
	echo"<br/>";
  }

?>

</div>
<div id="sidebarr">
test

</div>

<div id="footer1">


</div>
 </div>
</body>
</html>
