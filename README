Overview:

	This is a script meant for downloading songs from i12inch - a record pool for professional DJs ( http://www.i12inch.com ).

	To use it, you must have a valid account with i12inch.

	I wrote this script as a means to download from their site without using their terrible interface to do so. I am now opening it to the public.

Requirements:

	PHP 5.6 or higher with the cURL library enabled ( http://php.net/manual/en/book.curl.php ).

	This script is fairly Operating System agnostic, and should run on Linux, macOS / OS X, and Windows. However, it has only been tested under CentOS 7.


How to use:

	This script must be triggered from a command line interface. I have, up to point, used BASH to do so. It can be executed by calling the script through the php binary, i.e.:

		php download.php
		
	This script requires several command line arguments to be passed to it in order to run. They include a valid username to login with, a valid password,
	the directory to save retrieved files to, and the start and end song ids to retrieve. The following is a list of valid arguments.

		Username:
		
			-u
			--username

		Password:

			-p
			--password

		Starting Song ID:

			-s
			--startid

		Ending Song ID:

			-e
			--endid

		Download Directory:

			-d
			--directory

	As an example, this script can be successfully executed by performing:

		php download.php --username="foo@b.ar" --password="foobar" --startid="1" --endid="1000" --directory="/home/user/downloads/"

	Song IDs must be retrieved from i12inch's song selection interface. They are fairly easy to find.

Notes:

	*	This script has logging functionality, and will effectively write it's entire stdout to a log. This can be disabled by modifying config.inc.php accordingly, and setting $enableLogging to FALSE.
	*	Likewise, the majority of the stdout output of this script can be disabled by setting $enableOutput to FALSE.
	*	In order to identify as a browser, this script sends a user agent in it's cURL call. By default, this is set to Firefox 50. This can be changed by providing a valid user agent in $user_agent.
	*	This script stores a cookie in ../cookie_jar each time it runs. It is not cleared upon completion.

	*	While the provided configuration has never been problematic, if any problems are experienced regarding connection timeouts, review the timeouts in config.inc.php.

Disclaimer:

	As always, this is provided with no warranty, nor gaurantee of it's functionality.