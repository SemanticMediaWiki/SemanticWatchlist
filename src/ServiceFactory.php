<?php

namespace SWL;

use DatabaseBase;
use DomainException;

/**
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author mwjames
 */
class ServiceFactory {

	/** @var ServiceFactory */
	protected static $instance = null;

	protected $dbConnection = array();

	/**
	 * @since 1.0
	 *
	 * @return ServiceFactory
	 */
	public static function getInstance() {

		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @since 1.0
	 */
	public static function clear() {
		self::$instance = null;
	}

	/**
	 * @since 1.0
	 *
	 * @param integer $id
	 *
	 * @return DatabaseBase
	 * @throws DomainException
	 */
	public function getDBConnection( $id = DB_SLAVE ) {

		if( !isset( $this->dbConnection[ $id ] ) ) {
			$this->dbConnection[ $id ] = wfGetDB( $id );
		}

		if ( $this->dbConnection[ $id ] instanceof DatabaseBase ) {
			return $this->dbConnection[ $id ];
		}

		throw new DomainException( 'Expected a DatabaseBase instance' );
	}

	/**
	 * @since 1.0
	 *
	 * @param integer $id
	 * @param DatabaseBase $connection
	 */
	public function setDBConnection( $id, $connection ) {
		$this->dbConnection[ $id ] = $connection;
	}

}
