<?php

/**
 * API module to get a list of modified properties per page for a persons semantic watchlist.
 *
 * @since 0.1
 *
 * @file ApiQuerySemanticWatchlist.php
 * @ingroup SemanticWatchlist
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
				ApiBase :: PARAM_DFLT => 500,
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
			'api.php?action=query&list=semanticwatchlist',
		);
	}

	public function getVersion() {
		return __CLASS__ . ': $Id:  $';
	}	
	
}
