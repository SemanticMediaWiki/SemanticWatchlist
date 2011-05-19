<?php

/**
 * API module to delete semantic watchlist groups.
 *
 * @since 0.1
 *
 * @file ApiDeleteWatchlistGroup.php
 * @ingroup SemanticWatchlist
 * @ingroup API
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ApiDeleteWatchlistGroup extends ApiBase {
	
	public function __construct( $main, $action ) {
		parent::__construct( $main, $action );
	}
	
	public function execute() {
		global $wgUser;
		
		if ( !$wgUser->isAllowed( 'semanticwatchgroups' ) || $wgUser->isBlocked() ) {
			$this->dieUsageMsg( array( 'badaccess-groups' ) );
		}
		
		$params = $this->extractRequestParams();
		
		$everythingOk = true;
		
		$dbw = wfGetDB( DB_MASTER );
		$dbw->begin();
		
		foreach ( $params['ids'] as $id ) {
			$result = $dbw->delete(
				'swl_groups',
				array( 'group_id' => $id )
			);

			if ( $result === false ) {
				$everythingOk = false;
			}
		}
		
		$dbw->commit();
		
		$this->getResult()->addValue(
			null,
			'success',
			$everythingOk
		);
	}

	public function getAllowedParams() {
		return array(
			'ids' => array(
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_REQUIRED => true,
				ApiBase::PARAM_ISMULTI => true,
			),
		);
	}
	
	public function getParamDescription() {
		return array(
			'ids' => 'The IDs of the watchlist groups to delete'
		);
	}
	
	public function getDescription() {
		return array(
			'API module to delete semantic watchlist groups.'
		);
	}
		
	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(
			array( 'missingparam', 'ids' ),
		) );
	}

	protected function getExamples() {
		return array(
			'api.php?action=deleteswlgroup&ids=42|34',
		);
	}	
	
	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}		
	
}
