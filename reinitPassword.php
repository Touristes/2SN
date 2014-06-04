<?php
include "./Controllers/reinitPasswordControler.php";
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./Views/Styles/style.css" />
<meta charset="UTF-8">
  <title>[Why] - Réinitialisation de mot de passe</title>
</head>
<body>
<?php //Affichage du formulaire de renouvellement de mot de passe ?>
<div id="resetmdp">
  Si tu as perdu ou oublié ton mot de passe, saisis ton e-mail ci-dessous.
  Un nouveau mot de passe y sera envoyé.<br />
<form id="signup" name="reinitPassword" method="POST" action="reinitPassword.php">
<input type="email" placeholder="john.doe@email.com" name="mail" required>
  <button type="submit" value="Reinitialiser le mot de passe" name="reinitPassword">Réinitialiser mon mot de passe</button>
</form>
<br><a href="index.php">Retour vers la page de connexion.</a>
</div>
</body>
</html>
