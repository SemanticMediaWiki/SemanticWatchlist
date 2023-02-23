<?php

namespace SWL;

use MediaWiki\MediaWikiServices;
use Wikimedia\Rdbms\IDatabase;
use RuntimeException;

/**
 * @license GNU GPL v2+
 * @since 1.2
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class LazyDBConnectionProvider {

	/**
	 * @var IDatabase|null
	 */
	protected $connection = null;

	/**
	 * @var int|null
	 */
	protected $connectionId = null;

	/**
	 * @var string|array
	 */
	protected $groups;

	/**
	 * @var string|boolean $wiki
	 */
	protected $wiki;

	/**
	 * @since 1.2
	 *
	 * @param int $connectionId
	 * @param string|array $groups
	 * @param string|boolean $wiki
	 */
	public function __construct( $connectionId, $groups = array(), $wiki = false ) {
		$this->connectionId = $connectionId;
		$this->groups = $groups;
		$this->wiki = $wiki;
	}

	/**
	 * @see DBConnectionProvider::getConnection
	 *
	 * @since 1.2
	 *
	 * @return IDatabase
	 * @throws RuntimeException
	 */
	public function getConnection() {

		if ( $this->connection === null ) {
			$this->connection = MediaWikiServices::getInstance()
				->getDBLoadBalancerFactory()
				->getMainLB( $this->wiki )
				->getConnection( $this->connectionId, $this->groups, $this->wiki );
		}

		if ( $this->isConnection( $this->connection ) ) {
			return $this->connection;
		}

		throw new RuntimeException( 'Expected a IDatabase instance' );
	}

	/**
	 * @see DBConnectionProvider::releaseConnection
	 *
	 * @since 1.2
	 */
	public function releaseConnection() {
		if ( $this->wiki !== false && $this->connection !== null ) {
			MediaWikiServices::getInstance()
				->getDBLoadBalancerFactory()
				->getMainLB( $this->wiki )
				->reuseConnection( $this->connection );
		}
	}

	protected function isConnection( $connection ) {
		return $connection instanceof IDatabase;
	}

}
