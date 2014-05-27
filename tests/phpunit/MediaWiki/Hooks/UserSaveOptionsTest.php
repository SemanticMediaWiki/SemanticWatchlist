<?php

namespace SWL\Tests\MediaWiki\Hooks;

use SWL\MediaWiki\Hooks\UserSaveOptions;

/**
 * @covers \SWL\MediaWiki\Hooks\UserSaveOptions
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
class UserSaveOptionsTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {

		$databaseUpdater = $this->getMockBuilder( '\SWL\Database\DatabaseUpdater' )
			->disableOriginalConstructor()
			->getMock();

		$user = $this->getMockBuilder( 'User' )
			->disableOriginalConstructor()
			->getMock();

		$options = array();

		$this->assertInstanceOf(
			'\SWL\MediaWiki\Hooks\UserSaveOptions',
			new UserSaveOptions( $databaseUpdater, $user, $options )
		);
	}

	public function testExecuteWithEmptyOption() {

		$instance = $this->acquireInstanceFor(
			array(),
			array()
		);

		$this->assertTrue( $instance->execute() );
	}

	public function testExecuteWithValidSwlOption() {

		$instance = $this->acquireInstanceFor(
			array( 'swl_watchgroup_9999' => true ),
			array( 9999 )
		);

		$this->assertTrue( $instance->execute() );
	}

	public function testExecuteWithInvalidSwlOption() {

		$instance = $this->acquireInstanceFor(
			array( '9999' => true ),
			array()
		);

		$this->assertTrue( $instance->execute() );
	}

	private function acquireInstanceFor( $options, $expected ) {

		$databaseUpdater = $this->getMockBuilder( '\SWL\Database\DatabaseUpdater' )
			->disableOriginalConstructor()
			->getMock();

		$databaseUpdater->expects( $this->once() )
			->method( 'updateUsersPerGroupWithGroupIds' )
			->with(
				$this->anything(),
				$this->equalTo( $expected ) )
			->will( $this->returnValue( true ) );

		$user = $this->getMockBuilder( 'User' )
			->disableOriginalConstructor()
			->getMock();

		return new UserSaveOptions(
			$databaseUpdater,
			$user,
			$options
		);
	}

}
