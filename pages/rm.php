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
		<title>Youtube Downloader :: Remove</title>
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
				<div class="col-md-12">
					<div id="error" class="ht-tm-element alert alert-danger" style="display: none; margin-bottom: 20px;"></div> 
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th scope="col">Video ID</th>
								<th scope="col">Link</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach (new DirectoryIterator($downloadlocation) as $fileInfo)
							{
								if ($fileInfo->getExtension() == "mp3")
								{
									$fileName = str_replace(".mp3", "", $fileInfo);
								?>	
									<tr id="<?= $fileName; ?>">
										<th scope="row"><?= $fileName; ?></th>
										<td>
											<a href="https://www.youtube.com/watch?v=<?= $fileName; ?>" target="_blank">https://www.youtube.com/watch?v=<?= $fileName; ?></a>
										</td>
										<td>
											<button id="<?= $fileName; ?>" class="btn btn-sm btn-danger my-1 my-sm-0" onClick="remove(this.id)">
												<span class="fas fa-trash mr-1"></span>
											Delete</button>
										</td>
									</tr>
								<?php
								}
							}
							?>

						</tbody>
					</table>
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
	<script src="/assets/js/danonek/remove.js"></script>

</html>