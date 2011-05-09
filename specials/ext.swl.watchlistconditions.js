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
		
		buildGroupHtml( element );
	}) ;
	
	function buildGroupHtml( element ) {
		element.text( '' ); // element.attr( 'categories' )
	}
	
} ); })(jQuery);