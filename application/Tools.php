<?php
if (!defined("SELF_CALLED"))
{
	exit('Application not configured.');
}

class Tools
{
	private static function get_config(Array $replace = array())
	{
		static $config;

		if (empty($config))
		{
			$file_path = 'application/config/config.php';
			$found = false;
			if (file_exists($file_path))
			{
				$found = true;
				require($file_path);
			}

			if (!$found)
			{
				echo 'Configuration file does not exist.';
				exit(1);
			}

			if (!isset($config) or !is_array($config))
			{
				echo 'Format failed.';
				exit(1);
			}
		}
		foreach ($replace as $key => $val)
		{
			$config[$key] = $val;
		}

		return $config;
	}

	public static function config_item($item)
	{
		static $_config;

		if (empty($_config))
		{
			$_config[0] = self::get_config();
		}

		return isset($_config[0][$item]) ? $_config[0][$item] : null;
	}
	
	public static function isHTTPS() 
	{
		return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
	}


	public static function secondsToTime($inputSeconds)
	{
		$secondsInAMinute = 60;
		$secondsInAnHour  = 60 * $secondsInAMinute;
		$secondsInADay    = 24 * $secondsInAnHour;

		$days = floor($inputSeconds / $secondsInADay);

		$hourSeconds = $inputSeconds % $secondsInADay;
		$hours = floor($hourSeconds / $secondsInAnHour);

		$minuteSeconds = $hourSeconds % $secondsInAnHour;
		$minutes = floor($minuteSeconds / $secondsInAMinute);

		$remainingSeconds = $minuteSeconds % $secondsInAMinute;
		$seconds = ceil($remainingSeconds);

		$obj = array(
			'd' => (int) $days,
			'h' => (int) $hours,
			'm' => (int) $minutes,
			's' => (int) $seconds,
		);
		return $obj;
	}
}
?>