<?php 
include "../Resources/sessionInit.php"; 
	if (!isset($_SESSION['check'])) {
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
	}
	else if ($_SESSION['check'] != "1") {
		echo "<script type=\"text/javascript\">alert(\"Acces interdit !!\");location =\"co.php\"</script>";
	}
	$login = $_SESSION['login'];
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Why - fileman</title>
		<!-- Bootstrap -->
		<link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet" />
		<script src="assets/bootstrap/js/bootstrap.js"></script>
		<!-- The main CSS file -->
		<link href="assets/css/filemanStyle.css" rel="stylesheet" />
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
	</head>
	<body>
	<div class="row" id="cadrage">
		<div id='cssmenu'>
			<ul>
	            <li><a href='../../accueil.php'><img src="../Views/Images/logo.png" width="50px;"></a></li> 
				<li><a href='../../accueil.php'><span>Home</span></a></li>
				<li><a href='../../messages.php'><span>Messages</span></a></li> 
				<li><a href='../../profil.php'><span>Mon Profil</span></a></li>
				<li><a href='../../abo.php'><span>Abonnements</span></a></li>
				<li><a class='active' href='index.php'><span>Fileman</span></a></li>
				<li class='last'><a href='../Resources/deconnect.php'><span>Déconnexion</span></a></li>
				<li><span id="login"><?php echo $login;?></span></li>
			</ul>
		</div>
	<div>
	<div class="row">
		<div id="info"></div>
		<div class="form-group col-md-2" id="rep">
			<input id="login-name" type="hidden" class="hidden" value="<?php echo $login;?>"></input>
  			<label class="sr-only" for="">Repertoire</label>
    		<input id="rep_name" type="text" class="form-control" placeholder="Default">
    		<a id="btn-create-rep">Creation repertoire</a>
    		
  		</div>
  		<div class="form-group col-md-2" id="select-rep"></div>
  		<div class="col-md-3">
			<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
					<div id="drop">
						Glisse tes fichiers
						<a id="btn-browse" >Parcourir</a>
						<input type="file" name="upl" id="upl" multiple />
					</div>
					<div id="uploaded">
						<ul>
						<!-- The file uploads will be shown here -->
						</ul>
					</div>
			</form>
		</div>
	</div>
	<div class="row">
			<div class="col-md-3">
				<h4>Mes fichiers uploadé</h4>
				<div class="row" id="allfile"></div>
			</div>
			<div class="col-md-4">
				<h4>Tes repertoire partagé avec tes amis</h4>
				<div class="row" id="sharedfile">jjdjdhjg</div>
			</div>
			<div id="downloadedfile" class="col-md-3">fichier partagé par tes amis</div>
	</div>
	<div class="row" id="cadrage-f">
		<div id="footer">
			<a href='../contactForm.php'><span id="b-left">Contact</span></a>
			<a href='../faq.php'><span id="b-middle">Faq</span></a>
			<a href='../cgu.php'><span id="b-right">CGU</span></a>
		</div>
	</div>
        
	<!-- JavaScript Includes -->
	<script src="assets/js/jquery.1.9.1.min.js"></script> 
	<script src="assets/js/jquery.knob.js"></script>

	<!-- jQuery File Upload Dependencies -->
	<script src="assets/js/jquery.ui.widget.js"></script>
	<script src="assets/js/jquery.iframe-transport.js"></script>
	<script src="assets/js/jquery.fileupload.js"></script>
		
	<!-- Our main JS file -->
	<script src="assets/js/my_script.js"></script>
	<script src="assets/js/script.js"></script>

	</body>

</html>