<?php
include "./Resources/sessionInit.php";
require_once "./Controllers/frontControler.php";
require_once "./Models/chuck.php";
require_once "./Models/userProfilModel.php";
require_once "./Views/postView.php";

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
	<link rel="stylesheet" type="text/css" href="./Views/Styles/styleFoldingPanel.css"/>

	<meta charset="UTF-8">
	<title>[Why] - Accueil</title>
	<style>
.posts {
width: 80%;
text-align: center;
background-color: rgba(255,255,255,0.5);
}

#formVotes button{
position: relative;
right: -65%;
}

.posts .content {
  margin-top: -10%;
}

img.postImage {
position: relative;
margin-top: -10%;
max-width: 100%;
height: auto;
}                                                                                                                                                                                          

img.chuck {
max-width: 30%;
height: auto;
margin-left: 90%;
margin-top: -20%;
}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script> 
	$(document).ready(function(){
		$("#flip").click(function(){
			$("#post").slideDown("slow");
		});
	});
	</script>
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
				<li><a href='accueil.php'><img src="Views/Images/logo.png" width="50px;"></a></li> 
				<li class='active'><a href='accueil.php'><span>Home Sweet Home</span></a></li>
				<li><a href='abo.php'><span>Mes Abonnements</span></a></li>
				<li><a href='fileman/index.php'><span>Mon Partage</span></a></li> 
				<li><a href='messages.php'><span>Mes Messages Privés</span></a></li> 
				<li><a href='profil.php'><span>Mon Profil</span></a></li> 
				<li class='last'><a href='./Resources/deconnect.php'><span>Déconnexion</span></a></li>
			</ul>
		</div>

<div id="flip">Créer un nouveau post</div>
		<div id="post">
			<form id="signup" name="monform" method="post" action="Controllers/send_post.php"  enctype="multipart/form-data">
				<textarea cols="60" rows="1" name="title" placeholder="Titre" required></textarea>
				<textarea cols="60" rows="5" name="posts" placeholder="Ton info.." required></textarea>
				<div id="post1">
					Type:
					<select name="troll">
						<option value="news">News</option>
						<option selected value="troll">Troll</option>
					</select>
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
	if (isset($_POST['all']))
		$all = 1;
	else
		$all = 0;
?>
<form method="POST" action="acceuil.php"><input type="checkbox" name="all" onClik="this.form.submit();" />Afficher tous les posts</form>
	<?php
//Affichage des Posts images
	affPostImages($all);
	?>
</div>
<div id="gen">
<form method="POST" action="acceuil.php"><input type="checkbox" name="all" onClik="this.form.submit();" />Afficher tous les posts</form>
	<?php
    //Affichage des Posts Texte
	affPostText($all);
	?>
</div>
<div id="sidebarr">
<form method="POST" action="acceuil.php"><input type="checkbox" name="all" onClik="this.form.submit();" />Afficher tous les posts</form>
	<?php
  //Affichage des Posts Video
	affPostVideo($all);
	?>
</div>
</div>

<div id="cadrage-f">
	<div id="footer">
		<a href='contactForm.php'><span id="b-left">Contact</span></a>
		<a href='faq.php'><span id="b-middle">Faq</span></a>
		<a href='cgu.php'><span id="b-right">CGU</span></a>
	</div>
</div>
<div id="easteregg" style="width:10px; height:10px;"> 
	<?php nyanCat(); ?>
</div>
</body> 
</html>
