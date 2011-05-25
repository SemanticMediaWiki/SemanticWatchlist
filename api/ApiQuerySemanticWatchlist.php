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
		
		if ( !( isset( $params['userid'] ) XOR isset( $params['groupids'] ) ) ) {
			$this->dieUsage( wfMsgExt( 'swl-err-userid-xor-groupids' ), 'userid-xor-groupids' );
		}
		
		$isUserFilter = isset( $params['userid'] );
		$filter = $isUserFilter ? $params['userid'] : $params['groupids'];
		
		$this->setupChangeSetQuery( $filter, $isUserFilter, $params['limit'], $params['continue'] );		
		
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
	 * @param mixed $filter User ID or array of group IDs
	 * @param boolean $isUserFilter
	 * @param integer $limit
	 * @param string $continue
	 */
	protected function setupChangeSetQuery( $filter, $isUserFilter, $limit, $continue ) {
		$tables = array( 'swl_edits', 'swl_sets_per_edit', 'swl_sets_per_group' );
		
		if ( $isUserFilter ) {
			$tables[] = 'swl_users_per_group';
		}
		
		$this->addTables( $tables );

		$this->addJoinConds( array(
			'swl_sets_per_edit' => array( 'INNER JOIN', array( 'edit_id=spe_edit_id' ) ),
			'swl_sets_per_group' => array( 'INNER JOIN', array( 'spe_set_id=spg_set_id' ) ),
		) );
		
		if ( $isUserFilter ) {
			$this->addJoinConds( array(
				'swl_users_per_group' => array( 'INNER JOIN', array( 'spg_group_id=upg_group_id' ) ),
			) );
		}
		
		$this->addFields( array(
			'spe_set_id',
			'edit_user_name',
			'edit_page_id',
			'edit_time',
			'edit_id'
		) );
		
		$this->addWhere( array(
			( $isUserFilter ? 'upg_user_id' : 'spg_group_id' ) => $filter
		) );
		
		$this->addOption( 'DISTINCT' );
		$this->addOption( 'LIMIT', $limit + 1 );
		$this->addOption( 'ORDER BY', 'edit_time DESC, spe_set_id DESC' );
		
		if ( !is_null( $continue ) ) {
			$continueParams = explode( '-', $continue );
			
			if ( count( $continueParams ) == 2 ) {
				$dbr = wfGetDB( DB_SLAVE );
				$this->addWhere( 'edit_time <= ' . $dbr->addQuotes( $continueParams[0] ) );
				$this->addWhere( 'spe_set_id <= ' . $dbr->addQuotes( $continueParams[1] ) );					
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
			),
			'groupids' => array(
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_ISMULTI => true,
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
			'groupids' => 'The IDs of the groups for which to return semantic watchlist data.',
			'continue' => 'Offset number from where to continue the query',
			'limit'   => 'Max amount of words to return',
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see includes/api/ApiBase#getDescription()
	 */
	public function getDescription() {
		return 'Returns a list of sets of changes for the either specified user of specified group(s).';
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
			'api.php?action=query&list=semanticwatchlist&swgroupids=1',
			'api.php?action=query&list=semanticwatchlist&swgroupids=1|42&swlimit=34',
		);
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}	
	
}
