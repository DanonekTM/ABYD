function doLogin() 
{
	var loginField = $("#login").val();
	var passwordField = $("#password").val();
	var error = document.getElementById("error");
	
	if (loginField !== "" && passwordField !== "")
	{
		$.ajax
		({
			type: 'POST',
			url: '/login',
			data: {
				verifyLogin : "verifyLogin",
				login : loginField,
				password : passwordField
			},
			
			success:function(response)
			{
				if (response == "OK")
				{
					window.location.replace("/");
				}
				else
				{
					document.getElementById("error").style.display = "block";
					error.innerHTML = "<strong>Error!</strong> Your credentials are invalid!"
				}
			}
		});
	}
	else
	{
		document.getElementById("error").style.display = "block";
		error.innerHTML = "<strong>Error!</strong> Login credentials can't be empty!"
	}
	return false;
}