<?php

namespace SWL\Tests\MediaWiki\Hooks;

use SWL\Database\DatabaseUpdater;

/**
 * @covers \SWL\Database\DatabaseUpdater
 *
 * @ingroup Test
 *
 * @group SWL
 * @group SWLExtension
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class DatabaseUpdaterTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {

		$dbConnection = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->getMockForAbstractClass();

		$this->assertInstanceOf(
			'\SWL\Database\DatabaseUpdater',
			new DatabaseUpdater( $dbConnection )
		);
	}

	public function testUpdateUsersPerGroupWithGroupIdsToReplaceDatasetByUserId() {

		$userId = 1111;
		$groupIds = array( 1, 9999 );

		$dbConnection = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->setMethods( array( 'delete', 'insert' ) )
			->getMockForAbstractClass();

		$dbConnection->expects( $this->once() )
			->method( 'delete' )
			->with(
				$this->equalTo( 'swl_users_per_group' ),
				$this->equalTo( array( 'upg_user_id' => $userId ) ) );

		$dbConnection->expects( $this->at( 2 ) )
			->method( 'insert' )
			->will( $this->returnValue( true ) );

		$instance = new DatabaseUpdater( $dbConnection );

		$this->assertTrue( $instance->updateUsersPerGroupWithGroupIds( $userId, $groupIds ) );
	}

	public function testUpdateUsersPerGroupWithGroupIdsToOnlyDeleteDatasetByUserId() {

		$userId = 1111;
		$groupIds = array();

		$dbConnection = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->setMethods( array( 'delete', 'insert' ) )
			->getMockForAbstractClass();

		$dbConnection->expects( $this->once() )
			->method( 'delete' )
			->with(
				$this->equalTo( 'swl_users_per_group' ),
				$this->equalTo( array( 'upg_user_id' => $userId ) ) );

		$dbConnection->expects( $this->never() )
			->method( 'insert' )
			->will( $this->returnValue( true ) );

		$instance = new DatabaseUpdater( $dbConnection );

		$this->assertTrue( $instance->updateUsersPerGroupWithGroupIds( $userId, $groupIds ) );
	}

}
