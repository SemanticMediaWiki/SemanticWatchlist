<?php

namespace SWL;

use SWL\MediaWiki\Hooks\PersonalUrls;
use SWL\MediaWiki\Hooks\UserSaveOptions;
use SWL\MediaWiki\Hooks\GetPreferences;
use SWL\MediaWiki\Hooks\ExtensionSchemaUpdater;
use SWL\Database\DatabaseUpdater;

use User;
use Title;
use Language;

/**
 * @ingroup SWL
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class Setup {

	/** @var array */
	protected $globalVars;
	protected $rootPath;

	/**
	 * @since 1.2.0
	 *
	 * @param array $globalVars
	 * @param string $rootPath
	 */
	public function __construct( array &$globalVars, $rootPath ) {
		$this->globalVars =& $globalVars;
		$this->rootPath = $rootPath;
	}

	/**
	 * @since 1.0
	 *
	 * @return boolean
	 */
	public function run() {
		$this->deferredHookRegistration();
	}

	protected function deferredHookRegistration() {

		// FIXME PHP 5.3 doesn't allow to use $this reference within a closure
		// when 5.3 is obsolete use $this instead (PHP 5.4+)
		$globalVars = $this->globalVars;

		$this->globalVars['wgExtensionFunctions']['semantic-watchlist'] = function() use( $globalVars ) {

			/**
			 * Collect only relevant configuration parameters
			 *
			 * @since 1.0
			 */
			$configuration = array(
				'egSWLEnableTopLink'         => $globalVars['egSWLEnableTopLink'],
				'egSWLEnableEmailNotify'     => $globalVars['egSWLEnableEmailNotify'],
				'egSwlSqlDatabaseSchemaPath' => $globalVars['egSwlSqlDatabaseSchemaPath']
			);

			$wgLang = $globalVars['wgLang'];

			/**
			 * Called after the personal URLs have been set up, before they are shown
			 *
			 * @since 1.0
			 */
			$globalVars['wgHooks']['PersonalUrls'][] = function( array &$personal_urls, \Title $title, \SkinTemplate $skin ) use ( $configuration ) {

				$personalUrls = new PersonalUrls( $personal_urls, $title, $skin->getUser() );
				$personalUrls->setConfiguration( $configuration );

				return $personalUrls->execute();
			};

			/**
			 * Called just before saving user preferences/options
			 *
			 * @since 1.0
			 */
			$globalVars['wgHooks']['UserSaveOptions'][] = function( \User $user, array &$options ) use ( $configuration ) {

				$databaseUpdater = new DatabaseUpdater( wfGetDB( DB_MASTER ) );

				$userSaveOptions = new UserSaveOptions( $databaseUpdater, $user, $options );
				$userSaveOptions->setConfiguration( $configuration );

				return $userSaveOptions->execute();
			};

			/**
			 * Fired when MediaWiki is updated to allow extensions to update the database
			 *
			 * @since 1.0
			 */
			$globalVars['wgHooks']['LoadExtensionSchemaUpdates'][] = function( \DatabaseUpdater $updater ) use ( $configuration ) {

				$extensionSchemaUpdater = new ExtensionSchemaUpdater( $updater );
				$extensionSchemaUpdater->setConfiguration( $configuration );

				return $extensionSchemaUpdater->execute();
			};

			/**
			 * Modify user preferences
			 *
			 * @since 1.0
			 */
			$globalVars['wgHooks']['GetPreferences'][] = function( User $user, array &$preferences ) use ( $configuration, $wgLang ) {

				$userLanguage = Language::factory( $wgLang->getCode() );

				$getPreferences = new GetPreferences( $user, $userLanguage, $preferences );
				$getPreferences->setConfiguration( $configuration );

				return $getPreferences->execute();
			};

			$globalVars['wgHooks']['AdminLinks'][] = 'SWLHooks::addToAdminLinks';
			$globalVars['wgHooks']['SMWStore::updateDataBefore'][] = 'SWLHooks::onDataUpdate';

			if ( $globalVars['egSWLEnableEmailNotify'] ) {
				$globalVars['wgHooks']['SWLGroupNotify'][] = 'SWLHooks::onGroupNotify';
			}

			return true;
		};
	}

}
