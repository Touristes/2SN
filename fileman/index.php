<?php include "./Resources/sessionInit.php"; ?>
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
	            <li><a href='accueil.php'><img src="../Views/Images/logo.png" width="50px;"></a></li> 
					<li class='active'><a href='../../accueil.php'><span>Home</span></a></li>
					<li ><a href='../../messages.php'><span>Messages</span></a></li> 
					<li><a href='../../profil.php'><span>Mon Profil</span></a></li>
					<li><a href='../../abo.php'><span>Abonnements</span></a></li>
					<li><a href='index.php'><span>Fileman</span></a></li>
					<li class='last'><a href='./Resources/deconnect.php'><span>Déconnexion</span></a>
				</li>
			</ul>
		</div>
	<div>
	<div class="row">
		<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
				<div class="form-group" id="rep">
    			<label class="sr-only" for="">Repertoire</label>
    			<input id="rep_name" type="text" class="form-control" placeholder="Default">
  				</div>
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
	<div class="row">
			<div id="allfile" class="col-md-3">
				allfile
			</div>
			<div id="sharedfile" class="col-md-3">
				sharedfile
			</div>
			<div id="downloadedfile" class="col-md-3">
				downloadedfile
			</div>
	</div>
		<footer >
			
        </footer>
        
		<!-- JavaScript Includes -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
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