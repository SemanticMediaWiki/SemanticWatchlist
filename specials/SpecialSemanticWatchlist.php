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
		global $wgUser;
		
		$dbr = wfGetDb( DB_SLAVE );
		
		$sets = $dbr->select(
			array( 'swl_sets', 'swl_sets_per_group', 'swl_users_per_group' ),
			array(
	        	'set_id',
	        	'set_user_name',
	        	'set_page_id',
	        	'set_time',
			),
			array(
				'upg_user_id' => $wgUser->getId()
			),
			'DatabaseBase::select',
			array(
				'LIMIT' => 20,
				'ORDER BY' => 'set_time DESC',
				'DISTINCT'
			),
			array(
				'swl_sets_per_group' => array( 'INNER JOIN', array( 'set_id=spg_set_id' ) ),
				'swl_users_per_group' => array( 'INNER JOIN', array( 'spg_group_id=upg_group_id' ) ),
			)
		);
		
		$changeSets = array();
		
		foreach ( $sets as $set ) {
			$changeSets[] = SWLChangeSet::newFromDBResult( $set );
		}
		
		return $changeSets;
	}
	
	protected function displayChangeSet( SWLChangeSet $changeSet ) {
		global $wgOut;
		
		$wgOut->addHTML( '<h3>' . $changeSet->getTitle()->getText() . '</h3><ul>' );
		
		foreach ( $changeSet->getAllProperties() as /* SMWDIProperty */ $property ) {
			foreach ( $changeSet->getAllPropertyChanges( $property ) as /* SMWPropertyChange */ $change ) {
				$old = $change->getOldValue();
				$old = is_null( $old ) ? wfMsg( 'swl-novalue' ) : SMWDataValueFactory::newDataItemValue( $old )->getLongWikiText();
				$new = $change->getNewValue();
				$new = is_null( $new ) ? wfMsg( 'swl-novalue' ) : SMWDataValueFactory::newDataItemValue( $new )->getLongWikiText();
				$wgOut->addHTML( '<li>' . $old . ' -> ' . $new . '</li>' );
			}
		}
		
		$wgOut->addHTML( '</ul>' );
	}
	
}
