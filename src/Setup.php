<?php

namespace SWL;

use SWL\MediaWiki\Hooks\PersonalUrls;
use SWL\MediaWiki\Hooks\UserSaveOptions;
use SWL\MediaWiki\Hooks\GetPreferences;
use SWL\MediaWiki\Hooks\ExtensionSchemaUpdater;
use SWL\MediaWiki\Hooks\StoreUpdateDataBefore;
use SWL\MediaWiki\Hooks\GroupNotify;

use User;
use Title;
use Language;

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

		// FIXME PHP 5.3 doesn't allow to use $this reference within a closure
		// when 5.3 is obsolete use $this instead (PHP 5.4+)
		$globalVars = $this->globalVars;

		$this->globalVars['wgExtensionFunctions']['semantic-watchlist'] = function( $reporter = null ) use( $globalVars ) {

			/**
			 * Collect only relevant configuration parameters
			 *
			 * @since 1.0
			 */
			$configuration = array(
				'egSWLEnableTopLink'         => $globalVars['egSWLEnableTopLink'],
				'egSWLEnableEmailNotify'     => $globalVars['egSWLEnableEmailNotify'],
				'egSwlSqlDatabaseSchemaPath' => $globalVars['egSwlSqlDatabaseSchemaPath'],
				'egSWLMailPerChange'         => $globalVars['egSWLMailPerChange'],
				'egSWLMaxMails'              => $globalVars['egSWLMaxMails'],
				'egSWLEnableSelfNotify'      => $globalVars['egSWLEnableSelfNotify']
			);

			$lang = $globalVars['wgLang'];
			$user = $globalVars['wgUser'];

			$observableReporter = new ObservableReporter;
			$observableReporter->registerCallback( $reporter );

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
			$globalVars['wgHooks']['GetPreferences'][] = function( User $user, array &$preferences ) use ( $configuration, $lang ) {

				$userLanguage = Language::factory( $lang->getCode() );

				$getPreferences = new GetPreferences( $user, $userLanguage, $preferences );
				$getPreferences->setConfiguration( $configuration );

				return $getPreferences->execute();
			};

			/**
			 * Modify user preferences
			 *
			 * @since 1.0
			 */
			$globalVars['wgHooks']['SMWStore::updateDataBefore'][] = function( \SMW\Store $store, \SMW\SemanticData $semanticData ) use ( $configuration, $user, $observableReporter ) {

				$updateDataBefore = new StoreUpdateDataBefore( $store, $semanticData, $user );
				$updateDataBefore->setConfiguration( $configuration );
				$updateDataBefore->setReporter( $observableReporter );

				return $updateDataBefore->execute();
			};

			/**
			 * Notify groups
			 *
			 * @since 1.0
			 */
			$globalVars['wgHooks']['SWL::GroupNotify'][] = function( \SWLGroup $group, \SWLChangeSet $changes, array $userIds ) use ( $configuration, $observableReporter ) {

				$groupNotify = new GroupNotify( $group, $changes, $userIds );
				$groupNotify->setConfiguration( $configuration );
				$groupNotify->setReporter( $observableReporter );
				$groupNotify->setAnonymousUser( new User );

				return $groupNotify->execute();
			};

			$globalVars['wgHooks']['AdminLinks'][] = 'SWLHooks::addToAdminLinks';

			return true;
		};
	}

}
