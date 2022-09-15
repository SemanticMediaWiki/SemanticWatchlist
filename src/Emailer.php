<?php

/**
 * Static class holding functions for sending emails.
 *
 * @since 0.1
 *
 * @file Emailer.php
 * @ingroup SemanticWatchlist
 *
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
namespace SWL;

use Html;
use Hooks;
use SpecialPage;
use User;
use UserMailer;
use SMWDataValueFactory;
use SMWPDIProperty;

final class Emailer {

	/**
	 * Notifies a single user of the changes made to properties in a single edit.
	 *
	 * @since 0.1
	 *
	 * @param Group $group
	 * @param User $user
	 * @param ChangeSet $changeSet
	 * @param boolean $describeChanges
	 *
	 * @return Status
	 */
	public static function notifyUser( Group $group, User $user, ChangeSet $changeSet, $describeChanges ) {
		global $wgLang, $wgPasswordSender, $wgPasswordSenderName;

		$emailText = wfMessage(
			'swl-email-propschanged-long',
			$GLOBALS['wgSitename'],
			$changeSet->getEdit()->getUser()->getName(),
			SpecialPage::getTitleFor( 'SemanticWatchlist' )->getFullURL(),
			$wgLang->time( $changeSet->getEdit()->getTime() ),
			$wgLang->date( $changeSet->getEdit()->getTime() )
		)->parseAsBlock();

		if ( $describeChanges ) {
			$emailText .= Html::rawElement( 'h3', array(), wfMessage(
				'swl-email-changes',
				$changeSet->getEdit()->getTitle()->getFullText(),
				$changeSet->getEdit()->getTitle()->getFullURL()
			)->parseAsBlock() );

			$emailText .= self::getChangeListHTML( $changeSet, $group );
		}

		$title = wfMessage( 'swl-email-propschanged', array( $changeSet->getEdit()->getTitle()->getFullText() ) )->text();

		Hooks::run( 'SWLBeforeEmailNotify', array( $group, $user, $changeSet, $describeChanges, &$title, &$emailText ) );

		if ( version_compare( $GLOBALS['wgVersion'], '1.27', '<' ) ) {
			return UserMailer::send(
				new MailAddress( $user ),
				new MailAddress( $wgPasswordSender, $wgPasswordSenderName ),
				$title,
				$emailText,
				null,
				'text/html; charset=ISO-8859-1'
			);
		} else {
			return UserMailer::send(
				new MailAddress( $user ),
				new MailAddress( $wgPasswordSender, $wgPasswordSenderName ),
				$title,
				$emailText,
				array( 'contentType' => 'text/html; charset=ISO-8859-1' )
			);
		}
	}

	/**
	 * Creates and returns the HTML representation of the change set.
	 *
	 * @since 0.1
	 *
	 * @param ChangeSet $changeSet
	 * @param Group $group
	 *
	 * @return string
	 */
	private static function getChangeListHTML( ChangeSet $changeSet, Group $group ) {
		$propertyHTML = array();
		$customTexts = newC ustomTexts( $group );
		foreach ( $changeSet->getAllProperties() as /* SMWDIProperty */ $property ) {
			$propertyHTML[] = self::getPropertyHTML( $property, $changeSet->getAllPropertyChanges( $property ), $customTexts );
		}

		return implode( '', $propertyHTML );
	}

	/**
	 * Creates and returns the HTML representation of the property and it's changes.
	 *
	 * @since 0.1
	 *
	 * @param SMWDIProperty $property
	 * @param array $changes
	 * @param CustomTexts $customTexts
	 * @return string
	 */
	private static function getPropertyHTML( SMWDIProperty $property, array $changes, CustomTexts $customTexts ) {
		$insertions = array();
		$deletions = array();
		$customMessages = array();
		$justCustomMessage = false;

		// Convert the changes into a list of insertions and a list of deletions.
		foreach ( $changes as /* PropertyChange */ $change ) {
			$justCustomMessage = false;
			if ( !is_null( $change->getNewValue() ) && $customTexts->getPropertyCustomText( $property, $change->getNewValue()->getSerialization() ) ) {
				$customMessages[] = $customTexts->getPropertyCustomText( $property, $change->getNewValue()->getSerialization() );
				$justCustomMessage = true;
			}
			if( !$justCustomMessage ) {
				if ( !is_null( $change->getOldValue() ) ) {
					$deletions[] = SMWDataValueFactory::newDataItemValue( $change->getOldValue(), $property )->getShortHTMLText();
				}
				if ( !is_null( $change->getNewValue() ) ) {
					$insertions[] = SMWDataValueFactory::newDataItemValue( $change->getNewValue(), $property )->getShortHTMLText();
				}
			}
		}

		$lines = array();

		if ( count( $insertions ) > 0 ) {
			$lines[] = Html::element( 'span', array(), wfMessage( 'swl-watchlist-insertions' )->text() ) . ' ' . implode( ', ', $insertions );
		}

		if ( count( $deletions ) > 0 ) {
			$lines[] = Html::element( 'span', array(), wfMessage( 'swl-watchlist-deletions' )->text() ) . ' ' . implode( ', ', $deletions );
		}

		foreach( $customMessages as $customMessage ) {
			$lines[] = Html::element( 'span', array(), $customMessage );
		}

		$html = Html::element( 'b', array(), $property->getLabel() );

		$html .= Html::rawElement(
			'div',
			array( 'class' => 'swl-prop-div' ),
			implode( '<br />', $lines )
		);

		return $html;
	}

}
