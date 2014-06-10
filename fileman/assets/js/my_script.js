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
				location.reload();
				$('#info').append(data);
		})
	})

	/*** Affiche les liste des fichier du user ***/	
	var session	= $('input#login-name').val();
	$.post('../fileman/models/display_file_user.php', {login: session}, function(data) 
	{
		$('#allfile').append(data);
	})

	/*** Affiche les liste des fichier que le user a décider de partagé ***/	
	var session	= $('input#login-name').val();
	$.post('../fileman/models/display_rep_shared.php', {login: session}, function(data) 
	{
		console.log('sharedrep');
		$('#sharedrep').append(data);
	})

	/*** Affiche les liste des fichier du user ***/	
	var session	= $('input#login-name').val();
	$.post('../fileman/models/list_rep_user.php', {login: session}, function(data) 
	{
		$('#select-rep').append(data);
	})


	/*** Supprimer un fichier onclick boutton ***/
	// $('#button-delete').on('click', function() 
	// {
	// 	$.post('../fileman/models/delete_file_user.php', {}, function(data) 
	// 	{
	// 		location.reload();
	// 		$('#info').append(data);
	// 	})
	// })

});