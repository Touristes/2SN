$(document).ready(function () 
{
	/*** Creation d'un repertoire ******/
	$('#btn-create-rep').on('click', function() 
	{
		alert ('toto');
		var nom_repo = $('input#rep_name').text();
		$.post('../fileman/controllers/c_createRepo.php', {repname: nom_repo}, function(data) 
		{
				$('#info').append(data);
		})
	})
	/*** Affiche les liste des fichier du user ***/	
	$.post('../fileman/models/display_file.php', {}, function(data) 
	{
		$('#allfile').append(data);
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