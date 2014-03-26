<?php

namespace SWL\Tests\MediaWiki\Hooks;

use SWL\MediaWiki\Hooks\GroupNotify;

/**
 * @covers \SWL\MediaWiki\Hooks\GroupNotify
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
class GroupNotifyTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {

		$group = $this->getMockBuilder( '\SWLGroup' )
			->disableOriginalConstructor()
			->getMock();

		$changes = $this->getMockBuilder( '\SWLChangeSet' )
			->disableOriginalConstructor()
			->getMock();

		$userIds = array();

		$this->assertInstanceOf(
			'\SWL\MediaWiki\Hooks\GroupNotify',
			new GroupNotify( $group, $changes, $userIds )
		);
	}

	public function testExecuteForEmptyUserIds() {

		$group = $this->getMockBuilder( '\SWLGroup' )
			->disableOriginalConstructor()
			->getMock();

		$changes = $this->getMockBuilder( '\SWLChangeSet' )
			->disableOriginalConstructor()
			->getMock();

		$user = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$userIds = array();

		$configuration = array(
			'egSWLEnableEmailNotify' => true,
			'egSWLMailPerChange'     => true,
			'egSWLMaxMails'          => 0,
			'egSWLEnableSelfNotify'  => false
		);

		$instance = new GroupNotify( $group, $changes, $userIds );
		$instance->setConfiguration( $configuration );
		$instance->setAnonymousUser( $user );

		$this->assertTrue( $instance->execute() );
	}

	public function testExecuteForValidUserId() {

		$group = $this->getMockBuilder( '\SWLGroup' )
			->disableOriginalConstructor()
			->getMock();

		$editUser = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$edit = $this->getMockBuilder( '\SWLEdit' )
			->disableOriginalConstructor()
			->getMock();

		$edit->expects( $this->once() )
			->method( 'getUser' )
			->will( $this->returnValue( $editUser ) );

		$changes = $this->getMockBuilder( '\SWLChangeSet' )
			->disableOriginalConstructor()
			->getMock();

		$changes->expects( $this->once() )
			->method( 'getEdit' )
			->will( $this->returnValue( $edit ) );

		$userUnderTest = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$userUnderTest->expects( $this->at( 0 ) )
			->method( 'getOption' )
			->with(
				$this->equalTo( 'swl_email' ),
				$this->equalTo( false ) )
			->will( $this->returnValue( true ) );

		$userUnderTest->expects( $this->atLeastOnce() )
			->method( 'getOption' )
			->will( $this->returnValue( true ) );

		$userUnderTest->expects( $this->once() )
			->method( 'getName' )
			->will( $this->returnValue( 'Foo' ) );

		$userUnderTest->expects( $this->once() )
			->method( 'getEmail' )
			->will( $this->returnValue( 'foo@example.org' ) );

		$anonymousUser = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$anonymousUser::staticExpects( $this->once() )
			->method( 'newFromId' )
			->with(	$this->equalTo( 9999 ) )
			->will( $this->returnValue( $userUnderTest ) );

		$userIds = array( 9999 );

		$configuration = array(
			'egSWLEnableEmailNotify' => true,
			'egSWLMailPerChange'     => true,
			'egSWLMaxMails'          => 0,
			'egSWLEnableSelfNotify'  => false
		);

		$instance = new GroupNotify( $group, $changes, $userIds );
		$instance->setConfiguration( $configuration );
		$instance->setAnonymousUser( $anonymousUser );

		$this->assertTrue( $instance->execute() );
	}

}
