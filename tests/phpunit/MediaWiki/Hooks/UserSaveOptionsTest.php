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

		$user = $this->getMockBuilder( 'User' )
			->disableOriginalConstructor()
			->getMock();

		$options = array();

		$this->assertInstanceOf(
			'\SWL\MediaWiki\Hooks\UserSaveOptions',
			new UserSaveOptions( $user, $options )
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

		$user = $this->getMockBuilder( 'User' )
			->disableOriginalConstructor()
			->getMock();

		$instance = $this->getMockBuilder( 'SWL\MediaWiki\Hooks\UserSaveOptions' )
			->setConstructorArgs( array( $user, &$options ) )
			->setMethods( array( 'performUpdate' ) )
			->getMock();

		$instance->expects( $this->once() )
			->method( 'performUpdate' )
			->with( $this->equalTo( $expected ) )
			->will( $this->returnValue( true ) );

		return $instance;
	}

}
