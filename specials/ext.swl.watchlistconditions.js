/**
 * JavasSript for Special:WatchlistConditions in the Semantic Watchlist extension.
 * @see http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 */

(function($) { $( document ).ready( function() {
	
	function getSplitAttrValue( element, attribute, separator ) {
		if ( typeof element.attr( attribute ) == 'undefined'
			|| element.attr( attribute ) == '' ) {
			return [];
		}
		
		return element.attr( attribute ).split( separator );
	}
	
	$( '.swl_group' ).each(function( index, domElement ) {
		var element = $( domElement );
		
		element.watchlistcondition(
			{
				name: element.attr( 'groupname' ),
				categories: getSplitAttrValue( element, 'categories', '|' ),
				namespaces: getSplitAttrValue( element, 'namespaces', '|' ),
				properties: getSplitAttrValue( element, 'properties', '|' ),
				concepts: getSplitAttrValue( element, 'concepts', '|' )
			},
			{}
		);
	}) ;
	
} ); })(jQuery);