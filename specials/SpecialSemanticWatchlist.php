<?php

/**
 * Semantic watchlist page listing changes to watched properties.
 * 
 * @since 0.1
 * 
 * @file SemanticWatchlist.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SpecialSemanticWatchlist extends SpecialPage {
	
	/**
	 * Constructor.
	 * 
	 * @since 0.1
	 */
	public function __construct() {
		parent::__construct( 'SemanticWatchlist', 'semanticwatch' );
	}
	
	/**
	 * @see SpecialPage::getDescription
	 * 
	 * @since 0.1
	 */
	public function getDescription() {
		return wfMsg( 'special-' . strtolower( $this->mName ) );
	}
	
	/**
	 * Sets headers - this should be called from the execute() method of all derived classes!
	 * 
	 * @since 0.1
	 */
	public function setHeaders() {
		global $wgOut;
		$wgOut->setArticleRelated( false );
		$wgOut->setRobotPolicy( 'noindex,nofollow' );
		$wgOut->setPageTitle( $this->getDescription() );
	}	
	
	/**
	 * Main method.
	 * 
	 * @since 0.1
	 * 
	 * @param string $arg
	 */
	public function execute( $arg ) {
		global $wgOut, $wgUser, $wgRequest;
		
		$this->setHeaders();
		$this->outputHeader();
		
		// If the user is authorized, display the page, if not, show an error.
		if ( !$this->userCanExecute( $wgUser ) ) {
			$this->displayRestrictionError();
			return;
		}
		
		$this->displayWatchlist();
	}
	
	protected function displayWatchlist() {
		foreach ( $this->getChangeSets() as $set ) {
			$this->displayChangeSet( $set );
		}
	}
	
	/**
	 * Gets a list of change sets belonging to any of the watchlist groups
	 * watched by the user, newest first.
	 * 
	 * @return array of SWLChangeSet
	 */
	protected function getChangeSets() {
		$requestData = array(
			'action' => 'query',
			'list' => 'semanticwatchlist',
			'format' => 'json',
			'swuserid' => $GLOBALS['wgUser']->getId()
		);
		
		$api = new ApiMain( new FauxRequest( $requestData, true ), true );
		$api->execute();
		$response = $api->getResultData();
		
		$changeSets = array();
		
		foreach ( $response['sets'] as $set ) {
			$changeSets[] = SWLChangeSet::newFromArray( $set );
		}
		
		return $changeSets;
	}
	
	protected function displayChangeSet( SWLChangeSet $changeSet ) {
		global $wgOut;
		
		$wgOut->addHTML( '<h3>' . $changeSet->getTitle()->getText() . '</h3><ul>' );
		
		foreach ( $changeSet->getAllProperties() as /* SMWDIProperty */ $property ) {
			foreach ( $changeSet->getAllPropertyChanges( $property ) as /* SMWPropertyChange */ $change ) {
				$old = $change->getOldValue();
				$old = is_null( $old ) ? wfMsg( 'swl-novalue' ) : SMWDataValueFactory::newDataItemValue( $old, $property )->getLongWikiText();
				$new = $change->getNewValue();
				$new = is_null( $new ) ? wfMsg( 'swl-novalue' ) : SMWDataValueFactory::newDataItemValue( $new, $property )->getLongWikiText();
				$wgOut->addHTML( '<li>' . $old . ' -> ' . $new . '</li>' );
			}
		}
		
		$wgOut->addHTML( '</ul>' );
	}
	
}
