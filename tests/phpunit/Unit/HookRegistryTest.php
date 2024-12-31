<?php

namespace SWL\Tests;

use SWL\HookRegistry;
use SMW\DIWikiPage;
use Title;

/**
 * @covers \SWL\HookRegistry
 * @group semantic-watchlist
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class HookRegistryTest extends \PHPUnit\Framework\TestCase {

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

		$wgHooks = [];

		$instance = new HookRegistry( $configuration );
		$instance->register( $wgHooks );

		$this->assertNotEmpty(
			$wgHooks
		);

		$this->doTestSkinTemplateNavigationUniversal( $wgHooks, $user );
		$this->doTestSaveUserOptions( $wgHooks, $user );
		$this->doTestLoadExtensionSchemaUpdates( $wgHooks );
		$this->doTestGetPreferences( $wgHooks, $user );
		$this->doTestStoreUpdate( $wgHooks );
	}

	private function doTestSkinTemplateNavigationUniversal( $wgHooks, $user ) {

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
			$wgHooks,
			'SkinTemplateNavigation::Universal',
			[ $skinTemplate, &$personal_urls ]
		);
	}

	private function doTestSaveUserOptions( $wgHooks, $user ) {

		$options = [];
		$modifications = [];

		$this->assertThatHookIsExcutable(
			$wgHooks,
			'SaveUserOptions',
			[ $user, &$modifications, &$options ]
		);
	}

	private function doTestLoadExtensionSchemaUpdates( $wgHooks ) {

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
			$wgHooks,
			'LoadExtensionSchemaUpdates',
			[ $databaseUpdater ]
		);
	}

	private function doTestGetPreferences( $wgHooks, $user ) {

		$preferences = [];

		$this->assertThatHookIsExcutable(
			$wgHooks,
			'GetPreferences',
			[ $user, &$preferences ]
		);
	}

	public function doTestStoreUpdate( $wgHooks ) {

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
			$wgHooks,
			'SMWStore::updateDataBefore',
			[ $store, $semanticData ]
		);
	}

	private function assertThatHookIsExcutable( $wgHooks, $hookName, $arguments ) {
		foreach ( $wgHooks[ $hookName ] as $hook ) {
			$this->assertIsBool(
				call_user_func_array( $hook, $arguments )
			);
		}
	}

}
