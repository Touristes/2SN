<?php
include "./Resources/sessionInit.php";
require_once "./Controllers/frontControler.php";
if (isset($_POST['login']))
{
  $password = $_POST['pass'];
  $login = $_POST['login'];

  $test = userConnect($login, $password);


  if ($test == TRUE)
  {
   session_start();
   $_SESSION['login'] = $login;
   $_SESSION['check'] = "1";
   echo "<script type=\"text/javascript\">alert(\"Connexion réussie !!\");location =\"accueil.php\"</script>";

 }
 else if ($test == FALSE)
 {
  echo '<script language="Javascript">
  alert ("Login ou mot de passe inconnus !" )
  </script>';
  $_SESSION['fail'] = 1;
}
}
?>

<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="./Views/Styles/style.css" />
  <meta charset="UTF-8">
  <title>[Why] - Connexion</title>
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
         <div id="inline">
       <div id="connect">
        <form id="signup" name="formulaire1" method="post" action="">
          <input type="email" placeholder="Login" name="login" required style="width:90%;">
          <input type="password" placeholder="Mot de passe" name="pass" required style="width:90%;">
          <button type="button" onClick="ValiderMail1(this.form)">Connexion</button>    
        </form>
      </div>
      <div id="reset">
        <?php if ($_SESSION['fail'] == 1) echo "<a href=\"reinitPassword.php\">Vous avez oublie votre mot de passe ?</a>"; $_SESSION['fail'] = 0;?></div>
        <div id="inscription">
          Nouveau sur [Why] ?</br></br>
          <form id="signup" name="monform" method="post" action="traite.php">
            <input type="email" placeholder="john.doe@email.com" name="mail" required style="width:90%;">
            <input type="text" placeholder="Choisis ton pseudo !" name="pseudo" required style="width:90%;">                  
            <input type="password" placeholder="Choisis ton mot de passe !" name="pass" required style="width:90%;">
            <button type="button" onClick="ValiderMail(this.form)">Inscris-toi !</button>    
          </form>
        </div>
</div>
        <div id="presentation">
                <div id="imgpres"><img src="Views/Images/logo.png" width="410px"></div>

       <h3> Bienvenue sur [Why], le réseau social pour les geeks, par des geeks !</h3>

<p>[Why] est né de l'envie de partage de cinq passionnés d'informatique.</p> 
<p>Déçus par les solutions existantes trop axées sur le voyeurisme et la collecte/revente des informations personnelles des utilisateurs, ils ont créé un réseau social entièrement dédié au partage d'actualités high-tech entre utilisateurs ainsi qu'au partage de fichiers en tout genre.</p>
<p>Sur [Why], pas de photos du repas de votre collègue de boulot ni d'échographie de votre voisine ; de l'info, seulement de l'info, rien que de l'info. Et c'est vous, utilisateurs, qui votez pour l'info la plus pertinente du jour, affichée en tête de page pendant 24h !</p>
<p>En plus, [Why] respecte votre vie privée : nous ne collectons aucune donnée sur vous et effaçons vos billets dès 7 jours d'existence. Focus sur l'actualité !</p>

<p>Alors, c'est pas cool ?</p>

        </div>
      </body>
      </html>
