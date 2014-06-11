<?php
include "./Resources/sessionInit.php";

if (!isset($_SESSION['check']))
{
  echo "<script type=\"text/javascript\">alert(\"Accès interdit !!\");location =\"co.php\"</script>";
}
else if ($_SESSION['check'] != "1")
{
  echo "<script type=\"text/javascript\">alert(\"Accès interdit !!\");location =\"co.php\"</script>";
}

?>
<?php
require_once "./Models/chuck.php";
require_once "Controllers/frontControler.php";
require_once "Views/postView.php";
require_once "./Controllers/profilController.php";
?>
<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="./Views/Styles/style3.css" />
  <link rel="stylesheet" type="text/css" href="./Views/Styles/styleFooter.css"/>
  <link rel="stylesheet" type="text/css" href="./Views/Styles/styleChart.css"/>
  <link rel="stylesheet" type="text/css" href="./Views/Styles/styleProfil.css"/>

  <meta charset="UTF-8">
  <title>[Why] - Profil</title>
</head>

<body>
  <script src='Modules/Chart-js/Chart.min.js'></script>
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
      <li><a href='accueil.php'><span>Home Sweet Home</span></a></li>
      <li><a href='abo.php'><span>Mes Abonnements</span></a></li>
      <li><a href='fileman/index.php'><span>Mon Partage</span></a></li> 
      <li><a href='messages.php'><span>Mes Messages Privés</span></a></li> 
      <li class='active'><a href='profil.php'><span>Mon Profil</span></a></li> 
      <li class='last'><a href='./Resources/deconnect.php'><span>Déconnexion</span></a></li>
    </ul>
  </div>

  <div id="sidebarl">
    <?php
    profilController();
    ?>

  </div>

  <div id="sidebarr">
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
    echo "<div class=\"theribbon1\">Tes stats de publication:</div><br>";
    ?>
    <div id="statInfo">
      <p>Ton compte a été créé le <?php echo getUserCreationDate($id); ?></p>
      <p>Depuis la création du compte, tu as :</p>
      <ul>
        <li><?php echo $dailyNews; ?> post(s) élus Actu du jour.</li>
        <li><?php echo $trollPosts; ?> post(s) <a id="green">Troll</a> vs <?php echo $newsPosts; ?> post(s) <a id="blue">Actus</a> :</li>
        <canvas id="pNbr1" width="300" height="200"></canvas>
        <li><?php echo $textPosts; ?> post(s) <a id="orange">Texte</a>, <?php echo $picturePosts; ?> post(s) <a id="white">Image</a> et <?php echo $videoPosts; ?> post(s) <a id="purple">Vidéo</a></li>
        <canvas id="pNbr2" width="300" height="200"></canvas>
        <li>partagé <?php echo $sharedFiles; ?> fichier(s)</li>
        <li>envoyé <?php echo $sentPrivateMsg; ?> et reçu <?php echo $receivedPrivateMsg; ?> message(s) perso(s)</li>
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
  <div id="cadrage-f">
   <div id="footer">
    <a href='contactForm.php'><span id="b-left">Contact</span></a>
    <a href='faq.php'><span id="b-middle">Faq</span></a>
    <a href='cgu.php'><span id="b-right">CGU</span></a>
  </div>
</div>
</body>
<?php nyanCat(); ?>
</html>
