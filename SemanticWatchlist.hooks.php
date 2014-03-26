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
