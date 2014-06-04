<?php
include "./Resources/sessionInit.php";
require_once "./Models/userProfilModel.php";
require_once "./Controllers/frontControler.php";
require_once "./Models/chuck.php";
require_once "./Views/postView.php";

//Test si l'utilisateur sest connecté
if (!isset($_SESSION['check']))
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
}
if (isUsernameExist($_POST['loginProfilView']) == false) {
  echo "<SCRIPT LANGUAGE=\"JavaScript\">document.location.href=\"accueil.php\"</SCRIPT>";
}
$login = $_POST['loginProfilView'];
if ($login == $_SESSION['login']) {
  echo "<SCRIPT LANGUAGE=\"JavaScript\">document.location.href=\"profil.php\"</SCRIPT>";
}
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./Views/Styles/style3.css" />
<link rel="stylesheet" type="text/css" href="./Views/Styles/styleProfilView.css" />
<link rel="stylesheet" type="text/css" href="./Views/Styles/styleFooter.css" />
<link rel="stylesheet" type="text/css" href="./Views/Styles/styleChart.css" />

<meta charset="UTF-8">
  <title>[Why] - <?php echo $login ?></title>
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
<?php //Menu ?>
<div id='cssmenu'>
<ul>
    <li ><a href='accueil.php'><img src="Views/Images/logo.png" width="50px;"></a></li> 
   <li class='last'><a href='accueil.php'><span>Home</span></a></li>
   <li><a href='messages.php'><span>Messages</span></a></li>    
   <li class='last'><a href='profil.php'><span>Mon Profil</span></a></li>
   <li><a href='abo.php'><span>Abonnements</span></a></li>
   <li class='last'><a href='./Resources/deconnect.php'><span>Déconnexion</span></a></li>
</ul>
</div>




<div id="sidebarl">
<?php
	//Traitement formulaire abonnement
	//Abonnement
	  if (isset($_POST['Subscribe'])) {
	addSubscription(getUserID($_SESSION['login']), getUserID($login));
	}
	//Désabonnement
	  else if (isset($_POST['Unsubscribe'])) {
	delSubscription(getUserID($_SESSION['login']), getUserID($login));
	}
	//Supression de compte si admin
          else if (isset($_POST['delAccount']) && (isUserAdmin(getUserID($_SESSION['login'])) == true)) {
	    if (md5($_POST['rootPassword']) == getUserInfo("password", getUserID($_SESSION['login']))) {
	      delUser(getUserID($login));
	      echo "<script type=\"text/javascript\">alert(\"Le compte a ete suprime !\");document.location.href=\"accueil.php\"</script>";
	    }
	    else {
	      echo "<script type=\"text/javascript\">alert(\"Mauvais mot de passe !\");\"</script>";
		}
	}
	//Supression de post si admin
	  else if (isset($_POST['delPost']) && (isUserAdmin(getUserID($_SESSION['login'])) == true)) {
	    delPost($_POST['delPost']);
	  }
    //Informations utilisateur
    $id = getUserID($login);
    echo "Profil de l'utilisateur ".$login."<br>"
    ."Nombre d'abonnes : ".getSubscriberNumber($id)."<br>"
    ."Nombre d'abonnements : ".getSubscriptionNumber($id)."<br>";
	//Formulaire d'envoi de message, renvoie vers message.php
    echo "<form id=\"formNewMessage\" method=\"POST\" action=\"messages.php\"><button type=\"submit\" value=\""
    .$login."\" name=\"newMessage\">Envoyer un message</button></form>";
	//Bouton abonnement ou désabonnement
	if (isSubrscriberOf(getUserID($_SESSION['login']), getUserID($login)) == "false") {
		echo "<form id=\"formSubscribe\" method=\"POST\" action=\"profilView.php\">"
			."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
			."<button type=\"submit\" value=\"Subscribe\" name=\"Subscribe\">S'abonner</button></form>";
			}
	else {
		echo "<form id=\"formUnsubscribe\" method=\"POST\" action=\"profilView.php\">"
			."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
			."<button type=\"submit\" value=\"Unsubscribe\" name=\"Unsubscribe\">Se désabonner</button></form>";
			}
	//Bouton supression de compte accessible uniquement a l admin
