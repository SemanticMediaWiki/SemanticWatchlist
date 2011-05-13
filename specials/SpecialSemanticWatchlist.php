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
				'LIMIT' => 2,
				'ORDER BY' => 'set_time',
				'SORT DESC'
			),
			array(
				'swl_sets_per_group' => array( 'LEFT JOIN', array( 'set_id=spg_set_id' ) ),
				'swl_users_per_group' => array( 'LEFT JOIN', array( 'spg_group_id=upg_group_id' ) ),
			)
		);
		
		$changeSets = array();
		
		foreach ( $sets as $set ) {
			$changeSets[] = SWLChangeSet::newFromDBResult( $set );
		}
		
		return $changeSets;
	}
	
	protected function displayChangeSet( SWLChangeSet $changeSet ) {
		
	}
	
}
