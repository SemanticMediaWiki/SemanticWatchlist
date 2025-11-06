<?php

namespace SWL;

use SWL\MediaWiki\Hooks\SkinTemplateNavigationUniversal;
use SWL\MediaWiki\Hooks\SaveUserOptions;
use SWL\MediaWiki\Hooks\GetPreferences;
use SWL\MediaWiki\Hooks\ExtensionSchemaUpdater;
use SWL\TableUpdater;
use MediaWiki\HookContainer\HookContainer;
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
	 */
	public function register( HookContainer $hookContainer ) {

		$configuration = $this->configuration;

		$tableUpdater = new TableUpdater(
			new LazyDBConnectionProvider( DB_PRIMARY )
		);

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/SkinTemplateNavigation::Universal
		 */
		$hookContainer->register(
			'SkinTemplateNavigation::Universal',
				function ( $skinTemplate, &$links ) use ( $configuration ) {

				$linkHandler = new SkinTemplateNavigationUniversal(
					$links['user-menu'],
					$skinTemplate->getTitle(),
					$skinTemplate->getUser(),
					MediaWikiServices::getInstance()->getUserOptionsManager()
				);

				$linkHandler->setConfiguration( $configuration );

				return $linkHandler->execute();
			}
		);

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/SaveUserOptions
		 */
		$hookContainer->register(
			'SaveUserOptions',
			function (
				UserIdentity $user,
				array &$modifications,
				array $originalOptions
			) use ( $configuration, $tableUpdater ) {

				$saveUserOptions = new SaveUserOptions(
					$tableUpdater,
					$user,
					$modifications,
					$originalOptions
				);

				return $saveUserOptions->execute();
			}
		);

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/LoadExtensionSchemaUpdates
		 */
		$hookContainer->register(
			'LoadExtensionSchemaUpdates',
				function ( \DatabaseUpdater $databaseUpdater ) use ( $configuration ) {

				$extensionSchemaUpdater = new ExtensionSchemaUpdater(
					$databaseUpdater
				);

				$extensionSchemaUpdater->setConfiguration( $configuration );

				return $extensionSchemaUpdater->execute();
			}
		);

		/**
		 * @see https://www.mediawiki.org/wiki/Manual:Hooks/GetPreferences
		 */
		$hookContainer->register(
			'GetPreferences',
				function ( User $user, array &$preferences ) use ( $configuration ) {

				$userLanguage = MediaWikiServices::getInstance()->getLanguageFactory()->getLanguage(
					$GLOBALS['wgLang']->getCode()
				);

				$getPreferences = new GetPreferences(
					$user,
					$userLanguage,
					$preferences,
					MediaWikiServices::getInstance()->getNamespaceInfo()
				);

				$getPreferences->setConfiguration( $configuration );

				return $getPreferences->execute();
			}
		);

		$hookContainer->register( 'AdminLinks', 'SWL\\Hooks::addToAdminLinks' );
		$hookContainer->register( 'SMWStore::updateDataBefore', 'SWL\\Hooks::onDataUpdate' );

		if ( $configuration['egSWLEnableEmailNotify'] ) {
			$hookContainer->register( 'SWLGroupNotify', 'SWL\\Hooks::onGroupNotify' );
		}
	}

}
