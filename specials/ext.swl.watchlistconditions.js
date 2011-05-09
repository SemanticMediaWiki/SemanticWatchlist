/**
 * JavasSript for Special:WatchlistConditions in the Semantic Watchlist extension.
 * @see http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 */

(function($) { $( document ).ready( function() {
	
	$( '.swl_group' ).each(function( index, domElement ) {
		var element = $( domElement );
		
		element.watchlistcondition(
			{
				name: element.attr( 'groupname' ),
				categories: element.attr( 'categories' ).split( '|' ),
				namespaces: element.attr( 'namespaces' ).split( '|' ),
				properties: element.attr( 'properties' ).split( '|' ),
				concepts: element.attr( 'concepts' ).split( '|' ),
			},
			{}
		);
	}) ;
	
} ); })(jQuery);