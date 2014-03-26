<?php

namespace SWL\Tests;

use SWL\ServiceFactory;

/**
 * @covers \SWL\ServiceFactory
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
class ServiceFactoryTest extends \PHPUnit_Framework_TestCase {

	public function testCanConstruct() {

		$this->assertInstanceOf(
			'\SWL\ServiceFactory',
			new ServiceFactory
		);

		$this->assertInstanceOf(
			'\SWL\ServiceFactory',
			ServiceFactory::getInstance()
		);
	}

	public function testDBConnection() {

		$database = $this->getMockBuilder( 'DatabaseBase' )
			->disableOriginalConstructor()
			->getMockForAbstractClass();

		$instance = new ServiceFactory;
		$instance->setDBConnection( DB_SLAVE, $database );

		$this->assertSame(
			$instance->getDBConnection( DB_SLAVE ),
			$database
		);
	}

	public function testInvalidDBConnectionThrowsException() {

		$this->setExpectedException( 'DomainException' );

		$instance = new ServiceFactory;
		$instance->setDBConnection( DB_SLAVE, new \stdClass );

		$instance->getDBConnection( DB_SLAVE );
	}

}
