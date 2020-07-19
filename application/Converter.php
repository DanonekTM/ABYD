<?php
require_once __DIR__ . '/config/settings.php';
require_once __DIR__ . '/vendor/autoload.php';

use YoutubeDl\YoutubeDl;

Class Converter
{
	public function convert($id, $path, $link)
	{
		$localfile = $path . $id . ".mp3";
		$exists = file_exists($localfile);
	
		if (Tools::config_item("DOWNLOAD_MAX_LENGTH") > 0 || $exists) 
		{
			$dl = new YoutubeDl(['skip-download' => true]);
			$dl->setDownloadPath($path);
			$dl->setBinPath(Tools::config_item("YOUTUBE_DL_PATH"));
		
			try 
			{
				$video = $dl->download($link);
		
				if ($video->getDuration() > Tools::config_item("DOWNLOAD_MAX_LENGTH") && Tools::config_item("DOWNLOAD_MAX_LENGTH") > 0)
				{
					$info = array(
						"error" => true,
						"info"  => "Video exceeds " . Tools::config_item("DOWNLOAD_MAX_LENGTH") . " seconds."
					);

					return $info;
				}
			}
			catch (Exception $ex)
			{
				return array("error" => true, "info"  => "Video is private or unavailable!");
			}
		}
	
		if (!$exists)
		{		
			$dl = new YoutubeDl(array(
				'extract-audio' => true,
				'audio-format'  => 'mp3',
				'audio-quality' => 0, 
				'output'        => '%(id)s.%(ext)s',
			));
			$dl->setBinPath(Tools::config_item("YOUTUBE_DL_PATH"));
			$dl->setDownloadPath($path);
		}
	
		try
		{
			$video = $dl->download($link);

			if ($exists)
			{
				$file = $id . ".mp3";
			}
			else
			{
				$file = $video->getFilename();
			}
			
			$info = array(
				"error" => false,
				"title" => $video->getTitle(),
				"path"  => $file
			);

			return $info;
		}
		catch (Exception $e)
		{
			return array("error" => true, "info"  => "Download Failed!");
		}
	}
}
?>