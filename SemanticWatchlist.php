<?php

/**
 * Initialization file for the Semantic Watchlist extension.
 * 
 * Documentation: 	https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * Support		https://www.mediawiki.org/wiki/Extension_talk:Semantic_Watchlist
 * Source code:		http://git.wikimedia.org/tree/mediawiki%2Fextensions%2FSemanticWatchlist
 *
 * @file SemanticWatchlist.php
 * @ingroup SemanticWatchlist
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

/**
 * This documentation group collects source code files belonging to Semantic Watchlist.
 *
 * @defgroup SemanticWatchlist Semantic Watchlist
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( version_compare( $wgVersion, '1.17', '<' ) ) {
	die( '<b>Error:</b> Semantic Watchlist requires MediaWiki 1.17 or above.' );
}

// Show a warning if Semantic MediaWiki is not loaded.
if ( ! defined( 'SMW_VERSION' ) ) {
	die( '<b>Error:</b> You need to have <a href="http://semantic-mediawiki.org/wiki/Semantic_MediaWiki">Semantic MediaWiki</a> installed in order to use Semantic Watchlist.' );
}

if ( version_compare( SMW_VERSION, '1.6 alpha', '<' ) ) {
	die( '<b>Error:</b> Semantic Watchlist requires Semantic MediaWiki 1.6 or above.' );
}

define( 'SemanticWatchlist_VERSION', '0.2.2' );

$wgExtensionCredits['semantic'][] = array(
	'path' => __FILE__,
	'name' => 'Semantic Watchlist',
	'version' => SemanticWatchlist_VERSION,
	'author' => array(
		'[http://www.mediawiki.org/wiki/User:Jeroen_De_Dauw Jeroen De Dauw] for [http://www.wikiworks.com/ WikiWorks]',
	),
	'url' => 'https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist',
	'descriptionmsg' => 'semanticwatchlist-desc'
);

$egSWLScriptPath = $GLOBALS['wgExtensionAssetsPath'] === false ? $GLOBALS['wgScriptPath'] . '/extensions/SemanticWatchlist' : $GLOBALS['wgExtensionAssetsPath'] . '/SemanticWatchlist';

$wgExtensionMessagesFiles['SemanticWatchlist']	  	= dirname( __FILE__ ) . '/SemanticWatchlist.i18n.php';
$wgExtensionMessagesFiles['SemanticWatchlistAlias']	= dirname( __FILE__ ) . '/SemanticWatchlist.i18n.alias.php';

$wgAutoloadClasses['SWLHooks']					  	= dirname( __FILE__ ) . '/SemanticWatchlist.hooks.php';

$wgAutoloadClasses['ApiAddWatchlistGroup']		  	= dirname( __FILE__ ) . '/api/ApiAddWatchlistGroup.php';
$wgAutoloadClasses['ApiDeleteWatchlistGroup']		= dirname( __FILE__ ) . '/api/ApiDeleteWatchlistGroup.php';
$wgAutoloadClasses['ApiEditWatchlistGroup']		 	= dirname( __FILE__ ) . '/api/ApiEditWatchlistGroup.php';
$wgAutoloadClasses['ApiQuerySemanticWatchlist']	 	= dirname( __FILE__ ) . '/api/ApiQuerySemanticWatchlist.php';

$wgAutoloadClasses['SWLChangeSet']		  			= dirname( __FILE__ ) . '/includes/SWL_ChangeSet.php';
$wgAutoloadClasses['SWLEdit']		  				= dirname( __FILE__ ) . '/includes/SWL_Edit.php';
$wgAutoloadClasses['SWLEmailer']		  			= dirname( __FILE__ ) . '/includes/SWL_Emailer.php';
$wgAutoloadClasses['SWLGroup']		  				= dirname( __FILE__ ) . '/includes/SWL_Group.php';
$wgAutoloadClasses['SWLGroups']		  				= dirname( __FILE__ ) . '/includes/SWL_Groups.php';
$wgAutoloadClasses['SWLPropertyChange']		  		= dirname( __FILE__ ) . '/includes/SWL_PropertyChange.php';
$wgAutoloadClasses['SWLPropertyChanges']		  	= dirname( __FILE__ ) . '/includes/SWL_PropertyChanges.php';
$wgAutoloadClasses['SWLCustomTexts']		  		= dirname( __FILE__ ) . '/includes/SWL_CustomTexts.php';

$wgAutoloadClasses['SpecialSemanticWatchlist']	  	= dirname( __FILE__ ) . '/specials/SpecialSemanticWatchlist.php';
$wgAutoloadClasses['SpecialWatchlistConditions']	= dirname( __FILE__ ) . '/specials/SpecialWatchlistConditions.php';

$wgSpecialPages['SemanticWatchlist'] = 'SpecialSemanticWatchlist';
$wgSpecialPageGroups['SemanticWatchlist'] = 'changes';

$wgSpecialPages['WatchlistConditions'] = 'SpecialWatchlistConditions';
$wgSpecialPageGroups['WatchlistConditions'] = 'changes';

$wgAPIModules['addswlgroup'] = 'ApiAddWatchlistGroup';
$wgAPIModules['deleteswlgroup'] = 'ApiDeleteWatchlistGroup';
$wgAPIModules['editswlgroup'] = 'ApiEditWatchlistGroup';
$wgAPIListModules['semanticwatchlist'] = 'ApiQuerySemanticWatchlist';

$wgHooks['SMWStore::updateDataBefore'][] = 'SWLHooks::onDataUpdate';
$wgHooks['GetPreferences'][] = 'SWLHooks::onGetPreferences';

// Admin Links hook needs to be called in a delayed way so that it
// will always be called after SMW's Admin Links addition; as of
// SMW 1.9, SMW delays calling all its hook functions.
$wgExtensionFunctions[] = 'SWLAddAdminLinksHook';
function SWLAddAdminLinksHook() {
	global $wgHooks;
	$wgHooks['AdminLinks'][] = 'SWLHooks::addToAdminLinks';
}

$moduleTemplate = array(
	'localBasePath' => dirname( __FILE__ ),
	'remoteBasePath' => $egSWLScriptPath
);

$wgResourceModules['ext.swl.watchlist'] = $moduleTemplate + array(
	'styles' => array( 'specials/ext.swl.watchlist.css' ),
	'scripts' => array(
	),
	'dependencies' => array(),
	'messages' => array(
	)
);

$wgResourceModules['ext.swl.watchlistconditions'] = $moduleTemplate + array(
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

require_once 'SemanticWatchlist.settings.php';

// This overrides the default value for the setting in SMW, as the behaviour it enables is used by this extension.
$smwgCheckChangesBeforeUpdate = true;

$wgAvailableRights[] = 'semanticwatch';
$wgAvailableRights[] = 'semanticwatchgroups';

if ( $egSWLEnableEmailNotify ) {
	$wgHooks['SWLGroupNotify'][] = 'SWLHooks::onGroupNotify';
}

// TEMPORARY until the Composer classmap is fixed
$GLOBALS['wgAutoloadClasses']['SWL\Database\DatabaseUpdater']               = __DIR__ . '/src/Database/DatabaseUpdater.php';
$GLOBALS['wgAutoloadClasses']['SWL\MediaWiki\HookInterface']                = __DIR__ . '/src/MediaWiki/HookInterface.php';
$GLOBALS['wgAutoloadClasses']['SWL\MediaWiki\Hooks\PersonalUrls']           = __DIR__ . '/src/MediaWiki/Hooks/PersonalUrls.php';
$GLOBALS['wgAutoloadClasses']['SWL\MediaWiki\Hooks\UserSaveOptions']        = __DIR__ . '/src/MediaWiki/Hooks/UserSaveOptions.php';
$GLOBALS['wgAutoloadClasses']['SWL\MediaWiki\Hooks\ExtensionSchemaUpdater'] = __DIR__ . '/src/MediaWiki/Hooks/ExtensionSchemaUpdater.php';

$GLOBALS['egSwlSqlDatabaseSchemaPath'] = __DIR__ . '/src/Database/SqlDatabaseSchema.sql';

/**
 * Setup and initialization
 *
 * @since 1.0
 */
