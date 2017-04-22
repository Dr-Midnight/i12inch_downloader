<?php

	if(isset($setTimeZone))
	{
		/*
			If a timezone has been set, then use that one.
			If it has not, default to UTC.
		*/
	}
	else
	{
		$setTimeZone = "UTC";
	}

	/*	Set our timezone, regardless of the setting in php.ini	*/

		date_default_timezone_set($setTimeZone);

	/*	Set Logging Parameters	*/

		if($enableLogging)
		{
			//	Set $logNamePrefix as a String Variable in File that requires this one.
			$logNamePrefix = trim($logNamePrefix);

			//	Set our timezone, regardless of the setting in php.ini
			date_default_timezone_set($setTimeZone);

			$logDatestamp = date('Y-m-d\THisO', time());	// Date and Time
			$logDirCurrentYear = date('Y', time());
			$logDirCurrentMonth = date('m', time());

			if(!file_exists("./logs/$logDirCurrentYear"))
			{
				mkdir("./logs/$logDirCurrentYear", 0777, true);
			}
			if(!file_exists("./logs/$logDirCurrentYear/$logDirCurrentMonth"))
			{
				mkdir("./logs/$logDirCurrentYear/$logDirCurrentMonth", 0777, true);
			}

			//	Log File
			$logFileDir = "./logs/$logDirCurrentYear/$logDirCurrentMonth/" . $logNamePrefix . "-" . $logDatestamp . ".log";

			//	Open Log
			$logFileStream = fopen($logFileDir, 'a');

			// Call this function to write to the log file.
			if (!function_exists('writeToLogFile'))
			{
				function writeToLogFile($logText)
				{
					global $logFileStream;
					fwrite($logFileStream, PHP_EOL . date('Y-m-d H:i:s O', time()) . "	-	$logText");
				}
			}
		}

	/*
		Config Example:

		Enable Log of Script Actions
		Options:	-	TRUE
					-	FALSE

		$enableLogging = TRUE;

		-----------------------------------------------------

		Usage Example:

		!$enableLogging ?: writeToLogFile("Enter Text Here");
	*/

?>