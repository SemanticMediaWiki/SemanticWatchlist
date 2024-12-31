<?php

namespace SWL\Tests\MediaWiki\Hooks;

use NamespaceInfo;
use MediaWiki\MediaWikiServices;
use SWL\MediaWiki\Hooks\GetPreferences;
use SMW\DIProperty;

/**
 * @covers \SWL\MediaWiki\Hooks\GetPreferences
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
class GetPreferencesTest extends \PHPUnit\Framework\TestCase {

	public function testCanConstruct() {

		$user = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$language = $this->getMockBuilder( '\Language' )
			->disableOriginalConstructor()
			->getMock();

		$preferences = [];

		$namespaceInfo = $this->createMock( NamespaceInfo::class );

		$this->assertInstanceOf(
			'\SWL\MediaWiki\Hooks\GetPreferences',
			new GetPreferences( $user, $language, $preferences, $namespaceInfo )
		);
	}

	public function testExecuteOnEnabledEmailNotifyPreference() {

		$swlGroup    = [];
		$preferences = [];

		$configuration = [
			'egSWLEnableEmailNotify' => true,
			'egSWLEnableTopLink'     => false
		];

		$namespaceInfo = $this->createMock( NamespaceInfo::class );

		$instance = $this->acquireInstance( $configuration, $swlGroup, $preferences, $namespaceInfo );

		$this->assertTrue( $instance->execute() );
		$this->assertCount( 3, $preferences );
	}

	public function testExecuteOnEnabledTopLinkPreference() {

		$swlGroup    = [];
		$preferences = [];

		$configuration = [
			'egSWLEnableEmailNotify' => false,
			'egSWLEnableTopLink'     => true
		];

		$namespaceInfo = $this->createMock( NamespaceInfo::class );

		$instance = $this->acquireInstance( $configuration, $swlGroup, $preferences, $namespaceInfo );

		$this->assertTrue( $instance->execute() );
		$this->assertCount( 3, $preferences );
	}

	public function testExecuteOnSingleCategoryGroupPreference() {

		$swlGroup = $this->getMockBuilder( '\SWL\Group' )
			->disableOriginalConstructor()
			->getMock();

		$swlGroup->expects( $this->once() )
			->method( 'getProperties' )
			->will( $this->returnValue( [ 'FooProperty' ] ) );

		$swlGroup->expects( $this->exactly( 2 ) )
			->method( 'getCategories' )
			->will( $this->returnValue( [ 'FooCategory' ] ) );

		$swlGroup->expects( $this->once() )
			->method( 'getId' )
			->will( $this->returnValue( 9999 ) );

		$swlGroup->expects( $this->once() )
			->method( 'getName' )
			->will( $this->returnValue( 'Foo' ) );

		$preferences = [];

		$configuration = [
			'egSWLEnableEmailNotify' => false,
			'egSWLEnableTopLink'     => false
		];

		$namespaceInfo = $this->createMock( NamespaceInfo::class );

		$instance = $this->acquireInstance( $configuration, [ $swlGroup ], $preferences, $namespaceInfo );

		$this->assertTrue( $instance->execute() );
		$this->assertCount( 3, $preferences );
	}

	protected function acquireInstance( $configuration, $swlGroup, &$preference, $namespaceInfo ) {

		$user = $this->getMockBuilder( '\User' )
			->disableOriginalConstructor()
			->getMock();

		$language = $this->getMockBuilder( '\Language' )
			->disableOriginalConstructor()
			->getMock();

		$language->expects( $this->any() )
			->method( 'getCode' )
			->will( $this->returnValue( 'en' ) );

		$instance = $this->getMockBuilder( '\SWL\MediaWiki\Hooks\GetPreferences' )
			->setConstructorArgs( [ $user, $language, &$preference, $namespaceInfo ] )
			->setMethods( [ 'getAllSwlGroups' ] )
			->getMock();

		$instance->expects( $this->once() )
			->method( 'getAllSwlGroups' )
			->will( $this->returnValue( $swlGroup ) );

		$instance->setConfiguration( $configuration );

		return $instance;
	}

}
