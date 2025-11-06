<?php

namespace SWL;

use MediaWiki\MediaWikiServices;
use GlobalVarConfig;

/**
 * @codeCoverageIgnore
 */
class SemanticWatchlist {

	/**
	 * @since 1.2
	 */
	public static function initExtension() {
		define( 'SWL_VERSION', '1.2.0-alpha' );
	}

	/**
	 * @since 1.2
	 */
	public static function onExtensionFunction() {

		// Check requirements after LocalSetting.php has been processed, thid has
		// be done here to ensure SMW is loaded in case
		// wfLoadExtension( 'SemanticMediaWiki' ) is used
		self::checkRequirements();
		$cfg = new GlobalVarConfig( "egSWL" );
		$configuration = array(
			'egSWLEnableTopLink'         => $cfg->get('EnableTopLink'),
			'egSWLEnableEmailNotify'     => $cfg->get('EnableEmailNotify'),
			'egSWLSqlDatabaseSchemaPath' => $cfg->get('SqlDatabaseSchemaPath')
		);

		$hookRegistry = new HookRegistry(
			$configuration
		);

		$hookRegistry->register(
			MediaWikiServices::getInstance()->getHookContainer()
		);
	}

	private static function checkRequirements() {
		if ( version_compare( $GLOBALS[ 'wgVersion' ], '1.27', 'lt' ) ) {
			die( '<b>Error:</b> This version of <a href="https://github.com/SemanticMediaWiki/SemanticWatchlist/">Semantic Watchlist</a> is only compatible with MediaWiki 1.23 or above. You need to upgrade MediaWiki first.' );
		}

		if ( !defined( 'SMW_VERSION' ) ) {
			die( '<b>Error:</b> <a href="https://github.com/SemanticMediaWiki/SemanticWatchlist/">Semantic Watchlist</a> requires the <a href="https://github.com/SemanticMediaWiki/SemanticMediaWiki/">Semantic MediaWiki</a> extension, please enable or install the extension first.' );
		}
	}

	/**
	 * @since 1.2
	 *
	 * @return string|null
	 */
	public static function getVersion() {
		return SWL_VERSION;
	}

}
