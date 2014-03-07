<?php

namespace SWL\Tests;

/**
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
class ConfigurationIntegrityTest extends \PHPUnit_Framework_TestCase {

	public function testCanReadDatabaseSchema() {
		$this->assertTrue( is_readable( $GLOBALS['egSwlSqlDatabaseSchemaPath'] ) );
	}

	public function testExtensionFunctionsRegistration() {

		$extensionFunctions = $GLOBALS['wgExtensionFunctions']['semantic-watchlist'];

		$this->assertTrue( is_callable( $extensionFunctions ) );
		$this->assertTrue( call_user_func( $extensionFunctions) );
	}

}