$(document).ready(function () 
{
	console.log('mekong');
	tbname = "BONJOUR";																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																				
	$.post('../../models/display_file.php', {tablename: tbname}, function(data) 
			{
				$('#allfile').append(data);
	})
});