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
     * @param SMWSemanticData $data
     */
	public static function onDataChanged( SMWStore $store, SMWSemanticData $data ) {
        $title = $data->getSubject()->getTitle();
        $groups = self::getMatchingWatchGroups( $title );

        foreach ( $groups as $group ) {
            $matches = self::getIfGroupMatches( $group, $title );

            if ( $matches ) {
                self::notifyUsersForGroup( $group, $data );
                wfRunHooks( 'SWLGroupNotify', array( $group, $data ) );
            }
        }


	}

    /**
     * Returns all watchlist groups that watch the specified page.
     *
     * @since 0.1
     *
     * @param Title $title
     *
     * @return array
     */
    protected static function getMatchingWatchGroups( Title $title ) {
        $dbr = wfGetDB( DB_SLAVE );

        $groups = $dbr->select( 'swl_groups', array( 'group_id', 'group_categories', 'group_namespaces', 'group_properties' ) );

        $matchingGroups = array();

        foreach ( $groups as $group ) {
            if ( self::getIfGroupMatches( $group, $title ) ) {
                $matchingGroups[] = $group;
            }
        }

        return $matchingGroups;
    }

    /**
     * Determines and returns if the specified watchlist group covers
     *the provided page or not. 
     * 
     * @since 0.1
     *
     * @param  $group
     *
     * @return boolean
     */
    protected static function getIfGroupMatches( $group, Title $title ) {

    }

    public static function onGroupNotify( $group, SMWSemanticData $data ) {
        self::notifyUsersForGroup( $group, $data );
    }

    /**
     * Notifies all users that are watching a group and that should be notified
     * of the provided changes.
     *
     * @since 0.1
     *
     * @param  $group
     * @param SMWSemanticData $data
     */
    protected static function notifyUsersForGroup( $group, SMWSemanticData $data ) {
        $users = self::getUsersForGroup( $group );

        foreach ( $users as $userId ) {
            if ( self::userShouldBeNotified( $userId ) ) {
                self::notifyUserOfChangesToGroup( $userId, $group, $data );
            }
        }
    }

    /**
     * Returns the list of users watching the specified watchlist group.
     *
     * @since 0.1
     *
     * @param  $group
     *
     * @return array
     */
    protected static function getUsersForGroup( $group ) {

    }

    /**
     * Determines and returns if a certain user should be notified of changes
     * or not (in case this already happened, so this extension doesn't spam).
     *
     * @since 0.1
     *
     * @param integer $userId
     *
     * @return boolean
     */
    protected static function userShouldBeNotified( $userId ) {

    }

    protected static function notifyUserOfChangesToGroup( $userId, $group, SMWSemanticData $data ) {

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
		}

		return true;
	}
	
}