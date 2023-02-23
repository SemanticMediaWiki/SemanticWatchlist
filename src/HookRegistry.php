<?php

namespace SWL;

use SWL\MediaWiki\Hooks\PersonalUrls;
use SWL\MediaWiki\Hooks\UserSaveOptions;
use SWL\MediaWiki\Hooks\GetPreferences;
use SWL\MediaWiki\Hooks\ExtensionSchemaUpdater;
use SWL\TableUpdater;
use MediaWiki\MediaWikiServices;
use MediaWiki\User\UserIdentity;
use User;
use Title;
use Language;

/**
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class HookRegistry {

	/**
	 * @var array
	 */
	private $configuration;

	/**
	 * @since 1.0
	 *
	 * @param array $configuration
	 */
	public function __construct( array $configuration ) {
		$this->configuration = $configuration;
	}

	/**
	 * @since  1.0
	 *
	 * @param array &$wgHooks
	 */
	public function register( &$wgHooks ) {

		$configuration = $this->configuration;

		$tableUpdater = new TableUpdater(
			new LazyDBConnectionProvider( DB_MASTER )
		);

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/SkinTemplateNavigation::Universal
		 */
		$wgHooks['SkinTemplateNavigation::Universal'][] =
			function( $skinTemplate, &$links ) use ( $configuration ) {

			$personalUrls = new PersonalUrls(
				$links['user-menu'],
				$skinTemplate->getTitle(),
				$skinTemplate->getUser(),
				MediaWikiServices::getInstance()->getUserOptionsManager()
			);

			$personalUrls->setConfiguration( $configuration );

			return $personalUrls->execute();
		};

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/SaveUserOptions
		 */
		$wgHooks['SaveUserOptions'][] = function(
			UserIdentity $user,
			array &$modifications,
			array $originalOptions
		) use ( $configuration, $tableUpdater ) {

			$userSaveOptions = new UserSaveOptions(
				$tableUpdater,
				$user,
				$modifications,
				$originalOptions
			);

			return $userSaveOptions->execute();
		};

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/LoadExtensionSchemaUpdates
		 */
		$wgHooks['LoadExtensionSchemaUpdates'][] = function( \DatabaseUpdater $databaseUpdater ) use ( $configuration ) {

			$extensionSchemaUpdater = new ExtensionSchemaUpdater(
				$databaseUpdater
			);

			$extensionSchemaUpdater->setConfiguration( $configuration );

			return $extensionSchemaUpdater->execute();
		};

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/GetPreferences
		 */
		$wgHooks['GetPreferences'][] = function( User $user, array &$preferences ) use ( $configuration ) {

			$userLanguage = Language::factory(
				$GLOBALS['wgLang']->getCode()
			);

			$getPreferences = new GetPreferences(
				$user,
				$userLanguage,
				$preferences
			);

			$getPreferences->setConfiguration( $configuration );

			return $getPreferences->execute();
		};

		$wgHooks['AdminLinks'][] = 'SWL\\Hooks::addToAdminLinks';
		$wgHooks['SMWStore::updateDataBefore'][] = 'SWL\\Hooks::onDataUpdate';

		if ( $configuration['egSWLEnableEmailNotify'] ) {
			$wgHooks['SWLGroupNotify'][] = 'SWL\\Hooks::onGroupNotify';
		}
	}

}
