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
     * Handle the onDataChanged hook of SMW >1.6, which gets called
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
		$subject = $newData->getSubject();
		$oldData = $store->getSemanticData( $subject );
		$title = Title::makeTitle( $subject->getNamespace(), $subject->getDBkey() );

		$groups = SWLGroups::getMatchingWatchGroups( $title );

		$edit = false;

		foreach ( $groups as /* SWLGroup */ $group ) {
			$changeSet = SWLChangeSet::newFromSemanticData( $oldData, $newData, $group->getProperties() );

			if ( $changeSet->hasUserDefinedProperties() ) {
				if ( $edit === false ) {
					$edit = new SWLEdit(
						$title->getArticleID(),
						$GLOBALS['wgUser']->getName(),
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
				if ( $user->getName() != $changes->getEdit()->getUser()->getName() || $egSWLEnableSelfNotify ) {
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
     * Adds the preferences of Semantic Watchlist to the list of available ones.
     *
     * @since 0.1
     *
     * @param User $user
     * @param array $preferences
     *
     * @return true
     */
	public static function onGetPreferences( User $user, array &$preferences ) {
		$groups = SWLGroups::getAll();

		// Only show the email notification preference when email notifications are enabled.
		if ( $GLOBALS['egSWLEnableEmailNotify'] ) {
			$preferences['swl_email'] = array(
				'type' => 'toggle',
				'label-message' => 'swl-prefs-emailnofity',
				'section' => 'swl/swlglobal',
			);
		}

		// Only show the top link preference when it's enabled.
		if ( $GLOBALS['egSWLEnableTopLink'] ) {
			$preferences['swl_watchlisttoplink'] = array(
				'type' => 'toggle',
				'label-message' => 'swl-prefs-watchlisttoplink',
				'section' => 'swl/swlglobal',
			);
		}

		foreach ( $groups as /* SWLGroup */ $group ) {
			if ( count( $group->getProperties() ) == 0 ) {
				continue;
			}

			switch ( true ) {
				case count( $group->getCategories() ) > 0 :
					$type = 'category';
					$name = $group->getCategories();
					$name = $name[0];
					break;
				case count( $group->getNamespaces() ) > 0 :
					$type = 'namespace';
					$name = $group->getNamespaces();
					$name = $name[0] == 0 ? wfMsg( 'main' ) : MWNamespace::getCanonicalName( $name[0] );
					break;
				case count( $group->getConcepts() ) > 0 :
					$type = 'concept';
					$name = $group->getConcepts();
					$name = $name[0];
					break;
				default:
					continue;
			}

			$properties = $group->getProperties();

			foreach ( $properties as &$property ) {
				$property = "''$property''";
			}

			// Give grep a chance to find the usages:
			// swl-prefs-category-label, swl-prefs-namespace-label, swl-prefs-concept-label
			$preferences['swl_watchgroup_' . $group->getId()] = array(
				'type' => 'toggle',
				'label' => wfMsgExt(
					"swl-prefs-$type-label",
					'parseinline',
					$group->getName(),
					count( $group->getProperties() ),
					$GLOBALS['wgLang']->listToText( $properties ),
					$name
				),
				'section' => 'swl/swlgroup',
			);
		}

		return true;
	}

	/**
	 * Schema update to set up the needed database tables.
	 *
	 * @since 0.1
	 *
	 * @param DatabaseUpdater $updater
	 *
	 * @return true
	 */
	public static function onSchemaUpdate( /* DatabaseUpdater */ $updater = null ) {
		global $wgDBtype;

		if ( $wgDBtype == 'mysql' ) {
            $updater->addExtensionUpdate( array(
                'addTable',
                'swl_groups',
                dirname( __FILE__ ) . '/SemanticWatchlist.sql',
                true
            ) );
            $updater->addExtensionUpdate( array(
                'addTable',
                'swl_changes',
                dirname( __FILE__ ) . '/SemanticWatchlist.sql',
                true
            ) );
			$updater->addExtensionUpdate( array(
                'addTable',
                'swl_sets',
                dirname( __FILE__ ) . '/SemanticWatchlist.sql',
                true
            ) );
			$updater->addExtensionUpdate( array(
                'addTable',
                'swl_edits_per_group',
                dirname( __FILE__ ) . '/SemanticWatchlist.sql',
                true
            ) );
			$updater->addExtensionUpdate( array(
                'addTable',
                'swl_sets_per_group',
                dirname( __FILE__ ) . '/SemanticWatchlist.sql',
                true
            ) );
			$updater->addExtensionUpdate( array(
                'addTable',
                'swl_users_per_group',
                dirname( __FILE__ ) . '/SemanticWatchlist.sql',
                true
            ) );
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
