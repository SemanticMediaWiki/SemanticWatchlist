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
	public function execute( $subPage ) {
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
		
		$newContinue = false;
		
		if ( array_key_exists( 'query-continue', $changeSetData ) ) {
			$newContinue = $changeSetData['query-continue']['semanticwatchlist']['swcontinue'];
		}
		
		$wgOut->addHTML( '<p>' . wfMsgExt(
			'swl-watchlist-position',
			array( 'parseinline' ),
			$wgLang->formatNum( count( $sets ) ),
			$wgLang->formatNum( $offset + 1 )
		) . '</p>' );
		
		$wgOut->addHTML( $this->getPagingControlHTML( $limit, $continue, $subPage, $newContinue, $offset ) );		
		
		$this->displayWatchlist( $sets );
	}
	
	/**
	 * @since 0.1
	 * 
	 * @return string
	 */
	protected function getPagingControlHTML( $limit, $currentContinue, $subPage, $newContinue, $offset ) {
		global $wgLang;
		
		$nextMsg = wfMsgExt( 'nextn', array( 'parsemag', 'escape' ), $limit );
		$firstMsg = wfMsgExt( 'swl-watchlist-firstn', array( 'parsemag', 'escape' ), $limit );
		
		if ( $newContinue === false ) {
			$nextLink = $nextMsg;
		}
		else {
			$nextLink = Html::element(
				'a',
				array(
					'href' => $this->getTitle( $subPage )->getLocalURL( wfArrayToCGI( array(
						'limit' => $limit,
						'continue' => $newContinue,
						'offset' => $offset + $limit
					) ) ),
					'title' => wfMsgExt( 'nextn-title', array( 'parsemag', 'escape' ), $limit ),
					'class' => 'mw-nextlink'
				),
				$nextMsg
			);
		}
		
		$limitLinks = array();
		$limitLinkArgs = array();
		
		if ( $currentContinue == '' ) {
			$firstLink = $firstMsg;
		}
		else {
			$limitLinkArgs['continue'] = $currentContinue;
			
			$firstLink = Html::element(
				'a',
				array(
					'href' => $this->getTitle( $subPage )->getLocalURL( wfArrayToCGI( array( 'limit' => $limit ) ) ),
					'title' => wfMsgExt( 'swl-watchlist-firstn-title', array( 'parsemag', 'escape' ), $limit )
				),
				$firstMsg
			);			
		}
		
		foreach ( array( 20, 50, 100, 250, 500 ) as $limitValue ) {
			$limitLinkArgs['limit'] = $limitValue;
			if ( $offset != 0 ) {
				$limitLinkArgs['offset'] = $offset;
			}
			
			$limitLinks[] = Html::element(
				'a',
				array(
					'href' => $this->getTitle( $subPage )->getLocalURL( wfArrayToCGI( $limitLinkArgs ) ),
					'title' => wfMsgExt( 'shown-title', array( 'parsemag', 'escape' ), $limitValue )
				),
				$wgLang->formatNum( $limitValue )
			);
		}
		
		return Html::rawElement(
			'p',
			array(),
			wfMsgHtml( 'swl-watchlist-pagincontrol', $wgLang->pipeList( array( $firstLink, $nextLink ) ), $wgLang->pipeList( $limitLinks ) )
		);
	}
	
	/**
	 * Displays the watchlist.
	 * 
	 * @since 0.1
	 * 
	 * @param array of SWLChangeSet $sets
	 */
	protected function displayWatchlist( array $sets ) {
		global $wgOut, $wgLang, $wgUser;
		
		$lastViewed = $wgUser->getOption( 'swl_last_view' );
		
		if ( is_null( $lastViewed ) ) {
			$lastViewed = wfTimestampNow();
		}
		
		$wgUser->setOption( 'swl_last_view', wfTimestampNow() );
		$wgUser->saveSettings();
		
		$changeSetsHTML = array();
		
		foreach ( $sets as $set ) {
			$dayKey = substr( $set->getTime(), 0, 8 ); // Get the YYYYMMDD part.
			
			if ( !array_key_exists( $dayKey, $changeSetsHTML ) ) {
				$changeSetsHTML[$dayKey] = array();
			}
			
			$changeSetsHTML[$dayKey][] = $this->getChangeSetHTML( $set, $lastViewed );
		}
		
		krsort( $changeSetsHTML );
		
		foreach ( $changeSetsHTML as $dayKey => $daySets ) {
			$wgOut->addHTML( Html::element(
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
		
		$wgOut->addModules( 'ext.swl.watchlist' );
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
	 * @param integer $lastViewed The MW timestamp of when the user last viewed the watchlist
	 * 
	 * @return string
	 */
	protected function getChangeSetHTML( SWLChangeSet $changeSet, $lastViewed ) {
		global $wgLang;
		
		$html = '';
		
		$html .= '<li>';
		
		$html .= 
			'<p>' .
				$wgLang->time( $changeSet->getTime(), true ) . ' ' .
				Html::element(
					'a',
					array( 'href' => $changeSet->getTitle()->getLocalURL() ),
					$changeSet->getTitle()->getText()
				) . ' (' .
				Html::element(
					'a',
					array( 'href' => $changeSet->getTitle()->getLocalURL( 'action=history' ) ),
					wfMsg( 'hist' )
				) . ') . . ' .
				Html::element(
					'a',
					array( 'href' => $changeSet->getUser()->getUserPage()->getLocalURL() ),
					$changeSet->getUser()->getName()
				) . ' (' .
				Html::element(
					'a',
					array( 'href' => $changeSet->getUser()->getTalkPage()->getLocalURL() ),
					wfMsg( 'talkpagelinktext' )
				) . ' | ' .
				( $changeSet->getUser()->isAnon() ? '' :
					Html::element(
						'a',
						array( 'href' => SpecialPage::getTitleFor( 'Contributions', $changeSet->getUser()->getName() )->getLocalURL() ),
						wfMsg( 'contribslink' )						
					) . ' | '
				) .
				Html::element(
					'a',
					array( 'href' => SpecialPage::getTitleFor( 'Block', $changeSet->getUser()->getName() )->getLocalURL() ),
					wfMsg( 'blocklink' )
				) . ')' .
				( $changeSet->getTime() > $lastViewed ? ' [NEW]' : '' )	.
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
		$insertions = array();
		$deletions = array();
		
		// Convert the changes into a list of insertions and a list of deletions.
		foreach ( $changes as /* SMWPropertyChange */ $change ) {
			if ( !is_null( $change->getOldValue() ) ) {
				$deletions[] = SMWDataValueFactory::newDataItemValue( $change->getOldValue(), $property )->getLongHTMLText();
			}
			if ( !is_null( $change->getNewValue() ) ) {
				$insertions[] = SMWDataValueFactory::newDataItemValue( $change->getNewValue(), $property )->getLongHTMLText();
			}
		}
		
		$lines = array();
		
		if ( count( $insertions ) > 0 ) {
			$lines[] = Html::element( 'div', array( 'class' => 'swl-watchlist-insertions' ), wfMsg( 'swl-watchlist-insertions' ) ) . ' ' . implode( ', ', $insertions );
		}
		
		if ( count( $deletions ) > 0 ) {
			$lines[] = Html::element( 'div', array( 'class' => 'swl-watchlist-deletions' ), wfMsg( 'swl-watchlist-deletions' ) ) . ' ' . implode( ', ', $deletions );
		}		
		
		$html = Html::element( 'span', array( 'class' => 'swl-watchlist-prop' ), $property->getLabel() );
		
		$html .= Html::rawElement(
			'div',
			array( 'class' => 'swl-prop-div' ),
			implode( '<br />', $lines )
		);
		
		return $html;
	}
	
}
