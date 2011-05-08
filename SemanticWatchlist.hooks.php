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
     * @param SMWSemanticData $oldData
     * @param SMWSemanticData $newData
     * 
     * @return true
     */
	public static function onDataChanged( SMWStore $store, SMWSemanticData $oldData, SMWSemanticData $newData ) {
		$title = Title::makeTitle( $newData->getSubject()->getNamespace(), $newData->getSubject()->getDBkey() );
		
		var_dump(SWLGroups::getMatchingWatchGroups( $title ));exit;
		
        foreach ( SWLGroups::getMatchingWatchGroups( $title ) as $group ) {
            SWLGroups::notifyUsersForGroup( $group, $data );
            wfRunHooks( 'SWLGroupNotify', array( $group, $data ) );
    	}

		return true;
	}

    /**
     * Determines and returns if the specified watchlist group covers
     * the provided page or not. 
     * 
     * @since 0.1
     *
     * @param  $group
     *
     * @return boolean
     */    
    public static function onGroupNotify( $group, SMWSemanticData $data ) {
        self::notifyUsersForGroup( $group, $data );
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
                'swl_changes_per_group',
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