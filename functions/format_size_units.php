<?php

	/*
		Convert Bytes To Nicer Format
		http://stackoverflow.com/questions/5501427/php-filesize-mb-kb-conversion
	*/
	if (!function_exists('formatSizeUnits'))
	{
		function formatSizeUnits($bytes)
		{
			if ($bytes >= 1073741824)
			{
				$bytes = number_format($bytes / 1073741824, 2) . ' GB';
			}
			elseif ($bytes >= 1048576)
			{
				$bytes = number_format($bytes / 1048576, 2) . ' MB';
			}
			elseif ($bytes >= 1024)
			{
				$bytes = number_format($bytes / 1024, 2) . ' KB';
			}
			elseif ($bytes > 1)
			{
				$bytes = $bytes . ' bytes';
			}
			elseif ($bytes == 1)
			{
				$bytes = $bytes . ' byte';
			}
			else
			{
				$bytes = '0 bytes';
			}

			return $bytes;
		}
	}

	/*
		Sample Usage
		
		echo formatSizeUnits($value);
		echo formatSizeUnits($array['value']);
		echo formatSizeUnits('1234567890');
	*/

?>
