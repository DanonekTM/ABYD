<?php
if (!defined("SELF_CALLED"))
{
	die("Not configured");
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Youtube Downloader :: Login</title>
		<link rel="stylesheet" href="/assets/css/fa-all.min.css">
		<link rel="stylesheet" href="/assets/css/bootstrap.css">  
	</head>
	
	<body>
		<div class="bg-dark navbar-dark text-white">
			<div class="container">
				<nav class="navbar px-0 navbar-expand-lg navbar-dark">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a href="/" class="p-3 text-decoration-none text-light"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
						</div>
					</div>
				</nav>
			</div>
		</div>
  
		<div class="container py-5 mb5">
			<h1 class="mb-5">Authorized Area</h1>
			<div class="row py-4">
				<div class="col-md-12" id="form-container">
					<div class="ht-tm-element alert alert-danger" style="display: none; margin-bottom: 20px;" id="error"></div> 
					<form method="POST" onsubmit="return doLogin();">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="login">Login</label>
								<input type="text" class="form-control" id="login" name="login" placeholder="Login..">
							</div>
							<div class="col-md-6 mb-3">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password..">
							</div>
						</div>
						<hr class="mb-4">
						<button class="btn btn-primary btn-lg btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
					</form>
				</div>
			</div>
		</div>
	</body>
	
	<footer>
		<div class="container py-5">
			<h6>&copy; Danonek 2020</h6>
		</div>
	</footer>
	
	<script src="/assets/js/jquery-3.5.1.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/danonek/login.js"></script>  

</html>