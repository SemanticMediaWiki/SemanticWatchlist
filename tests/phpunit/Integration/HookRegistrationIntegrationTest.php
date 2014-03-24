<?php

namespace SWL\Tests\Integration;

use SWL\Setup;
use SMW\StoreFactory;
use SMW\SemanticData;
use SMW\DIWikiPage;

use Title;

/**
 * @ingroup Test
 *
 * @group SWL
 * @group SWLExtension
 * @group IntegrationTest
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class HookRegistrationIntegrationTest extends \PHPUnit_Framework_TestCase {

	protected $wgHooks = array();
	protected $wgExtensionFunctions = array();

	protected function setUp() {

		// Clears all pre-set hooks, the Setup routine will register only those
		// hooks that are relevant to SWL so that tests are executed without
		// influence of other extensions that use the same hook
		$this->wgHooks = $GLOBALS['wgHooks'];
		$this->wgExtensionFunctions = $GLOBALS['wgExtensionFunctions'];

		$GLOBALS['wgHooks'] = array();
		$GLOBALS['wgExtensionFunctions'] = array();
		Setup::getInstance()->setGlobalVars( $GLOBALS )->run();

		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();

		$GLOBALS['wgHooks'] = $this->wgHooks;
		$GLOBALS['wgExtensionFunctions'] = $this->wgExtensionFunctions;
	}

	public function testExtensionHookRegistration() {

		$registry = $GLOBALS['wgExtensionFunctions']['semantic-watchlist'];

		$this->assertTrue( is_callable( $registry ) );
		$this->assertTrue( call_user_func( $registry) );
	}

	/**
	 * @depends testExtensionHookRegistration
	 *
	 * @note Running atLeastOnce() will confirm that the update was executed
	 * together with the registered SWL hook. It will not test any particulars
	 * of the invoked hook and only verify that hook did not cause any failures
	 * when run together with the Store updater.
	 */
	public function testStoreUpdateHookInterfaceInitialization() {

		call_user_func( $GLOBALS['wgExtensionFunctions']['semantic-watchlist'] );

		$this->assertArrayHasKey( 'SMWStore::updateDataBefore', $GLOBALS['wgHooks'] );

		$semanticData = $this->getMockBuilder( '\SMW\SemanticData' )
			->disableOriginalConstructor()
			->getMock();

		$semanticData->expects( $this->atLeastOnce() )
			->method( 'getSubject' )
			->will( $this->returnValue(
				DIWikiPage::newFromTitle( Title::newFromText( __METHOD__ ) ) ) );

		$semanticData->expects( $this->atLeastOnce() )
			->method( 'getPropertyValues' )
			->will( $this->returnValue( array() ) );

		$semanticData->expects( $this->atLeastOnce() )
			->method( 'getProperties' )
			->will( $this->returnValue( array() ) );

		$semanticData->expects( $this->atLeastOnce() )
			->method( 'getSubSemanticData' )
			->will( $this->returnValue( array() ) );

		StoreFactory::clear();
		StoreFactory::getStore()->updateData( $semanticData );

		// @see #235 Store database needs mock to avoid unregulated DB access
	}

}
