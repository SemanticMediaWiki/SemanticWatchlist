<?php

namespace SWL\Tests\Integration\Special;

use MediaWiki\SpecialPage\SpecialPage;
use MediaWiki\User\User;
use MediaWikiIntegrationTestCase;
use PermissionsError;
use SpecialPageExecutor;

/**
 * Uses the integration base class for MediaWiki's special page factory, and the database for the test user.
 *
 * @covers \SWL\Special\Conditions
 * @group semantic-watchlist
 * @group Database
 */
class ConditionsTest extends MediaWikiIntegrationTestCase {

	public function testUserWithoutSemanticwatchgroupsRightIsRefused(): void {
		$user = $this->newUserWithRights( [ 'read' ] );

		$this->expectException( PermissionsError::class );
		( new SpecialPageExecutor() )->executeSpecialPage( $this->newPage(), '', null, null, $user );
	}

	public function testUserWithSemanticwatchgroupsRightCanUsePage(): void {
		$this->assertTrue( $this->newPage()->userCanExecute( $this->newUserWithRights( [ 'semanticwatchgroups' ] ) ) );
	}

	private function newPage(): SpecialPage {
		return $this->getServiceContainer()->getSpecialPageFactory()->getPage( 'WatchlistConditions' );
	}

	/**
	 * @param string[] $rights
	 */
	private function newUserWithRights( array $rights ): User {
		$user = $this->getTestUser()->getUser();
		$this->overrideUserPermissions( $user, $rights );
		return $user;
	}

}
