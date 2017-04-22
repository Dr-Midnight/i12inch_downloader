<?php

	/*
		Require configuration.
	*/
	require("./config.inc.php");

	/*
		Import Log File Function.
	*/
	require("./functions/writeToLogFile.php");

	/*
		Import Function to Convert Size Units.
	*/
	require "./functions/format_size_units.php";

?>
<?php

	/*
		Get Initial Input Variables
	*/
	require("./actions/getInputVars.php");

	/*
		Verify Initial Input Variables Are Present
	*/
	require("./actions/verifyInputVars.php");

	/*
		Format and/or Set basic request variables.
		
		This includes:
		-	The Login POST Data
		-	The Login URL
		-	The Login POST URL
		-	The Player URL

		Also, set our cookie directory, and verify that it can be written to.

		Also, set our download directory, and verify that it can be written to.
	*/
	require("./actions/buildRequest.php");

	/*
		Execute
	*/
	require("./actions/execCurlRequest.php");
	
?>