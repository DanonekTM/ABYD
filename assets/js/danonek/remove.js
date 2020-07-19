function remove(id) 
{
	removeRequest(id);
}

function removeRequest(id)
{
	$.ajax
	({
		type: 'POST',
		url: '/rm',
		data: {
			id : id,
		},
		
		success:function(response)
		{
			if (response == "OK")
			{
				document.getElementById("error").style.display = "none";
				document.getElementById(id).parentNode.removeChild(document.getElementById(id));
			}
			else
			{
				document.getElementById("error").style.display = "block";
				document.getElementById("error").innerHTML = "<strong>Error!</strong>";
			}
		}
	});
}