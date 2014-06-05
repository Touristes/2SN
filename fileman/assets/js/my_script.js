$(document).ready(function () 
{
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