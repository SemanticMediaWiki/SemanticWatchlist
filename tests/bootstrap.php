<?php

if ( defined( 'MEDIAWIKI' ) ) {
	return;
}

if ( PHP_SAPI !== 'cli' ) {
	die( 'Not an entry point' );
}

error_reporting( -1 );
ini_set( 'display_errors', 1 );

if ( !is_readable( __DIR__ . '/../vendor/autoload.php' ) ) {
	die( 'You need to install this package with Composer before you can run the tests' );
}

$autoloader = require __DIR__ . '/../vendor/autoload.php';

$autoloader->addPsr4( 'SWL\\Tests\\', __DIR__ . '/phpunit/Unit' );
$autoloader->addPsr4( 'SWL\\Tests\\Integration\\', __DIR__ . '/phpunit/Integration' );
