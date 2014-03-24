<?php

namespace SWL;

use SWL\MediaWiki\Hooks\PersonalUrls;
use SWL\MediaWiki\Hooks\UserSaveOptions;
use SWL\MediaWiki\Hooks\GetPreferences;
use SWL\MediaWiki\Hooks\ExtensionSchemaUpdater;

/**
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class Setup {

	/** @var array */
	protected $globalVars;

	/**
	 * @since 1.0
	 *
	 * @return Extension
	 */
	public static function getInstance() {
		return new self();
	}

	/**
	 * @since 1.0
	 *
	 * @param array $globalVars
	 *
	 * @return Extension
	 */
	public function setGlobalVars( &$globalVars ) {
		$this->globalVars =& $globalVars;
		return $this;
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

			$language = $globalVars['wgLang'];

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

				$userSaveOptions = new UserSaveOptions( $user, $options );
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
			$globalVars['wgHooks']['GetPreferences'][] = function( User $user, array &$preferences ) use ( $configuration, $language ) {

				$getPreferences = new GetPreferences( $user, $language, $preferences );
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
