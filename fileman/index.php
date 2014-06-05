<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Why - fileman</title>
		<!-- Google web fonts -->
		<!-- <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' /> -->
		<!-- Bootstrap -->
		<link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet" />
		<script src="assets/bootstrap/js/bootstrap.js"></script>
		<!-- The main CSS file -->
		<link href="assets/css/style.css" rel="stylesheet" />
	</head>
	<body>
	<?php include "./Resources/sessionInit.php"; ?>
  	<hr>
		<ul class="nav nav-pills">
  			<li class="active"><a id="btn-retour-maison" href="#"> Revenir à ma maison </a></li>
  			<li><div id="info"></div></li>
  			<a class="navbar-text navbar-right" href="#" id="who"> login en </a>
		</ul>
	</hr>
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