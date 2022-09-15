<?php

/**
 * Static class with functions interact with watchlist groups.
 *
 * @since 0.1
 *
 * @file Groups.php
 * @ingroup SemanticWatchlist
 *
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
namespace SWL;

use Title;
use User;

final class Groups {

	/**
	 * Cached list of all watchlist groups.
	 *
	 * @var array of Group
	 */
	private static $groups = false;

    /**
     * Returns all watchlist groups.
     *
     * @since 0.1
     *
     * @return array of Group
     */
	public static function getAll() {
		if ( self::$groups === false ) {
			self::$groups = array();

	        $dbr = wfGetDB( DB_REPLICA );

	        $groups = $dbr->select( 'swl_groups', array(
				'group_id',
				'group_name',
				'group_categories',
				'group_namespaces',
				'group_properties',
				'group_concepts',
				'group_custom_texts'
	        ) );

	        foreach ( $groups as $group ) {
	        	self::$groups[] = Group::newFromDBResult( $group );
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
     * @return array of Group
     */
    public static function getMatchingWatchGroups( Title $title ) {
        $matchingGroups = array();

        foreach ( self::getAll() as /* Group */ $group ) {
            if ( $group->coversPage( $title ) ) {
                $matchingGroups[] = $group;
            }
        }

        return $matchingGroups;
    }

    /**
     * Returns all watchlist groups that are watched by the specified user.
     *
     * @since 0.1
     *
     * @param User $user
     *
     * @return array of Group
     */
	public static function getGroupsForUser( User $user ) {
        $matchingGroups = array();

        foreach ( self::getAll() as /* Group */ $group ) {
            if ( $group->isWatchedByUser( $user ) ) {
                $matchingGroups[] = $group;
            }
        }

        return $matchingGroups;
	}

}
