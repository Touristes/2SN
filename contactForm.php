<?php
require_once "dataRef.php";
include "sessionInit.php";
?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css" />
<meta charset="UTF-8">
<title>[Why] - Contact</title>
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
   <li class='last'><a href='accueil.php'><span>Home</span></a></li>
   <li><a href='messages.php'><span>Messages</span></a></li>    
   <li><a href='profil.php'><span>Mon Profil</span></a></li>
   <li class='active'><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='deconnect.php'><span>Déconnexion</span></a></li>
  
</ul>
</div>

</br>
</br>

<div>
	<p>Un <a href="faq.php">problème sans solution</a> ? Des suggestions à faire pour l'amélioration de [Why] ? Ou peut-être souhaites-tu simplement nous déclamer ton amour d'une prose enflammée (en vers, on accepte aussi !) ? N'hésites pas à nous écrire, ton message sera lu !</p>
</div>

	<form action="contactForm.php" method="post">
		<ul>
			<?php var_dump($_SESSION); ?>
			<?php var_dump(getUserInfo("login", getUserID($_SESSION['login']))); ?>
<?php if ($_SESSION['check'] == "1"): ?>

			<li>Ton pseudo [Why]: <input type="text" name="pseudo" placeholder="ex: SuperWhyId" value="<?php echo getUserInfo("login", getUserID($_SESSION['login'])); ?>"></li>
			<li>Ton e-mail : <input type="text" name="e-mail" placeholder="ex: e@mail.why" value="<?php echo getUserInfo("email", getUserID($_SESSION['login'])); ?>"></li>
<?php else: ?>
			<li>Ton pseudo [Why]: <input type="text" name="pseudo" placeholder="ex: SuperWhyId"></li>
			<li>Ton e-mail : <input type="text" name="e-mail" placeholder="ex: e@mail.why"></li>
<?php endif; ?>
			<li><select required="required" name="objet" method="post" action=""></li>
			<li><option value="default" disabled>Sélectionne l'objet de ton message</option></li>
			<li><option value="connexion_pb">Problème de connexion</option></li>
			<li><option value="press">Contact presse</option></li>
			<li><option value="other">Autre</option></li>
			</select>
			<br><br>
			Ton message :
			<br>
			<textarea rows="10" cols="30" name="message" placeholder="Tape ton message ici !"></textarea>
			<br>
			<input type="submit" value="Envoyer">
		</ul>
	</form>

<div id="footer">


</div>
	
</body>
</html>


<?php

if (!empty($_POST)){

	$to = "lotzer_a@etna-alternance.net";
	$subject = $_POST['objet'];
	$message = $_POST['message'];

	if (mail($to, $subject, $message))
		echo "<p>Ton e-mail a peut-être été envoyé !</p>";
	else
		echo "<p>On dirait que ton mail n'est pas parti...</p>";
}

?>
