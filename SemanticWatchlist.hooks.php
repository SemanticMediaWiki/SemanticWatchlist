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
	public static function onDataChanged( SMWStore $store, SMWChangeSet $changes ) {
		$changes = new SWLChangeSet( $changes );
		$groups = SWLGroups::getMatchingWatchGroups( $changes->getTitle() );
		
		$wasInserted = $changes->writeToStore( $groups ) != 0;
		
		if ( $wasInserted ) {
	        foreach ( $groups as /* SWLGroup */ $group ) {
        		$group->notifyWatchingUsers( $changes );
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
    	global $egSWLMailPerChange;
    	
    	foreach ( $userIDs as $userID ) {
    		$user = User::newFromId( $userID );
    		
    		if ( $user->getOption( 'swl_email', false ) && Sanitizer::validateEmail( $user->getEmail() ) ) {
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
		
		$preferences['swl_email'] = array(
			'type' => 'toggle',
			'label-message' => 'swl-prefs-emailnofity',
			'section' => 'swl/swlnotification',
			'default' => $GLOBALS['egSWLEnableEmailNotify']
		);		
		
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
					$name = $item[0];
					break;
			}
			
			$properties = $group->getProperties();
			
			foreach ( $properties as &$property ) {
				$property = "''$property''";
			}
			
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
	 * Called just before saving user preferences/options.
	 * Find the watchlist groups the user watches, and update the swl_users_per_group table.
	 * 
	 * @since 0.1
	 * 
	 * @param User $user
	 * @param array $options
	 * 
	 * @return true
	 */
	public static function onUserSaveOptions( User $user, array &$options ) {
		$dbw = wfGetDB( DB_MASTER );
		
		$dbw->begin();
		
		$dbw->delete(
			'swl_users_per_group',
			array( 'upg_user_id' => $user->getId() )
		);
		
		foreach ( $options as $name => $value ) {
			if ( strpos( $name, 'swl_watchgroup_' ) === 0 && $value ) {
				$dbw->insert(
					'swl_users_per_group',
					array(
						'upg_user_id' => $user->getId(),
						'upg_group_id' => (int)substr( $name, strrpos( $name, '_' ) + 1 )
					)
				);				
			}
		}
		
		$dbw->commit();
		
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
	
}