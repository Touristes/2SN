<?php
include "sessionInit.php";
require_once "./Controllers/frontControler.php";
require_once "chuck.php";
require_once "./Models/userProfilModel.php";

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
	<link rel="stylesheet" type="text/css" href="./Views/Styles/style1.css" />
	<link rel="stylesheet" type="text/css" href="./Views/Styles/styleFooter.css"/>

	<meta charset="UTF-8">
	<title>[Why] - Accueil</title>
<style>
  img.postImage {
  max-width: 100%;
hight: auto;
}
img.chuck {
  max-width: 12%;
hight: auto;
}
</style>
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
				<li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
			</ul>
		</div>
		<div id="post">
			<form id="signup" name="monform" method="post" action="send_post.php"  enctype="multipart/form-data">
				<textarea cols="60" rows="1" name="title" placeholder="title" required></textarea>
				<textarea cols="60" rows="5" name="posts" required></textarea>
				<div id="post1">
					Type:
					<select name="troll">
						<option value="news">News</option>
						<option selected value="troll">Troll</option>
					</select>
					Tags: -- 
					Ajouter un fichier: 
					<div id="fichier">
						<input type="file" name="file"/>
					</div>
				</div>
	 <?php /* <div id="post1">
	  <input type="text" placeholder="Ajoute un lien" name="mail"   required>
	</div>*/ ?>
	<button type="submit">Post !</button>
</form>
</div>

<div id="sidebarl">
  <?php
//Affichage des Posts images
$post = getPostsByCategory("Picture");
if ($post != false)
for ($i = 0; isset($post[1][$i]); $i++)
  {
      echo "<b>".$post[1][$i]."</b><br>";
      controlerPictureDisplay($post[0][$i]);
      echo "<br>";
      echo "| ".$post[3][$i]."<br>";
      //echo "Tags : ".$post[5][$i]."<br>";
      echo "<small>Publie le ".$post[7][$i]."</small><br>";
      echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
      if (isChuckInThere($post[3][$i]))
	affChuck();
      else if ($post[6][$i] == 1)
	addTrollPic();
      echo "<br>";
    }
  ?>
</div>
<div id="gen">
  <?php
  //Affichage des Posts Video
  $post = getPostsByCategory("Video");
if ($post != false)
  for ($i = 0; isset($post[1][$i]); $i++)
    {
	echo "<b>".$post[1][$i]."</b><br>";
	affVideo($post[0][$i]);
	echo "<br>";
	echo "| ".$post[3][$i]."<br>";
	//echo "Tags : ".$post[5][$i]."<br>";
	echo "<small>Publie le ".$post[7][$i]."</small><br>";
	echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
	if (isChuckInThere($post[3][$i]))
	  affChuck();
	else if ($post[6][$i] == 1)
	  addTrollPic();
	echo "<br>";
      }
?>
</div>
<div id="sidebarr">
<?php
    //Affichage des Posts Texte
    $post = getPostsByCategory("Text");
if ($post != false)
for ($i = 0; isset($post[1][$i]); $i++)
  {
    echo "<b>".$post[1][$i]."</b><br>";
    echo "| ".$post[3][$i]."<br>";
    //echo "Tags : ".$post[5][$i]."<br>";
    echo "<small>Publie le ".$post[7][$i]."</small><br>";
    echo profilLinkForm(getUserInfo("login", $post[2][$i]))."<br>";
    if (isChuckInThere($post[3][$i]))
      affChuck();
    else if ($post[6][$i] == 1)
      addTrollPic();
    echo "<br>";
  }
?>
</div>
</div>

<div id="footer">
	<a href='contactForm.php'><span id="b-left">Contact</span></a>
	<a href='faq.php'><span id="b-middle">Faq</span></a>
	<a href='co.php'><span id="b-right">Inscription</span></a>
</div>
</div>
</body>
  <?php nyanCat(); ?>
</html>
