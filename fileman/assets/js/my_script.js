$(document).ready(function () 
{
	/*** Creation d'un repertoire ******/
	$('#btn-create-rep').on('click', function() 
	{
		var nom_repo = $('input#rep_name').val();
		var session	= $('input#login-name').val();
		console.log(''+session);
		$.post('../fileman/models/createRepo.php', {repname: nom_repo, loginname: session}, function(data) 
		{
				$('#info').append(data);
		})
	})

	var session	= $('input#login-name').val();
	/*** Affiche les liste des fichier du user ***/	
	$.post('../fileman/models/display_file_user.php', {login: session}, function(data) 
	{
		$('#allfile').append(data);
	})

	var session	= $('input#login-name').val();
	/*** Affiche les liste des fichier du user ***/	
	$.post('../fileman/models/list_rep_user.php', {login: session}, function(data) 
	{
		$('#select-rep').append(data);
	})


	/*** Supprimer un fichier onclick boutton ***/
	$('#button-delete').on('click', function() 
	{
		var nom_fichier = $('select#select-dbname option:selected').text();
		$.post('../fileman/models/deleteFileUser.php', {filename: nom_fichier}, function(data) 
		{
			$('#info').append(data);
		})
	})

});