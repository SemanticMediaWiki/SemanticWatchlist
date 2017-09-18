<?php

/**
 * @see https://github.com/SemanticMediaWiki/SemanticWatchlist/
 *
 * @defgroup SWL Semantic Watchlist
 */
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is part of the SemanticWatchlist extension, it is not a valid entry point.' );
}

if ( defined( 'SWL_VERSION' ) ) {
	// Do not initialize more than once.
	return 1;
}

if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
	include_once __DIR__ . '/vendor/autoload.php';
}

SWL\SemanticWatchlist::load();
