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
		global $wgOut, $wgLang;
		
		$changeSetsHTML = array();
		
		foreach ( $this->getChangeSets() as $set ) {
			$dayKey = substr( $set->getTime(), 0, 8 ); // Get the YYYYMMDD part.
			
			if ( !array_key_exists( $dayKey, $changeSetsHTML ) ) {
				$changeSetsHTML[$dayKey] = array();
			}
			
			$changeSetsHTML[$dayKey][] = $this->getChangeSetHTML( $set );
		}
		
		krsort( $changeSetsHTML );
		
		foreach ( $changeSetsHTML as $daySets ) {
			$wgOut->addHTML( HTML::element(
				'h4',
				array(),
				$wgLang->date( str_pad( $set->getTime(), 14, '0' ) )
			) );
			
			$wgOut->addHTML( '<ul>' );
			
			foreach ( $daySets as $setHTML ) {
				$wgOut->addHTML( $setHTML );
			}
			
			$wgOut->addHTML( '</ul>' );
		}
		
		SMWOutputs::commitToOutputPage( $wgOut );
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
	
	protected function getChangeSetHTML( SWLChangeSet $changeSet ) {
		global $wgLang;
		
		$html = '';
		
		$html .= '<li>';
		
		$html .= 
			'<p>' .
				$wgLang->time( $changeSet->getTime(), true ) . ' ' .
				HTML::element(
					'a',
					array( 'href' => $changeSet->getTitle()->getLocalURL() ),
					$changeSet->getTitle()->getText()
				) . ' (' .
				HTML::element(
					'a',
					array( 'href' => $changeSet->getTitle()->getLocalURL( 'action=history' ) ),
					wfMsg( 'hist' )
				) . ')' .
			'</p>'
		;
		
		$propertyHTML= array();
		
		foreach ( $changeSet->getAllProperties() as /* SMWDIProperty */ $property ) {
			$propertyHTML[] = $this->getPropertyHTML( $property, $changeSet->getAllPropertyChanges( $property ) );
		}
		
		$html .= implode( '', $propertyHTML );
		
		$html .=  '</li>';
		
		return $html;
	}
	
	protected function getPropertyHTML( SMWDIProperty $property, array $changes ) {
		$html = '';
		
		foreach ( $changes as /* SMWPropertyChange */ $change ) {
			$old = $change->getOldValue();
			$old = is_null( $old ) ? wfMsg( 'swl-novalue' ) : SMWDataValueFactory::newDataItemValue( $old, $property )->getLongHTMLText();
			$new = $change->getNewValue();
			$new = is_null( $new ) ? wfMsg( 'swl-novalue' ) : SMWDataValueFactory::newDataItemValue( $new, $property )->getLongHTMLText();
			$html .= '* ' . $old . ' -> ' . $new;
		}
		
		return $html;
	}
	
}
