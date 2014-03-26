<?php

namespace SWL\Tests\Integration;

use SWL\Setup;
use SWL\ServiceFactory;

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
class HooksRegistrationIntegrationTest extends \PHPUnit_Framework_TestCase {

	protected $wgHooks = array();
	protected $wgExtensionFunctions = array();
	protected $registryStatus = null;

	protected function setUp() {

		// Clears all pre-set hooks, the Setup routine will register only those
		// hooks that are relevant to SWL so that tests are executed without
		// influence of other extensions that use the same hook
		$this->wgHooks = $GLOBALS['wgHooks'];
		$this->wgExtensionFunctions = $GLOBALS['wgExtensionFunctions'];

		$GLOBALS['wgHooks'] = array();
		$GLOBALS['wgExtensionFunctions'] = array();
		Setup::getInstance()->setGlobalVars( $GLOBALS )->run();
		ServiceFactory::getInstance();

		parent::setUp();
	}

	protected function tearDown() {
		parent::tearDown();

		$GLOBALS['wgHooks'] = $this->wgHooks;
		$GLOBALS['wgExtensionFunctions'] = $this->wgExtensionFunctions;
		ServiceFactory::clear();
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
	public function testStoreUpdateDataBeforeHook() {

		$database = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->setMethods( array( 'select' ) )
			->getMockForAbstractClass();

		$database->expects( $this->atLeastOnce() )
			->method( 'select' )
			->will( $this->returnValue( array() ) );

		ServiceFactory::getInstance()->setDBConnection( DB_SLAVE, $database );

		$this->callExtensionFunctions();

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

		$this->assertArrayHasKey( 'SMWStore::updateDataBefore', $this->registryStatus );

		// @see #235 Store database needs mock to avoid unregulated DB access
	}

	/**
	 * @depends testExtensionHookRegistration
	 */
	public function testSwlGroupNotifyHook() {

		$this->callExtensionFunctions();

		$group = $this->getMockBuilder( '\SWLGroup' )
			->disableOriginalConstructor()
			->getMock();

		$changes = $this->getMockBuilder( '\SWLChangeSet' )
			->disableOriginalConstructor()
			->getMock();

		$userIds = array();

		\Hooks::run( 'SWL::GroupNotify', array( $group, $changes, $userIds ) );

		$this->assertArrayHasKey( 'SWL::GroupNotify', $this->registryStatus );
	}

	/**
	 * @depends testSwlGroupNotifyHook
	 */
	public function testSwlGroupNotifyHookCalledFromNotifyWatchingUsers() {

		$database = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->setMethods( array( 'select' ) )
			->getMockForAbstractClass();

		$database->expects( $this->atLeastOnce() )
			->method( 'select' )
			->will( $this->returnValue( array() ) );

		ServiceFactory::getInstance()->setDBConnection( DB_SLAVE, $database );

		$this->callExtensionFunctions();

		$changes = $this->getMockBuilder( '\SWLChangeSet' )
			->disableOriginalConstructor()
			->getMock();

		$changes->expects( $this->atLeastOnce() )
			->method( 'hasChanges' )
			->will( $this->returnValue( true ) );

		$dbResult = new \stdClass;
		$dbResult->group_id = 9999;
		$dbResult->group_name = 'foo';
		$dbResult->group_categories = '';
		$dbResult->group_namespaces = '';
		$dbResult->group_properties = '';
		$dbResult->group_concepts = '';
		$dbResult->group_custom_texts = '';

		$group = \SWLGroup::newFromDBResult( $dbResult );
		$group->notifyWatchingUsers( $changes );

		$this->assertArrayHasKey( 'SWL::GroupNotify', $this->registryStatus );
	}

	protected function callExtensionFunctions() {
		call_user_func_array(
			$GLOBALS['wgExtensionFunctions']['semantic-watchlist'],
			array( array( $this, 'reportRegistryStatus' ) )
		);
	}

	public function reportRegistryStatus( $key, $status ) {
		$this->registryStatus[ $key ] = $status;
	}

}
