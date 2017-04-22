<?php

	/*
		Verify that the script is running from the command line, and grab the input variables.
	*/

	if(PHP_SAPI === 'cli')
	{
		// http://php.net/manual/en/function.getopt.php
		$shortInputVars  = "";		// No Value
		$shortInputVars .= "u:";	// Username
		$shortInputVars .= "p:";	// Password
		$shortInputVars .= "l:";	// Login Attempt ID
		$shortInputVars .= "s:";	// Starting Song ID
		$shortInputVars .= "e";		// Ending Song ID
		$shortInputVars .= "d";		// Full path to store downloaded files.

		$longInputVars  = array(
			"username::",		// Username
			"password::",		// Password
			"loginid::",		// Login Attempt ID
			"startid::",		// Starting Song ID
			"endid::",			// Ending Song ID
			"directory::",		// Full path to store downloaded files.
			"null",				// This does nothing.
		);
		$getVarsFromCLI = getopt($shortInputVars, $longInputVars);

		// var_dump($getVarsFromCLI);

		if(isset($getVarsFromCLI['username']))
		{
			$loginUsername = $getVarsFromCLI['username'];
		}
		elseif(isset($getVarsFromCLI['u']))
		{
			$loginUsername = $getVarsFromCLI['u'];
		}

		if(isset($getVarsFromCLI['password']))
		{
			$loginPassword = $getVarsFromCLI['password'];
		}
		elseif(isset($getVarsFromCLI['p']))
		{
			$loginPassword = $getVarsFromCLI['p'];
		}

		if(isset($getVarsFromCLI['loginid']))
		{
			$loginAttemptId = $getVarsFromCLI['loginid'];
		}
		elseif(isset($getVarsFromCLI['l']))
		{
			$loginAttemptId = $getVarsFromCLI['l'];
		}

		if(isset($getVarsFromCLI['startid']))
		{
			$startSongId = $getVarsFromCLI['startid'];
		}
		elseif(isset($getVarsFromCLI['s']))
		{
			$startSongId = $getVarsFromCLI['s'];
		}

		if(isset($getVarsFromCLI['endid']))
		{
			$endSongId = $getVarsFromCLI['endid'];
		}
		elseif(isset($getVarsFromCLI['e']))
		{
			$endSongId = $getVarsFromCLI['e'];
		}

		if(isset($getVarsFromCLI['directory']))
		{
			$input_directory_path = $getVarsFromCLI['directory'];
		}
		elseif(isset($getVarsFromCLI['d']))
		{
			$input_directory_path = $getVarsFromCLI['d'];
		}
	}
	else
	{
		!$enableOutput ?: print "This Script Must Be Run from the Command Line." . PHP_EOL;
		!$enableLogging ?: writeToLogFile("This Script Must Be Run from the Command Line.");

		exit();
	}

?>