<?php

// Prerequisites: python, ffmpeg, youtube-dl with libmp3lame.
define("SELF_CALLED", true);

// Dev or live
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'dev');

// Change this if ABYD is a subfolder.
define('BASEPATH', '/');

if (!defined("SELF_CALLED"))
{
	exit('Application not configured.');
}

spl_autoload_register(function($class)
{
	require_once 'application/' . $class . '.php';
});

?>