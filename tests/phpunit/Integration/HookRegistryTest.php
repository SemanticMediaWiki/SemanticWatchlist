<?php

namespace SWL\Tests;

use MediaWiki\HookContainer\HookContainer;
use MediaWikiIntegrationTestCase;
use SWL\HookRegistry;
use SMW\DIWikiPage;
use Title;

/**
 * @covers \SWL\HookRegistry
 * @group semantic-watchlist
 * @group Database
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class HookRegistryTest extends MediaWikiIntegrationTestCase {

	public function testCanConstruct() {

		$this->assertInstanceOf(
			'\SWL\HookRegistry',
			new HookRegistry( [] )
		);
	}

	public function testRegister() {

		$language = $this->getMockBuilder( '\Language' )
			->disableOriginalConstructor()
			->getMock();

		$language->expects( $this->any() )
			->method( 'getCode' )
			->will( $this->returnValue( 'en' ) );

		$user = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$configuration = [
			'egSWLEnableTopLink'         => false,
			'egSWLEnableEmailNotify'     => false,
			'egSwlSqlDatabaseSchemaPath' => '../foo',
			'wgLang' => $language
		];

		$instance = new HookRegistry( $configuration );

		$hooks = $this->getServiceContainer()->getHookContainer();
		// Clear existing handlers so that only the ones from SWL are there
		$hooks->clear( 'SkinTemplateNavigation::Universal' );
		$hooks->clear( 'SaveUserOptions' );
		$hooks->clear( 'LoadExtensionSchemaUpdates' );
		$hooks->clear( 'GetPreferences' );
		$hooks->clear( 'SMWStore::updateDataBefore' );
		$instance->register( $hooks );

		$this->doTestSkinTemplateNavigationUniversal( $hooks, $user );
		$this->doTestSaveUserOptions( $hooks, $user );
		$this->doTestLoadExtensionSchemaUpdates( $hooks );
		$this->doTestGetPreferences( $hooks, $user );
		$this->doTestStoreUpdate( $hooks );
	}

	private function doTestSkinTemplateNavigationUniversal( $hooks, $user ) {

		$title = $this->getMockBuilder( '\Title' )
			->disableOriginalConstructor()
			->getMock();

		$skinTemplate = $this->getMockBuilder( '\SkinTemplate' )
			->disableOriginalConstructor()
			->getMock();

		$skinTemplate->expects( $this->any() )
			->method( 'getUser' )
			->will( $this->returnValue( $user ) );

		$skinTemplate->expects( $this->any() )
			->method( 'getTitle' )
			->will( $this->returnValue( $title ) );

		$personal_urls = [];

		$this->assertThatHookIsExcutable(
			$hooks,
			'SkinTemplateNavigation::Universal',
			[ $skinTemplate, &$personal_urls ]
		);
	}

	private function doTestSaveUserOptions( $hooks, $user ) {

		$options = [];
		$modifications = [];

		$this->assertThatHookIsExcutable(
			$hooks,
			'SaveUserOptions',
			[ $user, &$modifications, &$options ]
		);
	}

	private function doTestLoadExtensionSchemaUpdates( $hooks ) {

		$database = $this->getMockBuilder( '\Wikimedia\Rdbms\Database' )
			->disableOriginalConstructor()
			->getMockForAbstractClass();

		$databaseUpdater = $this->getMockBuilder( '\DatabaseUpdater' )
			->disableOriginalConstructor()
			->setMethods( [ 'getDB' ] )
			->getMockForAbstractClass();

		$databaseUpdater->expects( $this->any() )
			->method( 'getDB' )
			->will( $this->returnValue( $database ) );

		$this->assertThatHookIsExcutable(
			$hooks,
			'LoadExtensionSchemaUpdates',
			[ $databaseUpdater ]
		);
	}

	private function doTestGetPreferences( $hooks, $user ) {

		$preferences = [];

		$this->assertThatHookIsExcutable(
			$hooks,
			'GetPreferences',
			[ $user, &$preferences ]
		);
	}

	public function doTestStoreUpdate( $hooks ) {

		$subject = DIWikiPage::newFromTitle( Title::newFromText( __METHOD__ ) );

		$semanticData = $this->getMockBuilder( '\SMW\SemanticData' )
			->disableOriginalConstructor()
			->getMock();

		$semanticData->expects( $this->any() )
			->method( 'getSubject' )
			->will( $this->returnValue( $subject ) );

		$semanticData->expects( $this->any() )
			->method( 'getPropertyValues' )
			->will( $this->returnValue( [] ) );

		$semanticData->expects( $this->any() )
			->method( 'getProperties' )
			->will( $this->returnValue( [] ) );

		$store = $this->getMockBuilder( '\SMW\Store' )
			->disableOriginalConstructor()
			->getMockForAbstractClass();

		$store->expects( $this->any() )
			->method( 'getSemanticData' )
			->will( $this->returnValue( $semanticData ) );

		$this->assertThatHookIsExcutable(
			$hooks,
			'SMWStore::updateDataBefore',
			[ $store, $semanticData ]
		);
	}

	private function assertThatHookIsExcutable( $hooks, $hookName, $arguments ) {
		$this->assertIsBool(
			$hooks->run( $hookName, $arguments )
		);
	}

}
