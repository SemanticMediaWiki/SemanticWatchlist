<?php

namespace SWL;

/**
 * @codeCoverageIgnore
 */
class SemanticWatchlist {

	/**
	 * @since 1.2
	 *
	 * @note It is expected that this function is loaded before LocalSettings.php
	 * to ensure that settings and global functions are available by the time
	 * the extension is activated.
	 */
	public static function load() {
		// Load DefaultSettings
		require_once __DIR__ . '/../DefaultSettings.php';

		if ( defined( 'SWL_VERSION' ) ) {
			// Do not initialize more than once.
			return 1;
		}

		define( 'SWL_VERSION', '1.2.0-alpha' );

		/**
		 * In case extension.json is being used, the succeeding steps are
		 * expected to be handled by the ExtensionRegistry aka extension.json
		 * ...
		 *
		 * 	"callback": "SemanticWatchlist::initExtension",
		 * 	"ExtensionFunctions": [
		 * 		"SemanticWatchlist::onExtensionFunction"
		 * 	],
		 */
		self::initExtension();

		$GLOBALS['wgExtensionFunctions'][] = function() {
			SemanticWatchlist::onExtensionFunction();
		};
	}

	/**
	 * @since 1.2
	 */
	public static function initExtension() {
		// Register the extension
		$GLOBALS['wgExtensionCredits']['semantic'][] = array(
			'path' => __FILE__,
			'name' => 'Semantic Watchlist',
			'version' => SWL_VERSION,
			'author' => array(
				'[https://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw] for [http://www.wikiworks.com/ WikiWorks]',
				'...'
			),
			'url' => 'https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist',
			'descriptionmsg' => 'semanticwatchlist-desc',
			'license-name'   => 'GPL-3.0+'
		);

		$GLOBALS['egSwlSqlDatabaseSchemaPath'] = __DIR__ . '/../src/swl-table-schema.sql';

		// Register message files
		$GLOBALS['wgMessagesDirs']['SemanticWatchlist'] = __DIR__ . '/../i18n';
		$GLOBALS['wgExtensionMessagesFiles']['SemanticWatchlistAlias'] = __DIR__ . '/../SemanticWatchlist.i18n.alias.php';

		$GLOBALS['egSWLScriptPath'] = $GLOBALS['wgExtensionAssetsPath'] === false ? $GLOBALS['wgScriptPath'] . '/extensions/SemanticWatchlist' : $GLOBALS['wgExtensionAssetsPath'] . '/SemanticWatchlist';

		// wgSpecialPages
		$GLOBALS['wgSpecialPages']['SemanticWatchlist'] = 'SpecialSemanticWatchlist';
		$GLOBALS['wgSpecialPageGroups']['SemanticWatchlist'] = 'changes';

		$GLOBALS['wgSpecialPages']['WatchlistConditions'] = 'SpecialWatchlistConditions';
		$GLOBALS['wgSpecialPageGroups']['WatchlistConditions'] = 'changes';

		// wgAPIModules
		$GLOBALS['wgAPIModules']['addswlgroup'] = 'ApiAddWatchlistGroup';
		$GLOBALS['wgAPIModules']['deleteswlgroup'] = 'ApiDeleteWatchlistGroup';
		$GLOBALS['wgAPIModules']['editswlgroup'] = 'ApiEditWatchlistGroup';
		$GLOBALS['wgAPIListModules']['semanticwatchlist'] = 'ApiQuerySemanticWatchlist';

		// wgAvailableRights
		$GLOBALS['wgAvailableRights'][] = 'semanticwatch';
		$GLOBALS['wgAvailableRights'][] = 'semanticwatchgroups';

		$moduleTemplate = array(
			'localBasePath' => __DIR__ . '/..',
			'remoteBasePath' => $GLOBALS['egSWLScriptPath']
		);

		$GLOBALS['wgResourceModules']['ext.swl.watchlist'] = $moduleTemplate + array(
				'styles' => array( 'specials/ext.swl.watchlist.css' ),
				'scripts' => array(),
				'dependencies' => array(),
				'messages' => array()
			);

		$GLOBALS['wgResourceModules']['ext.swl.watchlistconditions'] = $moduleTemplate + array(
				'styles' => array( 'specials/ext.swl.watchlistconditions.css' ),
				'scripts' => array(
					'specials/jquery.watchlistcondition.js',
					'specials/ext.swl.watchlistconditions.js'
				),
				'dependencies' => array(),
				'messages' => array(
					'swl-group-name',
					'swl-group-legend',
					'swl-group-properties',
					'swl-properties-list',
					'swl-group-remove-property',
					'swl-group-add-property',
					'swl-group-page-selection',
					'swl-group-save',
					'swl-group-saved',
					'swl-group-saving',
					'swl-group-remove',
					'swl-group-category',
					'swl-group-namespace',
					'swl-group-concept',
					'swl-group-confirm-remove',
					'swl-custom-legend',
					'swl-custom-remove-property',
					'swl-custom-text-add',
					'swl-custom-input',
				)
			);
	}

	/**
	 * @since 1.2
	 */
	public static function onExtensionFunction() {

		// Check requirements after LocalSetting.php has been processed, thid has
		// be done here to ensure SMW is loaded in case
		// wfLoadExtension( 'SemanticMediaWiki' ) is used
		self::checkRequirements();

		$configuration = array(
			'egSWLEnableTopLink'         => $GLOBALS['egSWLEnableTopLink'],
			'egSWLEnableEmailNotify'     => $GLOBALS['egSWLEnableEmailNotify'],
			'egSwlSqlDatabaseSchemaPath' => $GLOBALS['egSwlSqlDatabaseSchemaPath']
		);

		$hookRegistry = new HookRegistry(
			$configuration
		);

		$hookRegistry->register( $GLOBALS['wgHooks'] );
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
