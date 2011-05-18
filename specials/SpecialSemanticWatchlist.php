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
		global $wgOut, $wgUser, $wgRequest, $wgLang;
		
		$this->setHeaders();
		$this->outputHeader();
		
		// If the user is authorized, display the page, if not, show an error.
		if ( !$this->userCanExecute( $wgUser ) ) {
			$this->displayRestrictionError();
			return;
		}
		
		$limit = $wgRequest->getInt( 'limit', 20 );
		$offset = $wgRequest->getInt( 'offset', 0 );
		$continue = $wgRequest->getVal( 'continue' );
		
		$changeSetData = $this->getChangeSetsData( $limit, $continue );
		
		$sets = array();
		
		foreach ( $changeSetData['sets'] as $set ) {
			$sets[] = SWLChangeSet::newFromArray( $set );
		}		
		
		$hasContinue = array_key_exists( 'query-continue', $changeSetData );
		
		if ( $hasContinue ) {
			$newContinue = $changeSetData['query-continue']['semanticwatchlist']['swcontinue'];
		}
		
		$wgOut->addHTML( '<p>' . wfMsgExt(
			'swl-wacthlist-position',
			array( 'parseinline' ),
			$wgLang->formatNum( count( $sets ) ),
			$wgLang->formatNum( $offset + 1 )
		) . '</p>' );
		
		$wgOut->addHTML( wfViewPrevNext(
			$offset,
			$limit,
			$this->getTitle( $arg ),
			$hasContinue ? 'continue=' . $newContinue : '',
			!$hasContinue
		) );		
		
		$this->displayWatchlist( $sets );
	}
	
	/**
	 * Displays the watchlist.
	 * 
	 * @since 0.1
	 * 
	 * @param array of SWLChangeSet $sets
	 */
	protected function displayWatchlist( array $sets ) {
		global $wgOut, $wgLang;
		
		$changeSetsHTML = array();
		
		foreach ( $sets as $set ) {
			$dayKey = substr( $set->getTime(), 0, 8 ); // Get the YYYYMMDD part.
			
			if ( !array_key_exists( $dayKey, $changeSetsHTML ) ) {
				$changeSetsHTML[$dayKey] = array();
			}
			
			$changeSetsHTML[$dayKey][] = $this->getChangeSetHTML( $set );
		}
		
		krsort( $changeSetsHTML );
		
		foreach ( $changeSetsHTML as $dayKey => $daySets ) {
			$wgOut->addHTML( HTML::element(
				'h4',
				array(),
				$wgLang->date( str_pad( $dayKey, 14, '0' ) )
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
	 * Returns the response of an internal request to the API semanticwatchlist query module.
	 * 
	 * @since 0.1
	 * 
	 * @param integer $limit
	 * @param string $continue
	 * 
	 * @return array
	 */
	protected function getChangeSetsData( $limit, $continue ) {
		$requestData = array(
			'action' => 'query',
			'list' => 'semanticwatchlist',
			'format' => 'json',
			'swuserid' => $GLOBALS['wgUser']->getId(),
			'swlimit' => $limit,
			'swcontinue' => $continue
		);
		
		$api = new ApiMain( new FauxRequest( $requestData, true ), true );
		$api->execute();
		return $api->getResultData();
	}
	
	/**
	 * Gets the HTML for a single change set (edit).
	 * 
	 * @since 0.1
	 * 
	 * @param SWLChangeSet $changeSet
	 * 
	 * @return string
	 */
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
				) . ') . . ' .
				HTML::element(
					'a',
					array( 'href' => $changeSet->getUser()->getUserPage()->getLocalURL() ),
					$changeSet->getUser()->getName()
				) . ' (' .
				HTML::element(
					'a',
					array( 'href' => $changeSet->getUser()->getTalkPage()->getLocalURL() ),
					wfMsg( 'talkpagelinktext' )
				) . ' | ' .
				( $changeSet->getUser()->isAnon() ? '' :
					HTML::element(
						'a',
						array( 'href' => SpecialPage::getTitleFor( 'Contributions', $changeSet->getUser()->getName() )->getLocalURL() ),
						wfMsg( 'contribslink' )						
					) . ' | '
				) .
				HTML::element(
					'a',
					array( 'href' => SpecialPage::getTitleFor( 'Block', $changeSet->getUser()->getName() )->getLocalURL() ),
					wfMsg( 'blocklink' )
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
	
	/**
	 * Returns the HTML for the changes to a single propety.
	 * 
	 * @param SMWDIProperty $property
	 * @param array of SMWPropertyChange $changes
	 * 
	 * @return string
	 */
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
