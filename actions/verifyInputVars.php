<?php

	!$enableOutput ?: print "-----------------" . PHP_EOL;
	!$enableOutput ?: print "Testing Arguments" . PHP_EOL;
	!$enableOutput ?: print "-----------------" . PHP_EOL;

	!$enableLogging ?: writeToLogFile("-----------------");
	!$enableLogging ?: writeToLogFile("Testing Arguments");
	!$enableLogging ?: writeToLogFile("-----------------");

?>
<?php

	if(isset($loginUsername))
	{
		!$enableOutput ?: print "Username: $loginUsername" . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Username: $loginUsername");
	}
	else
	{
		!$enableOutput ?: print "Username is not set." . PHP_EOL;
		!$enableOutput ?: print "Exiting: This script will not proceed without the Username defined." . PHP_EOL;

		!$enableLogging ?: writeToLogFile("Username is not set.");
		!$enableLogging ?: writeToLogFile("Exiting: This script will not proceed without the Username defined.");

		exit();
	}

	if(isset($loginPassword))
	{
		!$enableOutput ?: print "Password: $loginPassword" . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Password: $loginPassword");
	}
	else
	{
		!$enableOutput ?: print "Password is not set." . PHP_EOL;
		!$enableOutput ?: print "Exiting: This script will not proceed without the Password defined." . PHP_EOL;

		!$enableLogging ?: writeToLogFile("Password is not set.");
		!$enableLogging ?: writeToLogFile("Exiting: This script will not proceed without the Password defined.");

		exit();
	}

	if(isset($loginAttemptId))
	{
		!$enableOutput ?: print "Login Attempt ID: $loginAttemptId" . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Login Attempt ID: $loginAttemptId");
	}
	else
	{
		!$enableOutput ?: print "Warning: Login Attempt ID (login_attempt_id) is not set." . PHP_EOL;
		!$enableOutput ?: print "Notice: It is not required to provide the Login Attempt ID (login_attempt_id)." . PHP_EOL;

		!$enableLogging ?: writeToLogFile("Warning: Login Attempt ID (login_attempt_id) is not set.");
		!$enableLogging ?: writeToLogFile("Notice: It is not required to provide the Login Attempt ID (login_attempt_id).");
	}

	if(isset($startSongId))
	{
		!$enableOutput ?: print "Start Song ID: $startSongId" . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Start Song ID: $startSongId");
	}
	else
	{
		!$enableOutput ?: print "Start Song ID is not set." . PHP_EOL;
		!$enableOutput ?: print "Exiting: This script will not proceed without the Start Song ID defined." . PHP_EOL;

		!$enableLogging ?: writeToLogFile("Start Song ID is not set.");
		!$enableLogging ?: writeToLogFile("Exiting: This script will not proceed without the Start Song ID defined.");

		exit();
	}

	if(isset($endSongId))
	{
		!$enableOutput ?: print "End Song ID: $endSongId" . PHP_EOL;
		!$enableLogging ?: writeToLogFile("End Song ID: $endSongId");
	}
	else
	{
		!$enableOutput ?: print "End Song ID is not set." . PHP_EOL;
		!$enableOutput ?: print "Exiting: This script will not proceed without the End Song ID defined." . PHP_EOL;

		!$enableLogging ?: writeToLogFile("End Song ID is not set.");
		!$enableLogging ?: writeToLogFile("Exiting: This script will not proceed without the End Song ID defined.");

		exit();
	}

	if(isset($input_directory_path))
	{
		!$enableOutput ?: print "Download Directory: $input_directory_path" . PHP_EOL;
		!$enableLogging ?: writeToLogFile("Download Directory: $input_directory_path");
	}
	else
	{
		!$enableOutput ?: print "Download Directory is not set." . PHP_EOL;
		!$enableOutput ?: print "Exiting: This script will not proceed without the Download Directory defined." . PHP_EOL;

		!$enableLogging ?: writeToLogFile("Download Directory is not set.");
		!$enableLogging ?: writeToLogFile("Exiting: This script will not proceed without the Download Directory defined.");

		exit();
	}

	!$enableOutput ?: print "-----------------" . PHP_EOL;
	!$enableLogging ?: writeToLogFile("-----------------");
?>