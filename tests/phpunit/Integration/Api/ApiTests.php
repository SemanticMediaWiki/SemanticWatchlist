<?php

namespace MediaWiki\Extension\SemanticWatchlist\Tests\Integration\Api;

use ApiTestCase;

/**
 * @covers \SWL\Api\AddWatchlistGroup
 * @covers \SWL\Api\DeleteWatchlistGroup
 * @group Database
 */
class ApiTests extends ApiTestCase {

	protected function setUp(): void {
		parent::setUp();

		$this->setGroupPermissions( 'sysop', 'semanticwatchgroups', true );
	}

	// Basic test - create a group and then delete it
	public function testCreateDelete() {
		$result = $this->doApiRequestWithToken(
			[
				'action' => 'addswlgroup',
				'name' => 'SemanticWatchlistTest',
				'properties' => 'SemanticWatchlistTest',
				'namespaces' => 'Project',
			]
		)[0];
		$this->assertIsArray( $result );
		$this->assertArrayHasKey( 'success', $result );
		$this->assertTrue( $result['success'] );
		$this->assertArrayHasKey( 'group', $result );
		$group = $result['group'];
		$this->assertIsArray( $group );
		$this->assertArrayHasKey( 'id', $group );
		$this->assertIsInt( $group['id'] );
		$this->assertArrayHasKey( 'name', $group );
		$this->assertSame( 'SemanticWatchlistTest', $group['name'] );

		$result2 = $this->doApiRequestWithToken(
			[
				'action' => 'deleteswlgroup',
				'ids' => $group['id']
			]
		)[0];
		$this->assertSame(
			[
				'deleteswlgroup' => [ 'success' => true ],
			],
			$result2
		);
	}
}
