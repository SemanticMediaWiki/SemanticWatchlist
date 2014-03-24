<?php

if ( php_sapi_name() !== 'cli' ) {
	die( 'Not an entry point' );
}

$pwd = getcwd();
chdir( __DIR__ . '/..' );
passthru( 'composer update' );
chdir( $pwd );

if ( !is_readable( __DIR__ . '/../vendor/autoload.php' ) ) {

	if( is_readable( __DIR__ . '/../SemanticWatchlist.php') ) {
		include_once __DIR__ . '/../SemanticWatchlist.php';
	} else {
		die( 'You need to install this package with Composer before you can run the tests' );
	}
}
