<?php

/**
 * API module to get a list of modified properties per page for a persons semantic watchlist.
 *
 * @since 0.1
 *
 * @file ApiQuerySemanticWatchlist.php
 * @ingroup SemanticWatchlist
 * @ingroup API
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ApiQuerySemanticWatchlist extends ApiQueryBase {
	public function __construct( $main, $action ) {
		parent :: __construct( $main, $action, 'sw' );
	}

	/**
	 * Retrieve the specil words from the database.
	 */
	public function execute() {
		// Get the requests parameters.
		$params = $this->extractRequestParams();
		
		$this->setupChangeSetQuery( $params['userid'], $params['limit'], $params['continue'] );		
		
		$sets = $this->select( __METHOD__ );
		$count = 0;	
		$resultSets = array();	
		
		foreach ( $sets as $set ) {
			if ( ++$count > $params['limit'] ) {
				// We've reached the one extra which shows that
				// there are additional pages to be had. Stop here...
				$this->setContinueEnumParameter( 'continue', $set->set_time . '-' . $set->set_id );
				break;
			}
			
			$set = SWLChangeSet::newFromDBResult( $set )->toArray();
			
			foreach ( $set['changes'] as $propName => $changes ) {
				$this->getResult()->setIndexedTagName( $set['changes'][$propName], 'change' );
			}
			
			$resultSets[] = $set;
		}
		
		$this->getResult()->setIndexedTagName( $resultSets, 'set' );
		
		$this->getResult()->addValue(
			null,
			'sets',
			$resultSets
		);
	}
	
	/**
	 * Gets a list of change sets belonging to any of the watchlist groups
	 * watched by the user, newest first.
	 * 
	 * @param integer $userId
	 * @param integer $limit
	 * @param string $continue
	 */
	protected function setupChangeSetQuery( $userId, $limit, $continue ) {
		$this->addTables( array( 'swl_sets', 'swl_sets_per_group', 'swl_users_per_group' ) );

		$this->addJoinConds( array(
			'swl_sets_per_group' => array( 'INNER JOIN', array( 'set_id=spg_set_id' ) ),
			'swl_users_per_group' => array( 'INNER JOIN', array( 'spg_group_id=upg_group_id' ) ),
		) );		
		
		$this->addFields( array(
        	'set_id',
        	'set_user_name',
        	'set_page_id',
        	'set_time',
		) );
		
		$this->addWhere( array(
			'upg_user_id' => $userId
		) );
		
		$this->addOption( 'LIMIT', $limit + 1 );
		$this->addOption( 'ORDER BY', 'set_time DESC, set_id DESC' );
		
		if ( !is_null( $continue ) ) {
			$continueParams = explode( '-', $continue );
			
			if ( count( $continueParams ) == 2 ) {
				$dbr = wfGetDB( DB_SLAVE );
				$this->addWhere( 'set_time <= ' . $dbr->addQuotes( $continueParams[0] ) );
				$this->addWhere( 'set_id <= ' . $dbr->addQuotes( $continueParams[1] ) );					
			}
			else {
				// TODO: error
			}
		}		
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see includes/api/ApiBase#getAllowedParams()
	 */
	public function getAllowedParams() {
		return array (
			'userid' => array(
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_REQUIRED => true,
			),
			'limit' => array(
				ApiBase :: PARAM_DFLT => 20,
				ApiBase :: PARAM_TYPE => 'limit',
				ApiBase :: PARAM_MIN => 1,
				ApiBase :: PARAM_MAX => ApiBase :: LIMIT_BIG1,
				ApiBase :: PARAM_MAX2 => ApiBase :: LIMIT_BIG2
			),			
			'continue' => null,
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see includes/api/ApiBase#getParamDescription()
	 */
	public function getParamDescription() {
		return array (
			'userid' => 'The ID of the user for which to return semantic watchlist data.',
			'continue' => 'Offset number from where to continue the query',
			'limit'   => 'Max amount of words to return',
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see includes/api/ApiBase#getDescription()
	 */
	public function getDescription() {
		return 'Returns a list of modified properties per page for a persons semantic watchlist.';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see includes/api/ApiBase#getPossibleErrors()
	 */
	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(

		) );
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see includes/api/ApiBase#getExamples()
	 */
	protected function getExamples() {
		return array (
			'api.php?action=query&list=semanticwatchlist&swuserid=1',
			'api.php?action=query&list=semanticwatchlist&swuserid=1&swlimit=42&swcontinue=20110514143957-9001',
		);
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}	
	
}
