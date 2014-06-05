<?php

//Liste des extensions interdites
$not_allowed = array('ksh', 'sh', 'batch', 'exe', 'bat', 'pif', 'src', 'reg', 'php', 'c', 'exe', 'rpm', 'deb');
$filename = str_replace(" ", "_", $_FILES['upl']['name']); 

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($filename, PATHINFO_EXTENSION);

	if(in_array(strtolower($extension), $not_allowed)){
		echo '{"status":"error_2"}';
		exit;
	}
	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$filename)){
		echo '{"status":"success"}';
		exit;
	}
}
echo '{"status":"exit_1"}';

exit;
