/**
 * JavasSript for Special:WatchlistConditions in the Semantic Watchlist extension.
 * @see http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 */

(function( $ ){ $.fn.watchlistcondition = function( group, options ) {

	this.html( $( '<h3 />' ).text( group.name ) );
	
	nameInput = $( '<input />' ).attr( 'type', 'text' ).attr( 'value', group.name );
	
	this.append( $( '<p />' ).text( mediaWiki.msg( 'swl-group-name' ) ).append( nameInput ) );	
	
	return this;
	
}; })( jQuery );