<?php

/**
 * Initialization file for the Semantic Watchlist extension.
 *
 * Documentation: 	https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * Support		https://www.mediawiki.org/wiki/Extension_talk:Semantic_Watchlist
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
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

define( 'SemanticWatchlist_VERSION', '1.1.0 alpha' );

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

$egSWLScriptPath = $wgExtensionAssetsPath === false ? $wgScriptPath . '/extensions/SemanticWatchlist' : $wgExtensionAssetsPath . '/SemanticWatchlist';

$wgMessagesDirs['SemanticWatchlist'] = __DIR__ . '/i18n';
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

$wgHooks['LoadExtensionSchemaUpdates'][] = 'SWLHooks::onSchemaUpdate';
$wgHooks['SMWStore::updateDataBefore'][] = 'SWLHooks::onDataUpdate';
$wgHooks['GetPreferences'][] = 'SWLHooks::onGetPreferences';
$wgHooks['UserSaveOptions'][] = 'SWLHooks::onUserSaveOptions';
$wgHooks['PersonalUrls'][] = 'SWLHooks::onPersonalUrls';

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

$wgAvailableRights[] = 'semanticwatch';
$wgAvailableRights[] = 'semanticwatchgroups';

if ( $egSWLEnableEmailNotify ) {
	$wgHooks['SWLGroupNotify'][] = 'SWLHooks::onGroupNotify';
}
