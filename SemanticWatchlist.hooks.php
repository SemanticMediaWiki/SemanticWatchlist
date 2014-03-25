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
final class SWLHooks {

    /**
     * Handles group notification.
     *
     * @since 0.1
     *
     * @param SWLGroup $group
     * @param array $userIDs
     * @param SMWChangeSet $changes
     *
     * @return true
     */
    public static function onGroupNotify( SWLGroup $group, array $userIDs, SWLChangeSet $changes ) {
    	global $egSWLMailPerChange, $egSWLMaxMails;

    	foreach ( $userIDs as $userID ) {
    		$user = User::newFromId( $userID );

    		if ( $user->getOption( 'swl_email', false ) ) {
				if ( $user->getName() != $changes->getEdit()->getUser()->getName() || $GLOBALS['egSWLEnableSelfNotify'] ) {
					if ( !method_exists( 'Sanitizer', 'validateEmail' ) || Sanitizer::validateEmail( $user->getEmail() ) ) {
						$lastNotify = $user->getOption( 'swl_last_notify' );
						$lastWatch = $user->getOption( 'swl_last_watch' );

						if ( is_null( $lastNotify ) || is_null( $lastWatch ) || $lastNotify < $lastWatch ) {
							$mailCount = $user->getOption( 'swl_mail_count', 0 );

							if ( $egSWLMailPerChange || $mailCount < $egSWLMaxMails ) {
								SWLEmailer::notifyUser( $group, $user, $changes, $egSWLMailPerChange );
								$user->setOption( 'swl_last_notify', wfTimestampNow() );
								$user->setOption( 'swl_mail_count', $mailCount + 1 );
								$user->saveSettings();
							}
						}
					}
				}
    		}
    	}

        return true;
    }

	/**
	 * Adds a link to Admin Links page.
	 *
	 * @since 0.1
	 *
	 * @return true
	 */
	public static function addToAdminLinks( &$admin_links_tree ) {
	    $displaying_data_section = $admin_links_tree->getSection( wfMsg( 'adminlinks_browsesearch' ) );

	    // Escape if SMW hasn't added links.
	    if ( is_null( $displaying_data_section ) ) return true;
	    $smw_docu_row = $displaying_data_section->getRow( 'smw' );

	    $smw_docu_row->addItem( AlItem::newFromSpecialPage( 'WatchlistConditions' ) );

	    return true;
	}

}
