<?php

	/*
		This is formatted post data to be used at varying steps throughout the login process.
	*/
	/*
		Swap the comments for $login_post_data and provide a login ID if any problems are experienced.
	*/
	// $login_post_data = "amember_login=$loginUsername&amember_pass=$loginPassword&login_attempt_id=$loginAttemptId";
	$login_post_data = "amember_login=$loginUsername&amember_pass=$loginPassword";

	$member_url = 'https://www.i12inch.com/members/member.php';
	$login_url = 'https://www.i12inch.com/members/login.php';
	$login_post_url = 'https://www.i12inch.com/members/member.php';

	$player_id_url = 'https://www.i12inch.com/player/player3.php?id={sid}';

	/*
		This will generate a cookie for each time the script is run, ensuring a fresh session is used at each runtime.

		"$cookie_dir" is a directory where cookie files will be stored.
		"$cookie_file_path" is a path to the individual cookie file which will be generated at runtime.
	*/

	$cookie_dir = getcwd() . "/cookie_jar";
	$cookie_file_path = $cookie_dir . "/cookie" . date('Y-m-d\THisO', time()) . ".txt";

	if(file_exists($cookie_dir))
	{
		if(is_writable($cookie_dir))
		{
			/*
				OK!
			*/
		}
		else
		{
			!$enableOutput ?: print "Error: Directory $cookie_dir cannot be written to." . PHP_EOL;
			!$enableOutput ?: print "Verify the directory permissions have been correctly set." . PHP_EOL;

			!$enableLogging ?: writeToLogFile("Error: Directory $cookie_dir cannot be written to.");
			!$enableLogging ?: writeToLogFile("Verify the directory permissions have been correctly set.");

			exit();
		}
	}
	else
	{
		!$enableOutput ?: print "Error: Directory $cookie_dir does not exist." . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Error: Directory $cookie_dir does not exist.");

		exit();
	}

	/*
		This is the directory where songs will be stored.
	*/

	$download_directory = $input_directory_path;

	if(file_exists($download_directory))
	{
		if(is_writable($download_directory))
		{
			/*
				OK!
			*/
		}
		else
		{
			!$enableOutput ?: print "Error: Directory $download_directory cannot be written to." . PHP_EOL;
			!$enableOutput ?: print "Verify the directory permissions have been correctly set." . PHP_EOL;

			!$enableLogging ?: writeToLogFile("Error: Directory $download_directory cannot be written to.");
			!$enableLogging ?: writeToLogFile("Verify the directory permissions have been correctly set.");

			exit();
		}
	}
	else
	{
		!$enableOutput ?: print "Error: Directory $download_directory does not exist." . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Error: Directory $download_directory does not exist.");

		exit();
	}

?>