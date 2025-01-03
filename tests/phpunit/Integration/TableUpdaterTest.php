<?php

namespace SWL\Tests;

use MediaWikiIntegrationTestCase;
use \SWL\Group;
use \SWL\TableUpdater;

/**
 * @group semantic-watchlist
 * @group Database
 *
 * @author labster
 * @coversDefaultClass \SWL\TableUpdater
 */
class TableUpdaterTest extends MediaWikiIntegrationTestCase {

	protected function getSwlGroupForId ( $id ) {
		return new Group( $id, '', [], [], [], [], [] );
	}

	protected function getSwlUsersPerGroupTable ( $dbw ) {
		$res = $this->newSelectQueryBuilder()
			->select( 'upg_user_id', 'upg_group_id' )
			->from( 'swl_users_per_group' )
			->orderBy( [ 'upg_user_id', 'upg_group_id' ] )
			->fetchResultSet();
		// Destructure our result to make this easier to compare
		$result = [];
		foreach ( $res as $row ) {
			$result[] = [ $row->upg_user_id, $row->upg_group_id ];
		}
		return $result;
	}

	/**
	 * @covers \SWL\TableUpdater::updateGroupIdsForUser
	 * @covers \SWL\Group::getWatchingUsers
	 */
	public function updateGroupIdsTest () {
		$dbw = $this->getDb();

		$mockLazyDB = $this->getMockBuilder( '\SWL\LazyDBConnectionProvider' )
			->disableOriginalConstructor()
			->getMock();
		$mockLazyDB->expects( $this->any() )
			->method( 'getConnection' )
			->will( $this->returnValue( $dbw ) );

		$tableUpdater = new TableUpdater( $mockLazyDB );
		$self->truncateTable( 'swl_users_per_group' );

		$tableUpdater->updateGroupIdsForUser( 15, [ 999 ] );
		$this->assertSame(
			[ [ 15, 999 ] ],
			$this->getSwlUsersPerGroupTable( $dbw ),
			'Add a single entry for a new user'
		);

		$tableUpdater->updateGroupIdsForUser( 17, [ 999, 1000 ] );
		$this->assertSame(
			[
				[ 15, 999 ],
				[ 17, 999 ],
				[ 17, 1000 ],
			],
			$this->getSwlUsersPerGroupTable( $dbw ),
			'Add a multiple entry for a new user'
		);

		$tableUpdater->updateGroupIdsForUser( 15, [ 999, 1500, 1501 ] );
		$this->assertSame(
			[
				[ 15, 999 ],
				[ 15, 1500 ],
				[ 15, 1501 ],
				[ 17, 999 ],
				[ 17, 1000 ],
			],
			$this->getSwlUsersPerGroupTable( $dbw ),
			'Update an existing user'
		);

		$tableUpdater->updateGroupIdsForUser( 15, [ 1500, 1501 ] );
		$this->assertSame(
			[
				[ 15, 1500 ],
				[ 15, 1501 ],
				[ 17, 999 ],
				[ 17, 1000 ],
			],
			$this->getSwlUsersPerGroupTable( $dbw ),
			'Update an existing user to only remove one entry'
		);

		$tableUpdater->updateGroupIdsForUser( 17, [] );
		$this->assertSame(
			[
				[ 15, 1500 ],
				[ 15, 1501 ],
			],
			$this->getSwlUsersPerGroupTable( $dbw ),
			'Delete all entries from an existing user'
		);

		$tableUpdater->updateGroupIdsForUser( 21, [] );
		$this->assertSame(
			[
				[ 15, 1500 ],
				[ 15, 1501 ],
			],
			$this->getSwlUsersPerGroupTable( $dbw ),
			'Delete all entries from a user with no entries'
		);

		// Add some back in, and test fetching groups
		$tableUpdater->updateGroupIdsForUser( 17, [ 999, 1000, 1501 ] );
		$this->expectSame(
			[ 15 ],
			$this->getSwlGroupForId( 1500 )->getWatchingUsers(),
			"Found one watching user"
		);
		$this->expectSame(
			[ 15, 17 ],
			$this->getSwlGroupForId( 1501 )->getWatchingUsers(),
			"Found two watching users"
		);
		$this->expectSame(
			[ ],
			$this->getSwlGroupForId( 2700 )->getWatchingUsers(),
			"Found no watching users"
		);
	}
}
