<?php

/**
 * Static class for hooks handled by the Semantic Watchlist extension.
 *
 * @since 0.1
 *
 * @file SemanticWatchlist.hooks.php
 * @ingroup SemanticWatchlist
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
namespace SWL;

use AlItem;
use ALRow;
use ALTree;
use MediaWiki\MediaWikiServices;
use RequestContext;
use Sanitizer;
use SMWSemanticData;
use SMWStore;
use Title;
use User;

final class Hooks {

    /**
     * Handle the updateDataBefore hook of SMW >1.6, which gets called
     * every time the value of a propery changes somewhere.
     *
     * @since 0.1
     *
     * @param SMWStore $store
     * @param SMWChangeSet $changes
     *
     * @return true
     */
	public static function onDataUpdate( SMWStore $store, SMWSemanticData $newData ) {
		wfDebugLog( 'SemanticWatchlist', __METHOD__ . ' was called' );
		$subject = $newData->getSubject();
		$oldData = $store->getSemanticData( $subject );
		$title = Title::makeTitle( $subject->getNamespace(), $subject->getDBkey() );

		$groups = Groups::getMatchingWatchGroups( $title );

		$edit = false;

		foreach ( $groups as /* SWLGroup */ $group ) {
			$changeSet = ChangeSet::newFromSemanticData( $oldData, $newData, $group->getProperties() );

			$hasUserDefinedProps = $changeSet->hasUserDefinedProperties();
			wfDebugLog(
				'SemanticWatchlist',
				'Group #{groupId} has user defined properties: {udef}',
				'all',
				[
					'groupId' => $group->getId(),
					'udef' => $hasUserDefinedProps ? 'yes' : 'no',
				]
			);
			if ( $hasUserDefinedProps ) {
				if ( $edit === false ) {
					$edit = new Edit(
						$title->getArticleID(),
						RequestContext::getMain()->getUser()->getName(),
						wfTimestampNow()
					);

					$edit->writeToDB();
				}

				$changeSet->setEdit( $edit );
				$setId = $changeSet->writeToStore( $groups, $edit->getId() );

				if ( $setId != 0 ) {
					$group->notifyWatchingUsers( $changeSet );
				}
			}
		}

		return true;
	}

    /**
     * Handles group notification.
     *
     * @since 0.1
     *
     * @param Group $group
     * @param array $userIDs
     * @param SMWChangeSet $changes
     *
     * @return true
     */
    public static function onGroupNotify( Group $group, array $userIDs, ChangeSet $changes ) {
    	global $egSWLMailPerChange, $egSWLMaxMails;

		$userOptionsManager = MediaWikiServices::getInstance()->getUserOptionsManager();

    	foreach ( $userIDs as $userID ) {
    		$user = User::newFromId( $userID );

			if ( $userOptionsManager->getOption( $user, 'swl_email', false )
				&& (
					$user->getName() != $changes->getEdit()->getUser()->getName()
					|| $GLOBALS['egSWLEnableSelfNotify']
				)
				&& Sanitizer::validateEmail( $user->getEmail() )
			) {
				$lastNotify = $userOptionsManager->getOption( $user, 'swl_last_notify' );
				$lastWatch = $userOptionsManager->getOption( $user, 'swl_last_watch' );

				if ( is_null( $lastNotify ) || is_null( $lastWatch ) || $lastNotify < $lastWatch ) {
					$mailCount = $userOptionsManager->getOption(
						$user, 'swl_mail_count', 0 );

					if ( $egSWLMailPerChange || $mailCount < $egSWLMaxMails ) {
						Emailer::notifyUser( $group, $user, $changes, $egSWLMailPerChange );
						$userOptionsManager->setOption( $user, 'swl_last_notify', wfTimestampNow() );
						$userOptionsManager->setOption( $user, 'swl_mail_count', $mailCount + 1 );
						$userOptionsManager->saveOptions( $user );
					}
				}

			}
    	}

        return true;
    }

	/**
	 * Adds a link to Admin Links page.
	 *
	 * @param ALTree $admin_links_tree
	 * @since 0.1
	 */
	public static function addToAdminLinks( ALTree $admin_links_tree ) {
		$displaying_data_section = $admin_links_tree->getSection( wfMessage( 'adminlinks_browsesearch' )->text() );

		// Escape if SMW hasn't added links.
		if ( !$displaying_data_section ) {
			return;
		}
		$smw_row = $displaying_data_section->getRow( 'smw' );
		if ( !$smw_row ) {
			$smw_row = new ALRow( 'smw-watchlist' );
			$displaying_data_section->addRow( $smw_row );
		}

		$smw_row->addItem( AlItem::newFromSpecialPage( 'WatchlistConditions' ) );
	}

}