$GLOBALS['wgExtensionFunctions']['semantic-watchlist'] = function() {

	/**
	 * Collect only relevant configuration parameters
	 *
	 * @since 1.0
	 */
	$configuration = array(
		'egSWLEnableTopLink'         => $GLOBALS['egSWLEnableTopLink'],
		'egSwlSqlDatabaseSchemaPath' => $GLOBALS['egSwlSqlDatabaseSchemaPath']
	);

	/**
	 * Called after the personal URLs have been set up, before they are shown
	 *
	 * @since 1.0
	 */
	$GLOBALS['wgHooks']['PersonalUrls'][] = function( array &$personal_urls, Title $title, SkinTemplate $skin ) use ( $configuration ) {

		$personalUrls = new \SWL\MediaWiki\Hooks\PersonalUrls( $personal_urls, $title, $skin->getUser() );
		$personalUrls->setConfiguration( $configuration );

		return $personalUrls->execute();
	};

	/**
	 * Called just before saving user preferences/options
	 *
	 * @since 1.0
	 */
	$GLOBALS['wgHooks']['UserSaveOptions'][] = function( User $user, array &$options ) use ( $configuration ) {

		$userSaveOptions = new \SWL\MediaWiki\Hooks\UserSaveOptions( $user, $options );
		$userSaveOptions->setConfiguration( $configuration );

		return $userSaveOptions->execute();
	};

	/**
	 * Fired when MediaWiki is updated to allow extensions to update the database
	 *
	 * @since 1.0
	 */
	$GLOBALS['wgHooks']['LoadExtensionSchemaUpdates'][] = function( DatabaseUpdater $updater ) use ( $configuration ) {

		$extensionSchemaUpdater = new \SWL\MediaWiki\Hooks\ExtensionSchemaUpdater( $updater );
		$extensionSchemaUpdater->setConfiguration( $configuration );

		return $extensionSchemaUpdater->execute();
	};

	return true;
};
