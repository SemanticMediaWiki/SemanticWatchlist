<?php

namespace SWL\Tests;

use SWL\TableUpdater;

/**
 * @covers \SWL\TableUpdater
 *
 * @group semantic-watchlist
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class TableUpdaterTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		if ( version_compare( $GLOBALS[ 'wgVersion' ], '1.28', 'gt' ) ) {
			$this->markTestSkipped(
				'Test broken on MW > 1.27, see https://github.com/SemanticMediaWiki/SemanticWatchlist/issues/71'
			);
		}
	}

	public function testCanConstruct() {

		$connectionProvider = $this->getMockBuilder( '\SWL\LazyDBConnectionProvider' )
			->disableOriginalConstructor()
			->getMock();

		$this->assertInstanceOf(
			'\SWL\TableUpdater',
			new TableUpdater( $connectionProvider )
		);
	}

	public function testUpdateGroupIdsForUserToReplaceDatasetByUserId() {

		$userId = 1111;
		$groupIds = array( 1, 9999 );

		$connection = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->setMethods( array( 'isOpen', 'delete', 'insert' ) )
			->getMockForAbstractClass();

		$connection->expects( $this->once() )
			->method( 'delete' )
			->with(
				$this->equalTo( 'swl_users_per_group' ),
				$this->equalTo( array( 'upg_user_id' => $userId ) ) );

		$connection->expects( $this->any() )
			->method( 'isOpen' )
			->will( $this->returnValue( true ) );

		$connection->expects( $this->at( 2 ) )
			->method( 'insert' )
			->will( $this->returnValue( true ) );

		$connectionProvider = $this->getMockBuilder( '\SWL\LazyDBConnectionProvider' )
			->disableOriginalConstructor()
			->getMock();

		$connectionProvider->expects( $this->any() )
			->method( 'getConnection' )
			->will( $this->returnValue( $connection ) );

		$instance = new TableUpdater( $connectionProvider );

		$this->assertTrue(
			$instance->updateGroupIdsForUser( $userId, $groupIds )
		);
	}

	public function testUpdateGroupIdsForUserToOnlyDeleteDatasetByUserId() {

		$userId = 1111;
		$groupIds = array();

		$connection = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->setMethods( array( 'isOpen', 'delete', 'insert' ) )
			->getMockForAbstractClass();

		$connection->expects( $this->once() )
			->method( 'delete' )
			->with(
				$this->equalTo( 'swl_users_per_group' ),
				$this->equalTo( array( 'upg_user_id' => $userId ) ) );

		$connection->expects( $this->any() )
			->method( 'isOpen' )
			->will( $this->returnValue( true ) );

		$connection->expects( $this->never() )
			->method( 'insert' )
			->will( $this->returnValue( true ) );

		$connectionProvider = $this->getMockBuilder( '\SWL\LazyDBConnectionProvider' )
			->disableOriginalConstructor()
			->getMock();

		$connectionProvider->expects( $this->any() )
			->method( 'getConnection' )
			->will( $this->returnValue( $connection ) );

		$instance = new TableUpdater( $connectionProvider );

		$this->assertTrue(
			$instance->updateGroupIdsForUser( $userId, $groupIds )
		);
	}

}
