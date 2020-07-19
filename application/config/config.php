<?php

if (!defined("SELF_CALLED"))
{
	exit('Application not configured.');
}

// This is the login of the master account that will have access to removing files from the server.
$config['MASTER_ACCOUNT'] = "Danonek";

// Downloader Config
$config['DOWNLOAD_FOLDER_PUBLIC'] = "http://localhost/download/"; // Change this to the relevant path in the url from where the download folder is visible.
$config['DOWNLOAD_MAX_LENGTH'] = 300; // In seconds

// Adjust the path to the youtube-dl binary or use the one I provided. 
$config["YOUTUBE_DL_PATH"] = dirname(__FILE__) . "/bin/youtube-dl";
// $config["YOUTUBE_DL_PATH"] = dirname(__FILE__) . "/bin/youtube-dl.exe"; // Uncomment for Windows use.

?>