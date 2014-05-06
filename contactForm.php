<?php
require_once "dataRef.php";
include "sessionInit.php";
?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style1.css" />
<meta charset="UTF-8">
<title>[Why] - Contact</title>
</head>
<body>
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
			<li><option value="default" disabled>SÃ©lectionne l'objet de ton message</option></li>
			<li><option value="connexion_pb">ProblÃ¨me de connexion</option></li>
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
</body>
</html>


<?php

if (!empty($_POST)){

	$to = "lotzer_a@etna-alternance.net";
	$subject = $_POST['objet'];
	$message = $_POST['message'];

	if (mail($to, $subject, $message))
		echo "<p>Ton e-mail a peut-Ãªtre Ã©tÃ© envoyÃ© !</p>";
	else
		echo "<p>On dirait que ton mail n'est pas parti...</p>";
}

?>
