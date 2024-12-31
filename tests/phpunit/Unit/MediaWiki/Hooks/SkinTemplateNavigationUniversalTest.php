<?php

namespace SWL\Tests\MediaWiki\Hooks;

use MediaWiki\User\UserOptionsManager;
use SWL\MediaWiki\Hooks\SkinTemplateNavigationUniversal;
use Title;

/**
 * @covers \SWL\MediaWiki\Hooks\SkinTemplateNavigationUniversal
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
class SkinTemplateNavigationUniversalTest extends \PHPUnit\Framework\TestCase {

	public function testCanConstruct() {

		$personalUrls = [];

		$title = $this->getMockBuilder( 'Title' )
			->disableOriginalConstructor()
			->getMock();

		$user = $this->getMockBuilder( 'User' )
			->disableOriginalConstructor()
			->getMock();

		$userGroupManager = $this->createMock( UserOptionsManager::class );

		$this->assertInstanceOf(
			'\SWL\MediaWiki\Hooks\SkinTemplateNavigationUniversal',
			new SkinTemplateNavigationUniversal( $personalUrls, $title, $user, $userGroupManager )
		);
	}

	public function testExecuteOnEnabledTopLink() {

		$configuration = [ 'egSWLEnableTopLink' => true ];
		$personalUrls  = [ 'watchlist' => true ];

		$title = Title::newFromText( __METHOD__ );

		$user = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$user->expects( $this->once() )
			->method( 'isRegistered' )
			->willReturn( true );

		$userGroupManager = $this->createMock( UserOptionsManager::class );
		$userGroupManager->expects( $this->once() )
			->method( 'getOption' )
			->with( $user, 'swl_watchlisttoplink' )
			->willReturn( true );

		$instance = new SkinTemplateNavigationUniversal( $personalUrls, $title, $user, $userGroupManager );
		$instance->setConfiguration( $configuration );

		$this->assertTrue( $instance->execute() );
		$this->assertCount( 2, $personalUrls );
	}

	public function testExecuteOnDisabledTopLink() {

		$configuration = [ 'egSWLEnableTopLink' => false ];
		$personalUrls  = [];

		$title = Title::newFromText( __METHOD__ );

		$user = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$userGroupManager = $this->createMock( UserOptionsManager::class );

		$instance = new SkinTemplateNavigationUniversal( $personalUrls, $title, $user, $userGroupManager );
		$instance->setConfiguration( $configuration );

		$this->assertTrue( $instance->execute() );
		$this->assertEmpty( $personalUrls );
	}

	public function testExecuteOnLoggedOutUser() {

		$configuration = [ 'egSWLEnableTopLink' => true ];
		$personalUrls  = [];

		$title = Title::newFromText( __METHOD__ );

		$user = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$user->expects( $this->once() )
			->method( 'isRegistered' )
			->willReturn( false );

		$userGroupManager = $this->createMock( UserOptionsManager::class );

		$instance = new SkinTemplateNavigationUniversal( $personalUrls, $title, $user, $userGroupManager );
		$instance->setConfiguration( $configuration );

		$this->assertTrue( $instance->execute() );
		$this->assertEmpty( $personalUrls );
	}

}
