<?php

/**
 * API module to modify semantic watchlist groups.
 *
 * @since 0.1
 *
 * @file ApiSemanticWatchlist.php
 * @ingroup SemanticWatchlist
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class ApiSemanticWatchlist extends ApiBase {
	
	public function __construct( $main, $action ) {
		parent::__construct( $main, $action );
	}
	
	public function execute() {
		$params = $this->extractRequestParams();
		
	}

	public function getAllowedParams() {
		return array(
		);
	}
	
	public function getParamDescription() {
		return array(
		);
	}
	
	public function getDescription() {
		return array(
			'API module to modify semantic watchlist groups.'
		);
	}
		
	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(), array(
		) );
	}

	protected function getExamples() {
		return array(
			'api.php?action=semanticwatchlist',
		);
	}	
	
	public function getVersion() {
		return __CLASS__ . ': $Id:  $';
	}		
	
}
