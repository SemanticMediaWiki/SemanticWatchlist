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
namespace SWL\Api;

use ApiBase;
use SWL\Group;

class AddWatchlistGroup extends ApiBase {

	public function __construct( $main, $action ) {
		parent::__construct( $main, $action );
	}

	public function execute() {
		$user = $this->getUser();

		if ( !$user->isAllowed( 'semanticwatchgroups' ) ) {
			$this->dieWithError( [
				'apierror-permissiondenied',
				$this->msg( 'action-semanticwatchgroups' )
			] );
		}
		$block = $user->getBlock();
		if ( $block ) {
			$this->dieBlocked( $block );
		}

		$params = $this->extractRequestParams();
		$params['customTexts'] = Group::unserializedCustomTexts( $params['customTexts'] );

		$group = new Group(
			null,
			$params['name'],
			$params['categories'],
			$params['namespaces'],
			$params['properties'],
			$params['concepts'],
			$params['customTexts']
		);

		$this->getResult()->addValue(
			null,
			'success',
			$group->writeToDB()
		);

		$this->getResult()->addValue(
			'group',
			'id',
			$group->getId()
		);

		$this->getResult()->addValue(
			'group',
			'name',
			$group->getName()
		);
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
			'customTexts' => array(
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_ISMULTI => true,
				ApiBase::PARAM_DFLT => '',
			),
		);
	}

	public function getParamDescription() {
		return array(
			'name' => 'The name of the group, used for display in the user preferences',
			'properties' => 'The properties this watchlist group covers',
			'categories' => 'The categories this watchlist group covers',
			'namespaces' => 'The namespaces this watchlist group covers',
			'concepts' => 'The concepts this watchlist group covers',
			'customTexts' => 'Custom Text to be sent in Emails',
		);
	}

	public function getDescription() {
		return array(
			'API module to add semantic watchlist groups.'
		);
	}

	protected function getExamples() {
		return array(
			'api.php?action=addswlgroup&name=My group of awesome&properties=Has awesomeness|Has epicness&categories=Awesome stuff',
			'api.php?action=addswlgroup&name=My group of awesome&properties=Has awesomeness|Has epicness&categories=Awesome stuff&customTexts=Has awesomeness~true~Changed to awesome now',
		);
	}

	public function needsToken() {
		return 'csrf';
	}

	public function isWriteMode() {
		return true;
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}

}
