<?php

namespace SWL\Tests;

/**
 * @group semantic-watchlist
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
use GlobalVarConfig;
class ConfigurationIntegrityTest extends \PHPUnit_Framework_TestCase {

	public function testCanReadDatabaseSchema() {
		$cfg = new GlobalVarConfig( "egSWL" );
		$this->assertTrue( is_readable( $cfg->get('SqlDatabaseSchemaPath') ) );
	}

}
