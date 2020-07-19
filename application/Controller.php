<?php

Class Controller
{
	public static function handleLogin($userLogin, $userPassword)
	{
		// Add your credentials here :)
		$credentials = array(
			"Danonek" => "123"
		);

		foreach ($credentials as $login => $pass)
		{
			if ($login == $userLogin && $pass == $userPassword)
			{
				$_SESSION['logged_in'] = true;
				$_SESSION['user_name'] = $userLogin;
				return true;
			}
		}
		return false;
	}

	public static function doLogout()
	{
		$_SESSION = array();
		session_destroy();
		header("Location: /");
		die();
	}

	public static function removeFile($id, $path)
	{
		if (preg_match("([A-Za-z0-9_\-]{11})", $id))
		{
			if (unlink($path . $id . ".mp3"))
			{
				return true;
			}
		}
		return false;
	}

	public function convertLink($id, $link, $location)
	{	
		set_time_limit(0);
		$Converter = new Converter();

		if (preg_match("/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/i", $link))
		{
			$link = "https://www.youtube.com/watch?v=" . $id;
			$convertedInfo = $Converter->convert($id, $location, $link);

			if (!$convertedInfo['error'])
			{
				$title = $convertedInfo['title'];
				
				if (strpos($title, '.mp3') === false)
				{
					$title = $convertedInfo['title'] . ".mp3";
				}

				$path = $convertedInfo['path'];

				$info = array(
					"reply" => "OK",
					"info"  => "Downloaded Successfully.",
					"title" => $title,
					"path"  => Tools::config_item("DOWNLOAD_FOLDER_PUBLIC") . $path
				);
			}
			else
			{
				$info = array(
					"reply" => "FAIL",
					"info"  => $convertedInfo['info']
				);
			}

			return json_encode($info);
		}
		return false;
	}
}
?>