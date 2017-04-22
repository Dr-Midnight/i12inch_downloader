<?php

	/*
		-----------------------------------------------
		curl_init — Initialize a cURL session
		-----------------------------------------------
		http://php.net/manual/en/function.curl-init.php
		Initializes a new session and return a cURL handle for use with the curl_setopt(), curl_exec(), and curl_close() functions.

		-----------------------------------------------

		Open a cURL session in order to interact with Message Central.
		This cURL session can be left open as long as is necessary to complete all related steps.

		-----------------------------------------------

		-----------------------------------------------
		curl_setopt — Set an option for a cURL transfer
		-----------------------------------------------
		http://php.net/manual/en/function.curl-setopt.php
		Sets an option on the given cURL session handle.

		-----------------------------------------------

		This defines all applicable options for the present cURL session. They are set before each "curl_exec" in order to ensure that each request utilizes the proper options.

		-----------------------------------------------

		-----------------------------------------------
		curl_exec — Perform a cURL session
		-----------------------------------------------
		http://php.net/manual/en/function.curl-exec.php
		Execute the given cURL session.

		This function should be called after initializing a cURL session and all the options for the session are set.

		-----------------------------------------------

		This excecutes our given session.

		-----------------------------------------------

		-----------------------------------------------
		curl_errno — Return the last error number
		-----------------------------------------------
		http://php.net/manual/en/function.curl-errno.php
		Returns the error number for the last cURL operation.

		-----------------------------------------------

		Error Checking for Critical Errors. This should only ever occur in the event of a critical error during execution.

		-----------------------------------------------

		-----------------------------------------------
		curl_getinfo — Get information regarding a specific transfer
		-----------------------------------------------
		http://php.net/manual/en/function.curl-getinfo.php
		Gets information about the last transfer.

		-----------------------------------------------

		Get details about the last session.

		-----------------------------------------------

		-----------------------------------------------
		curl_close — Close a cURL session
		-----------------------------------------------
		http://php.net/manual/en/function.curl-close.php
		Closes a cURL session and frees all resources. The cURL handle, ch, is also deleted.

		-----------------------------------------------

		Close the cURL session.
	*/

