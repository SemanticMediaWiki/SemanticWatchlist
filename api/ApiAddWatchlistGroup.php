<?php

/**
 * API module to add semantic watchlist groups.
 *
 * @since 0.1
 *
 * @file ApiAddWatchlistGroup.php
 * @ingroup SemanticWatchlist
 * @ingroup API
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ApiAddWatchlistGroup extends ApiBase {
	
	public function __construct( $main, $action ) {
		parent::__construct( $main, $action );
	}
	
	public function execute() {
		global $wgUser;
		
		if ( !$wgUser->isAllowed( 'semanticwatchgroups' ) || $wgUser->isBlocked() ) {
			$this->dieUsageMsg( array( 'badaccess-groups' ) );
		}			
		
		$params = $this->extractRequestParams();
		
		$group = new SWLGroup(
			null,
			$params['name'],
			$params['categories'],
			$params['namespaces'],
			$params['properties'],
			$params['concepts']
		);
		
		$group->writeToDB();
	}

	public function getAllowedParams() {
		return array(
			'name' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_REQUIRED => true,
			),
			'properties' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_ISMULTI => true,
				ApiBase::PARAM_REQUIRED => true,
			),
			'categories' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_ISMULTI => true,
				ApiBase::PARAM_DFLT => '',
			),
			'namespaces' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_ISMULTI => true,
				ApiBase::PARAM_DFLT => '',
			),
			'concepts' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_ISMULTI => true,
				ApiBase::PARAM_DFLT => '',
			),
		);
	}
	
	public function getParamDescription() {
		return array(
		);
	}
	
	public function getDescription() {
		return array(
			'API module to add semantic watchlist groups.'
		);
	}
	
	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(
		) );
	}

	protected function getExamples() {
		return array(
			'api.php?action=addswlgroup&name=My group of awesome&properties=Has awesomeness|Has epicness&categories=Awesome stuff',
		);
	}	
	
	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}		
	
}
