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
		<title>Youtube Downloader :: Home</title>
		<link rel="stylesheet" href="/assets/css/fa-all.min.css">
		<link rel="stylesheet" href="/assets/css/bootstrap.css">  
		<link rel="stylesheet" href="/assets/css/loader.css">  
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
						<?php
						if (isset($_SESSION['user_name']) && $_SESSION['user_name'] == "Danonek")
						{
						?>
							<a href="/rm" class="p-3 text-decoration-none text-light"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
						<?php
						}
						?>
							<a href="/logout" class="p-3 text-decoration-none text-light"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
						</div>
					</div>
				</nav>
			</div>
		</div>

		<div class="container py-5 mb5">
			<h1 class="mb-1">Absolutely Based Youtube Downloader</h1>
			<p> What's good <?= $_SESSION['user_name']; ?>.</p>
			<div class="row py-4">
				<div class="col-md-12" id="form-container">
					<div class="ht-tm-element alert alert-danger" style="display: none; margin-bottom: 20px;" id="error"></div> 
					<form method="POST" id="downloader" class="mb-5" onsubmit="return abyd();">
						<div class="input-group">
							<input type="text" name="link" id="link" class="form-control" placeholder="Youtube Link..">
							<div class="input-group-append">
								<button type="submit" class="btn btn-primary">Download</button>
							</div>
						</div>
					</form>

					<div class="ht-tm-codeblock" id="message" style="display: none;">
						<div class="ht-tm-element jumbotron">
							<div id="dl-progress" style="display: block;">
								<h1 class="display-3"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div> Converting the video!</h1>
								<p class="lead">The video is being converted into a 256 Kbit/s MP3 file, please wait.</p>
							</div>
							<div id="title-section" style="display: none;">
								<p><strong>Title: </strong><span id="yt_title"></span></p>
							</div>
							<div id="dl-section" style="display: none;">
								<p class="lead">
									<a id="dl-link-btn" class="btn btn-primary" href="#" role="button">
										<i class="fa fa-download" aria-hidden="true"></i>
										Download
									</a>
								</p>
							</div>
						</div>
					</div>
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
	<script src="/assets/js/danonek/downloader.js"></script>

</html>