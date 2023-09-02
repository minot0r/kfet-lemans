<?php

function readDatabaseInformations() {
	$LOGFILE_NAME = $_SERVER['DOCUMENT_ROOT'] . '/database_logs.txt';

	if($file = fopen($LOGFILE_NAME, 'r')) {
		while(!feof($file)) {
			$line = fgets($file);
			$keyword = substr($line, 0, 4);
			$value = substr($line, 5);
			$value = preg_replace( "/\r|\n/", "", $value);	// Remove new line chars

			switch ($keyword) {
				case 'HOST':
					$HOST = $value;
					break;

				case 'USER':
					$USER = $value;
					break;

				case 'PASS':
					$PASS = $value;
					break;

				case 'NAME':
					$NAME = $value;
					break;
			}
		}

		fclose($file);
	} else {
		return NULL;
	}

	return [
		'HOST' => $HOST,
		'USER' => $USER,
		'PASS' => $PASS,
		'NAME' => $NAME
	];
}

function connectToDatabase() {
	// Connection info.
	$INFOS = readDatabaseInformations();

	// Try and connect using the info above.
	$connection = mysqli_connect($INFOS['HOST'], $INFOS['USER'], $INFOS['PASS'], $INFOS['NAME']);
	if ( mysqli_connect_errno() ) {
		// If there is an error with the connection, stop the script and display the error.
		echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
		die;
	}

	$connection->set_charset('utf8');

	return $connection;
}

?>