<?php

namespace SWL\Tests\MediaWiki\Hooks;

use SWL\MediaWiki\Hooks\SaveUserOptions;

/**
 * @covers \SWL\MediaWiki\Hooks\SaveUserOptions
 *
 * @group semantic-watchlist
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class SaveUserOptionsTest extends \PHPUnit\Framework\TestCase {

	public function testCanConstruct() {

		$tableUpdater = $this->getMockBuilder( '\SWL\TableUpdater' )
			->disableOriginalConstructor()
			->getMock();

		$user = $this->getMockBuilder( 'User' )
			->disableOriginalConstructor()
			->getMock();

		$options = [];

		$modifications = [];

		$this->assertInstanceOf(
			'\SWL\MediaWiki\Hooks\SaveUserOptions',
			new SaveUserOptions( $tableUpdater, $user, $modifications, $options )
		);
	}

	public function testExecuteWithEmptyOption() {

		$instance = $this->createUserSaveOptionsInstance(
			[],
			[]
		);

		$this->assertTrue( $instance->execute() );
	}

	public function testExecuteWithValidSwlOption() {

		$instance = $this->createUserSaveOptionsInstance(
			[ 'swl_watchgroup_9999' => true ],
			[ 9999 ]
		);

		$this->assertTrue( $instance->execute() );
	}

	public function testExecuteWithInvalidSwlOption() {

		$instance = $this->createUserSaveOptionsInstance(
			[ '9999' => true ],
			[]
		);

		$this->assertTrue( $instance->execute() );
	}

	private function createUserSaveOptionsInstance( $options, $expected ) {

		$tableUpdater = $this->getMockBuilder( '\SWL\TableUpdater' )
			->disableOriginalConstructor()
			->getMock();

		$tableUpdater->expects( $this->once() )
			->method( 'updateGroupIdsForUser' )
			->with(
				$this->anything(),
				$this->equalTo( $expected ) )
			->will( $this->returnValue( true ) );

		$user = $this->getMockBuilder( 'User' )
			->disableOriginalConstructor()
			->getMock();

		$modifications = [];

		return new SaveUserOptions(
			$tableUpdater,
			$user,
			$modifications,
			$options
		);
	}

}
