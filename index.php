<?php
require_once dirname(__FILE__) . "/application/config/settings.php";

switch (ENVIRONMENT)
{
	case 'dev':
	{
		error_reporting(-1);
		ini_set('display_errors', 1);
		break;
	}

	case 'live':
	{				
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')) 
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		} 
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
		break;
	}

	default:
	{
		header($_SERVER["SERVER_PROTOCOL"] . '503 Service Unavailable.', true, 503);
		die('The application environment is not set correctly.');
	}
}

session_start();

Router::add('/', function()
{
	if (isset($_SESSION['logged_in']))
	{
		include(__DIR__ . '/pages/cp.php');
		return;
	}
	
	include(__DIR__ . '/pages/home.php');
	return;
}, 'GET');

Router::add('/logout', function()
{
	if (isset($_SESSION['logged_in']))
	{
		Controller::doLogout();
	}
	else
	{
		header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found', true, 404);
		include(__DIR__ . '/pages/404.php');
	}
	return;
}, 'GET');

Router::add('/login', function()
{
	if (isset($_POST['verifyLogin'], $_POST['login'], $_POST['password']))
	{
		die(Controller::handleLogin($_POST['login'], $_POST['password']) ? "OK" : "FAIL");
	}
	
	include(__DIR__ . '/pages/login.php');
	return;
}, ['GET', 'POST']);

Router::add('/abyd', function()
{
	if (isset($_POST['id'], $_POST['link']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
	{
		$downloadlocation = __DIR__ . "/download/";
		$Controller = new Controller();

		echo($Controller->convertLink($_POST['id'], $_POST['link'], $downloadlocation));
	}
	else
	{
		header($_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized', true, 401);
		die("401 Unauthorized");
	}
	return;
}, 'POST');

Router::add('/rm', function()
{
	if (isset($_SESSION['user_name']) && $_SESSION['user_name'] == Tools::config_item('MASTER_ACCOUNT'))
	{
		$downloadlocation = __DIR__ . "/download/";
		if (isset($_POST['id']))
		{
			die(Controller::removeFile($_POST['id'], $downloadlocation) ? "OK" : "FAIL");	
		}
		include(__DIR__ . '/pages/rm.php');
		return;
	}
	else
	{
		header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found', true, 404);
		include(__DIR__ . '/pages/404.php');
	}
	return;
}, ['GET', "POST"]);

Router::pathNotFound(function($path)
{
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found', true, 404);
	include(__DIR__ . '/pages/404.php');
	return;
});

Router::methodNotAllowed(function($path, $method) 
{
	header($_SERVER["SERVER_PROTOCOL"] . ' 405 Method Not Allowed', true, 405);
	include(__DIR__ . '/pages/405.php');
	return;
});

Router::run(BASEPATH);