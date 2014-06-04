<?php

//Liste des extensions interdites
$not_allowed = array('ksh', 'sh', 'batch', 'exe', 'bat', 'pif', 'src', 'reg', 'php', 'c', 'exe', 'rpm', 'deb');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(in_array(strtolower($extension), $not_allowed)){
		echo '{"status":"error_2"}';
		exit;
	}
	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
		echo '{"status":"success"}';
		exit;
	}
}
echo '{"status":"error_1"}';

exit;
