/**
 * JavasSript for Special:WatchlistConditions in the Semantic Watchlist extension.
 * @see http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 */

(function( $ ){ $.fn.watchlistcondition = function( group, options ) {

	this.html( $( '<legend />' ).text( group.name ) );
	
	var table = $( '<table />' ).attr( { 'class': 'swltable' } );
	
	var nameInput = $( '<input />' ).attr( { 'type': 'text', 'value': group.name } );
	
	table.html( $( '<tr />' ).html( $( '<td />' ).attr( 'colspan', 2 ).html(
		$( '<p />' ).text( mediaWiki.msg( 'swl-group-name' ) ).append( nameInput )
	) ) );
	
	var propTd = $( '<td />' );
	
	propTd.html( mediaWiki.msg( 'swl-group-properties' ) );
	
	for ( i in group.properties ) {
		propTd.append( getPropertyDiv( group.properties[i] ) );
	}
	
	table.append( $( '<tr />' ).attr( 'colspan', 2 ).append( propTd ) );
	
	this.append( table );
	
	function getPropertyDiv( property ) {
		var propInput = $( '<input />' ).attr( {
			'type': 'text',
			'value': property,
			'size': 30
		} );
		
		var removeButton = $( '<input />' ).attr( {
			'type': 'button',
			value: mediaWiki.msg( 'swl-group-remove-property' )
		} );
		
		return $( '<div />' ).attr( 'class', 'propid' ).html( propInput ).append( removeButton );
	}
	
	return this;
	
}; })( jQuery );