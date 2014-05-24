<?php
//Liste des extensions interdites
$not_allowed 	= array('sh', 'batch', 'sh', 'exe', 'bat', 'pif', 'src', 'reg', 'php', 'c', 'exe');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(in_array(strtolower($extension), $not_allowed)){
		echo '{"status":"error"}';
		exit;
	}
	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
		echo '{"status":"success"}';
		exit;
	}
}
echo '{"status":"error"}';
exit;