if (isUserAdmin(getUserID($_SESSION['login'])) == true) {
                echo "<form id=\"formDelAccount\" method=\"POST\" action=\"profilView.php\">"
                        ."<input type=\"hidden\" name=\"loginProfilView\" value=\"".$login."\">"
		  ."<button id=\"deletingAccount\" type=\"submit\""
		  ."value=\"delAccount\" name=\"delAccount\">Supprimer le compte</button>"
                  ."<p id=\"passwordConfirm\"> Confirmez par mot de passe : "
		  ."<input type=\"password\" name=\"rootPassword\" required /></p>"
                  ."<br><br><br></form>";
}
?>
<br>
<div id="affstat">
  <?php
  $creationDate = getUserCreationDate($id);
$totalPosts = getUserTotalPostText($id);
$trollPosts = getUserTotalPostTroll($id);
$newsPosts = getUserTotalPostActu($id);
$picturePosts = getUserTotalPostImage($id);
$videoPosts = getUserTotalPostVideo($id);
$textPosts = getUserTotalPostText($id);
$dailyNews = getUserTotalNewsDuJour($id);
$sharedFiles = getUserTotalSharedFiles($id);
$sentPrivateMsg = getUserTotalPrivateMessageSends($id);
$receivedPrivateMsg = getUserTotalPrivateMessageReceives($id);
echo "<div class=\"theribbon1\">Voici la liste de ses stats :</div><br>";
  ?>
  <div id="statInfo">
  <p>Compte créé le <?php echo getUserCreationDate($id); ?></p>
  <p>Depuis la création du compte, tu as :</p>
    <ul>
  <li><?php echo $dailyNews; ?> posts élus Actu du jour.</li>
  <li>XX posts <a id="green">Troll</a> vs XX posts <a id="blue">Actus</a> :</li>
      <canvas id="pNbr1" width="300" height="200"></canvas>
  <li>XX posts <a id="orange">Texte</a>, XX posts <a id="white">Image</a> et XX posts <a id="purple">Vidéo</a></li>
      <canvas id="pNbr2" width="300" height="200"></canvas>
  <li>partagé <?php echo $sharedFiles; ?> fichiers</li>
  <li>envoyé <?php echo $sentPrivateMsg; ?> et reçu <?php echo $receivedPrivateMsg; ?> messages persos</li>
  </ul>

  <script>       
  var totalPosts = '<?php echo $totalPosts;?>';
var trollPosts = '<?php echo $trollPosts;?>';
var newsPosts = '<?php echo $newsPosts;?>';
var picturePosts = '<?php echo $picturePosts;?>';
var videoPosts = '<?php echo $videoPosts;?>';
var textPosts = '<?php echo $textPosts;?>';
var dailyNews = '<?php echo $dailyNews;?>';
var sharedFiles = '<?php echo $sharedFiles;?>';
var sentPrivateMsg = '<?php echo $sentPrivateMsg;?>';
var receivedPrivateMsg = '<?php echo $receivedPrivateMsg;?>';

  var pNbr1Data = [
		   {
		   value : trollPosts*10,
		   color : "#84dc84"
		   },
		   {
		   value : newsPosts*10,
		   color : "#69D2E7"
		   }     
  ]
  var pNbr2Data = [
		   {
		   value: picturePosts*10,
		   color:"#F38630"
		   },
		   {
		   value : videoPosts*10,
		   color : "#E0E4CC"
		   },
		   {
		   value : textPosts*10,
		   color : "#bf7fbf"
		   }     
  ]
    var options = {
  segmentShowStroke : false,
  animateScale : true
  }
    var pNbr1 = document.getElementById('pNbr1').getContext('2d');
new Chart(pNbr1).Doughnut(pNbr1Data,options);
		var pNbr2 = document.getElementById('pNbr2').getContext('2d');
new Chart(pNbr2).Doughnut(pNbr2Data,options);
  </script>
</div>
</div>
</div>
<div id="sidebarr">
      <?php
      //Affichage des Posts
  affAllPost($id);
	  ?>
</div>

<div id="cadrage-f">
        <div id="footer">
                <a href='contactForm.php'><span id="b-left">Contact</span></a>
                <a href='faq.php'><span id="b-middle">Faq</span></a>
                <a href='co.php'><span id="b-right">Inscription</span></a>
        </div>
</div>
</body>
</html>
