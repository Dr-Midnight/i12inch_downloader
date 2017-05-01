<?php

	/* ------------------------------------------------------ Configuration Variables ------------------------------------------------------ */

	/*
		----------------------------------------------------------------------------------------------------
		date_default_timezone_set
		http://php.net/manual/en/function.date-default-timezone-set.php
		date_default_timezone_set — Sets the default timezone used by all date/time functions in a script
		----------------------------------------------------------------------------------------------------
		List of Supported Timezones - http://php.net/manual/en/timezones.php
		----------------------------------------------------------------------------------------------------

		Set the current timezone.
	*/

	$setTimeZone = "America/New_York";

	/*
		Enables/Disables Standard Output

		Enable = TRUE 
		Disable = FALSE
	*/
	$enableOutput = TRUE;

	/*
		Logging Options
		
		--------------------------------
		
		Enable/Disable Logging.

		Enable = TRUE 
		Disable = FALSE
		
		--------------------------------
		
		Set "$logNamePrefix" to be the name of the log file. This will be appended with a timestamp.
	*/

	$enableLogging = TRUE;
	$logNamePrefix = "i12inch_downloader";

	/*
		Define a user agent for usage when logging in. This is necessary for the script to appear as an actual browser.
	*/

	$user_agent = "Mozilla/5.0 (X11; Linux i686 on x86_64; rv:50.0) Gecko/20100101 Firefox/50.0";
	
	/*
		The variables "$curl_connect_timeout" and "$curl_timeout" respectively correspond to the following: CURLOPT_CONNECTTIMEOUT_MS and CURLOPT_TIMEOUT_MS.
		
		-	CURLOPT_CONNECTTIMEOUT_MS
			-	The number of milliseconds to wait while trying to connect. Use 0 to wait indefinitely. If libcurl is built to use the standard system name resolver, that portion of the connect will still use full-second resolution for timeouts with a minimum timeout allowed of one second.
		-	CURLOPT_TIMEOUT_MS
			-	The maximum number of milliseconds to allow cURL functions to execute. If libcurl is built to use the standard system name resolver, that portion of the connect will still use full-second resolution for timeouts with a minimum timeout allowed of one second.

		The variable "$curl_download_timeout" is associated with the timelimit to retrieve a track.

		Set these equal to the number of milliseconds to wait.
		-	i.e.:	200 (ms)	=	.2 second(s)
		-	i.e.:	500 (ms)	=	.5 second(s)
		-	i.e.:	1000 (ms)	=	1.0 second(s)
		-	i.e.:	5000 (ms)	=	5.0	second(s)
		-	i.e.:	10000 (ms)	=	10.0 second(s)
	*/

	$curl_connect_timeout = 10000;
	$curl_timeout = 10000;
	$curl_download_timeout = 60000;

	/*
		Define whether or not to move files to subdirectories based on their genre.
		This will scan the ID3v2 tag for its genre, and create (if one does not exist) a directory for that genre. It will then move the song to that directory.
	*/
	$parse_genre_to_path = TRUE;

?>