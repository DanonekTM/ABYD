var processingLink = false;

function abyd() 
{
	var link = $("#link").val();
	var error = document.getElementById("error");
	
	if (!processingLink)
	{
		if (checkYoutubeLink(link))
		{
			hideError();
			document.getElementById("title-section").style.display = "none";
			document.getElementById("dl-section").style.display = "none";
			sendABYDRequest(checkYoutubeLink(link), link);
			document.getElementById("message").style.display = "block";
			document.getElementById("dl-progress").style.display = "block";
		}
		else
		{
			hideMessage();
			document.getElementById("title-section").style.display = "none";
			document.getElementById("dl-section").style.display = "none";
			document.getElementById("error").style.display = "block";
			error.innerHTML = "<strong>Error!</strong> Invalid Link!";
		}
	}
	return false;
}

function hideError()
{
	if (document.getElementById("error").style.display == "block")
	{
		document.getElementById("error").style.display = "none";
	}
}

function hideMessage()
{
	if (document.getElementById("message").style.display == "block")
	{
		document.getElementById("message").style.display = "none";
	}
}

function checkYoutubeLink(link)
{
	var isYtLinkReg = link.match(/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/i);

	if (isYtLinkReg)
	{
		return isYtLinkReg[1];
	}
	return false;
}

function sendABYDRequest(id, link)
{
	processingLink = true;

	$.ajax
	({
		type: 'POST',
		url: '/abyd',
		data: {
			id : id,
			link : link
		},
		dataType: "json",

		success:function(response)
		{
			if (response['reply'] == "OK")
			{
				document.getElementById("dl-progress").style.display = "none";
				document.getElementById("title-section").style.display = "block";
				document.getElementById("yt_title").textContent = response['title'];

				document.getElementById("dl-link-btn").href = response['path'];
				document.getElementById("dl-link-btn").download = response['title'];
				document.getElementById("dl-section").style.display = "block";
				processingLink = false;
			}
			else
			{
				hideMessage();
				document.getElementById("error").style.display = "block";
				if (!response['info'])
				{
					error.innerHTML = "<strong>Error!</strong> Something went wrong :/";
				}
				else
				{
					error.innerHTML = "<strong>Error!</strong> " + response['info'];
				}
				processingLink = false;
			}
		},
		error:function()
		{
			hideMessage();
			document.getElementById("error").style.display = "block";
			error.innerHTML = "<strong>Error!</strong> Unauthorized.";
			processingLink = false;
		}
	});
}