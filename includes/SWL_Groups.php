<?php

/**
 * Static class with functions interact with watchlist groups.
 * 
 * @since 0.1
 * 
 * @file SWL_Groups.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
final class SWLGroups {
	
	protected static $groups = false;
	
    /**
     * Returns all watchlist groups.
     *
     * @since 0.1
     *
     * @return array of SWLGroup
     */	
	public static function getAll() {
		if ( self::$groups === false ) {
			self::$groups = array();
			
	        $dbr = wfGetDB( DB_SLAVE );
	
	        $groups = $dbr->select( 'swl_groups', array( 'group_id', 'group_categories', 'group_namespaces', 'group_properties' ) );
	
	        foreach ( $groups as $group ) {
	        	self::$groups[] = SWLGroup::newFromDBResult( $group );
	        }
		}
        
        return self::$groups;
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
    public static function getMatchingWatchGroups( Title $title ) {
        $matchingGroups = array();

        foreach ( self::getAll() as $group ) {
            if ( self::getIfGroupMatches( $group, $title ) ) {
                $matchingGroups[] = $group;
            }
        }

        return $matchingGroups;
    }

    /**
     * Determines and returns if the specified watchlist group covers
     * the provided page or not. 
     * 
     * @since 0.1
     *
     * @param SWLGroup $group
     * @param Title $title
     *
     * @return boolean
     */
    public static function getIfGroupMatches( SWLGroup $group, Title $title ) {
		return true; // TODO
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
	
}