?>
<?php

	/*
		Initialize our cURL session.
	*/
	$ch = curl_init();

	/*
		This specific portion is utilized with the intention of checking if i12inch is up.
		If the script cannot verify that i12inch is up, then there is no purpose in proceeding.
	*/

	!$enableOutput ?: print "Attempting to reach $member_url." . PHP_EOL;
	!$enableLogging ?: writeToLogFile("Attempting to reach $member_url.");

	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_NOBODY, false);
	curl_setopt($ch, CURLOPT_URL, $member_url);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $curl_connect_timeout);
	curl_setopt($ch, CURLOPT_TIMEOUT_MS, $curl_timeout);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
	$getCookieResult = curl_exec($ch);

	if (curl_errno($ch))
	{
		!$enableOutput ?: print "Error: " . curl_error($ch) . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Error: " . curl_error($ch));

		$connectionDetail = curl_error($ch);

		// var_dump($ch);
		// var_dump($getCookieResult);

		if(curl_close($ch))
		{
			!$enableOutput ?: print "cURL Session Closed." . PHP_EOL;
			!$enableLogging ?: writeToLogFile("cURL Session Closed.");
		}
		else
		{
			!$enableOutput ?: print "Warning: Could not close cURL session." . PHP_EOL;
			!$enableLogging ?: writeToLogFile("Warning: Could not close cURL session.");
		}

		
	}
	else
	{
		$chResults = curl_getinfo($ch);

		!$enableOutput ?: print "Current URL: " . $chResults['url'] . PHP_EOL;
		!$enableOutput ?: print "HTTP Code: " . $chResults['http_code'] . PHP_EOL;
		!$enableOutput ?: print "Transaction Time: " . $chResults['total_time'] . " seconds." . PHP_EOL;

		!$enableLogging ?: writeToLogFile("Current URL: " . $chResults['url']);
		!$enableLogging ?: writeToLogFile("HTTP Code: " . $chResults['http_code']);
		!$enableLogging ?: writeToLogFile("Transaction Time: " . $chResults['total_time'] . " seconds.");

		// var_dump($getCookieResult);

		$connectionDetail = "OK";
		
		$getCookieURL = $chResults['url'];
	}

	if(!$connectionDetail == "OK")
	{
		/*
			Cease functionality at this point if script could not reach $member_url.
		*/
		exit();
	}
	else
	{
		/*
			Wait 1 second. 
		*/
		sleep(1);

		/*
			Login.

			Use Follow Location to follow the post login redirects.
		*/
		!$enableOutput ?: print "Attempting to login." . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Attempting to login.");

		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_NOBODY, false);
		curl_setopt($ch, CURLOPT_URL, $login_post_url);
		curl_setopt($ch, CURLOPT_REFERER, $member_url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $curl_connect_timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, $curl_timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $login_post_data);
		$getLoginResult = curl_exec($ch);

		if (curl_errno($ch))
		{
			!$enableOutput ?: print "Error: " . curl_error($ch) . PHP_EOL;
			!$enableLogging ?: writeToLogFile("Error: " . curl_error($ch));

			// var_dump($ch);
			// var_dump($getLoginResult);

			$connectionDetail = curl_error($ch);

			if(curl_close($ch))
			{
				!$enableOutput ?: print "cURL Session Closed." . PHP_EOL;
				!$enableLogging ?: writeToLogFile("cURL Session Closed.");
			}
			else
			{
				!$enableOutput ?: print "Warning: Could not close cURL session." . PHP_EOL;
				!$enableLogging ?: writeToLogFile("Warning: Could not close cURL session.");
			}
		}
		else
		{
			$chResults = curl_getinfo($ch);

			!$enableOutput ?: print "Current URL: " . $chResults['url'] . PHP_EOL;
			!$enableOutput ?: print "HTTP Code: " . $chResults['http_code'] . PHP_EOL;
			!$enableOutput ?: print "Transaction Time: " . $chResults['total_time'] . " seconds." . PHP_EOL;

			!$enableLogging ?: writeToLogFile("Current URL: " . $chResults['url']);
			!$enableLogging ?: writeToLogFile("HTTP Code: " . $chResults['http_code']);
			!$enableLogging ?: writeToLogFile("Transaction Time: " . $chResults['total_time'] . " seconds.");

			// var_dump($getLoginResult);
	
			$getLoggedInUrl = $chResults['url'];

			/*
				This site's behavior is not consistent.
				It will not always redirect to $login_url in the case of a login failure.
				Check for the presence of the text "Username or password incorrect".
			*/
			if(strpos($getLoginResult,"Username or password incorrect") == true)
			{
				$connectionDetail = "Login Failure";

				!$enableOutput ?: print "Login Failure." . PHP_EOL;
				!$enableLogging ?: writeToLogFile("Login Failure.");
			}
			else
			{
				if($getLoggedInUrl === $member_url)
				{
					$connectionDetail = "OK";

					!$enableOutput ?: print "Login Successful." . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Login Successful.");
				}
				elseif($getLoggedInUrl === $login_url)
				{
					$connectionDetail = "Login Failure";

					!$enableOutput ?: print "Login Failure." . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Login Failure.");
				}
				else
				{
					$connectionDetail = "Unknown Error";

					!$enableOutput ?: print "Unknown Error Encountered." . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Unknown Error Encountered.");

					!$enableOutput ?: print "Dumping Page Output:" . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Dumping Page Output:");

					!$enableOutput ?: print "$getLoginResult" . PHP_EOL;
					!$enableLogging ?: writeToLogFile(PHP_EOL . $getLoginResult);
				}
			}
		}
	}
	
	if(!$connectionDetail === "OK")
	{
		/*
			Cease functionality at this point if an error was encountered.
		*/
		!$enableOutput ?: print "Error Encountered. Exiting." . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Error Encountered. Exiting.");

		exit();
	}
	else
	{

		/*
			This will be used to obtain the total execution time.
			-----------------------------------------------
			Start Timer
		*/
		$process_timer = microtime(true);

		/*
			This will be used to note the total songs retrieved.
			-----------------------------------------------
			Increment it at each point.
		*/
		$totalLoopIterations = (int) 0;

		/*
			Do a loop for songid's between X and Y.
			A while loop is likely better in this situation.
		*/

		$currentSongId = $startSongId;

		while($currentSongId <= $endSongId)
		{
			!$enableOutput ?: print "Current Song ID: $currentSongId" . PHP_EOL;
			!$enableLogging ?: writeToLogFile("Current Song ID: $currentSongId");

			/*
				Specify the i12inch preview player URL.
			*/
			$playerURL = str_replace('{sid}',$currentSongId,$player_id_url);
			echo $playerURL . PHP_EOL;
			
			/*
				Load the i12inch preview player.
				This will be utilised to get song download URL
			*/
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_NOBODY, false);
			curl_setopt($ch, CURLOPT_URL, $playerURL);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, $curl_connect_timeout);
			curl_setopt($ch, CURLOPT_TIMEOUT_MS, $curl_timeout);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
			$getPlayerPage = curl_exec($ch);

			if (curl_errno($ch))
			{
				!$enableOutput ?: print "Error: " . curl_error($ch) . PHP_EOL;
				!$enableLogging ?: writeToLogFile("Error: " . curl_error($ch));

				// var_dump($ch);
				// var_dump($getPlayerPage);

				$connectionDetail = curl_error($ch);

				if(curl_close($ch))
				{
					!$enableOutput ?: print "cURL Session Closed." . PHP_EOL;
					!$enableLogging ?: writeToLogFile("cURL Session Closed.");
				}
				else
				{
					!$enableOutput ?: print "Warning: Could not close cURL session." . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Warning: Could not close cURL session.");
				}
			}
			else
			{
				$chResults = curl_getinfo($ch);

				!$enableOutput ?: print "Current URL: " . $chResults['url'] . PHP_EOL;
				!$enableOutput ?: print "HTTP Code: " . $chResults['http_code'] . PHP_EOL;
				!$enableOutput ?: print "Transaction Time: " . $chResults['total_time'] . " seconds." . PHP_EOL;

				!$enableLogging ?: writeToLogFile("Current URL: " . $chResults['url']);
				!$enableLogging ?: writeToLogFile("HTTP Code: " . $chResults['http_code']);
				!$enableLogging ?: writeToLogFile("Transaction Time: " . $chResults['total_time'] . " seconds.");

				// var_dump($getPlayerPage)
	
				$getPlayerPageURL = $chResults['url'];
				
				if($getPlayerPageURL === $playerURL)
				{
					/*
						Using strpos(), the starting position of "<iframe src=..." in the page can be found.
						Likewise, the same function can be used to find the position of "</iframe>" in the page.
					*/
					$iframeStartPosition = strpos($getPlayerPage,'<iframe src="//');
					$iframeEndPosition = strpos($getPlayerPage,'</iframe>');

					/*
					!$enableOutput ?: print $iframeStartPosition . PHP_EOL;
					!$enableOutput ?: print $iframeEndPosition . PHP_EOL;

					!$enableLogging ?: writeToLogFile("$iframeStartPosition");
					!$enableLogging ?: writeToLogFile("$iframeEndPosition");
					*/

					/*
						By subtracting the starting position from the ending position,  the total length of the iframe string (not including the closing tag) can be determined dynamically.
					*/
					$iframeStringLength = $iframeEndPosition - $iframeStartPosition;

					/*
					!$enableOutput ?: print $iframeStringLength . PHP_EOL;
					!$enableLogging ?: writeToLogFile("$iframeStringLength");
					*/

					/*
						By using substr(), the entire iframe string (not including the closing tag) can be extracted for further handling.
					*/
					$iframeFullString = substr($getPlayerPage,$iframeStartPosition,$iframeStringLength);

					/*
					!$enableOutput ?: print $iframeFullString . PHP_EOL;
					!$enableLogging ?: writeToLogFile("$iframeFullString");
					*/

					/*
						Begin to get the mp3name.
					*/
					$mp3NameStartPosition = strpos($iframeFullString,'mp3name=');
					$mp3NameEndPosition = strpos($iframeFullString,'" ');

					/*
					!$enableOutput ?: print $mp3NameStartPosition . PHP_EOL;
					!$enableOutput ?: print $mp3NameEndPosition . PHP_EOL;

					!$enableLogging ?: writeToLogFile("$mp3NameStartPosition");
					!$enableLogging ?: writeToLogFile("$mp3NameEndPosition");
					*/

					$mp3NameStringLength = $mp3NameEndPosition - $mp3NameStartPosition;

					/*
					!$enableOutput ?: print $mp3NameStringLength . PHP_EOL;
					!$enableLogging ?: writeToLogFile("$mp3NameStringLength");
					*/

					/*
						By using substr(), it is possible to begin to obtain the song name.
					*/
					$mp3NameFullString = substr($iframeFullString,$mp3NameStartPosition,$mp3NameStringLength);

					/*
					!$enableOutput ?: print $mp3NameFullString . PHP_EOL;
					!$enableLogging ?: writeToLogFile("$mp3NameFullString");
					*/

					/*
						Remove "mp3name=" to get the song name.
						Use the function str_replace()
					*/

					$mp3SongName = str_replace('mp3name=','',$mp3NameFullString);

					!$enableOutput ?: print "Song Name: $mp3SongName" . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Song Name: $mp3SongName");

					/*
						This is the URL for where tracks are located.
						Use str_replace() to replace "{mp3SongName}" with the song name.
						http://s3.amazonaws.com/i12inch/{mp3SongName}.mp3
					*/

					$amazonDownloadUrl = 'https://s3.amazonaws.com/i12inch/{mp3SongName}.mp3';

					$songDownloadUrl = str_replace('{mp3SongName}',$mp3SongName,$amazonDownloadUrl);
					$encodedSongDownloadUrl = str_replace(' ','%20',$songDownloadUrl);

					!$enableOutput ?: print "Download Location: $songDownloadUrl" . PHP_EOL;
					!$enableOutput ?: print "Download URL: $encodedSongDownloadUrl" . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Download Location: $songDownloadUrl");
					!$enableLogging ?: writeToLogFile("Download URL: $encodedSongDownloadUrl");

					/*
						Open a file, to which remote contents should be written to.
					*/
					$downloadFilePath = $download_directory . $mp3SongName . ".mp3";
					$downloadFile = fopen($downloadFilePath, "w");

					/*
						Initialize a cURL handler.
					*/
					$download_ch = curl_init($encodedSongDownloadUrl);

					curl_setopt($download_ch, CURLOPT_FILE, $downloadFile); // Tell cURL to write contents to the file.
					curl_setopt($download_ch, CURLOPT_CONNECTTIMEOUT_MS, $curl_connect_timeout);
					curl_setopt($download_ch, CURLOPT_TIMEOUT_MS, $curl_download_timeout);
					curl_setopt($download_ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($download_ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($download_ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects.
					curl_setopt($download_ch, CURLOPT_USERAGENT, $user_agent);

					/*
						Execute the request.
					*/
					curl_exec($download_ch);

					/*
						Close the file.
					*/
					fclose($downloadFile);

					//var_dump($handleResults);


					// Error Handle
					if (curl_errno($ch))
					{
						!$enableOutput ?: print "Error: " . curl_error($ch) . PHP_EOL;
						!$enableLogging ?: writeToLogFile("Error: " . curl_error($ch));

						// var_dump($ch);
						// var_dump($getPlayerPage);

						$connectionDetail = curl_error($ch);

						if(curl_close($ch))
						{
							!$enableOutput ?: print "cURL Session Closed." . PHP_EOL;
							!$enableLogging ?: writeToLogFile("cURL Session Closed.");
						}
						else
						{
							!$enableOutput ?: print "Warning: Could not close cURL session." . PHP_EOL;
							!$enableLogging ?: writeToLogFile("Warning: Could not close cURL session.");
						}
					}
					else
					{
						/*
							Assign the results to an array.
							Record the results.
						*/
						$handleResults = curl_getinfo($download_ch);
						$download_speed = $handleResults['speed_download'] * 8 / 1024 / 1024;

						!$enableOutput ?: print "Current URL: " . $handleResults['url'] . PHP_EOL;
						!$enableOutput ?: print "HTTP Code: " . $handleResults['http_code'] . PHP_EOL;
						!$enableOutput ?: print "Transaction Time: " . $handleResults['total_time'] . " seconds." . PHP_EOL;
						!$enableOutput ?: print "Download Size: " . formatSizeUnits($handleResults['size_download']) . " (" . $handleResults['size_download'] . " bytes)" . PHP_EOL;
						!$enableOutput ?: print "Download Time: " . $handleResults['speed_download'] / 10000000 . " seconds (". $handleResults['speed_download'] . "ms)" . PHP_EOL;
						!$enableOutput ?: print "Download Speed: " . $download_speed . " Mbps" . PHP_EOL;
						!$enableOutput ?: print "Download Location: " . $$downloadFilePath . PHP_EOL;

						!$enableLogging ?: writeToLogFile("Current URL: " . $handleResults['url']);
						!$enableLogging ?: writeToLogFile("HTTP Code: " . $handleResults['http_code']);
						!$enableLogging ?: writeToLogFile("Transaction Time: " . $handleResults['total_time']);
						!$enableLogging ?: writeToLogFile("Download Size: " . formatSizeUnits($handleResults['size_download']) . " (" . $handleResults['size_download'] . " bytes)");
						!$enableLogging ?: writeToLogFile("Download Time: " . $handleResults['speed_download'] / 10000000 . " seconds (". $handleResults['speed_download'] . "ms)");
						!$enableLogging ?: writeToLogFile("Download Speed: " . $download_speed . " Mbps");
						!$enableLogging ?: writeToLogFile("Download Location: " . $$downloadFilePath);

						// Clean up.
						curl_close($download_ch);
					}
				}
				else
				{
					$connectionDetail = "Unknown Error";

					!$enableOutput ?: print "Unknown Error Encountered." . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Unknown Error Encountered.");

					!$enableOutput ?: print "Dumping Page Output:" . PHP_EOL;
					!$enableLogging ?: writeToLogFile("Dumping Page Output:");

					!$enableOutput ?: print "$getPlayerPage" . PHP_EOL;
					!$enableLogging ?: writeToLogFile(PHP_EOL . $getPlayerPage);
				}
			}

			/*
				Increment to the next song.
			*/
			++$currentSongId;

			/*
				Count Loop Iterations.
			*/
			++$totalLoopIterations;
		}

		/*
			Stop Timer
		*/
		$process_timer = microtime(true) - $process_timer;

		!$enableOutput ?: print "Total Execution Time: " . ($process_timer*1000) ."ms (". $process_timer . " seconds)" . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Total Execution Time: " . ($process_timer*1000) ."ms (". $process_timer . " seconds)");
	}
?>