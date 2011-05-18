/**
 * JavasSript for Special:WatchlistConditions in the Semantic Watchlist extension.
 * @see http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 */

(function( $ ){ $.fn.watchlistcondition = function( group, options ) {

	var self = this;
	
	this.buildHtml = function() {
		this.html( $( '<legend />' ).text( group.name ) );
		
		var table = $( '<table />' ).attr( { 'class': 'swltable' } );
		
		var propTd = $( '<td />' ).attr( {
			//'bgcolor': 'gray',
			'rowspan': 2
		} );
		
		propTd.html( mediaWiki.msg( 'swl-group-properties' ) );
		
		for ( i in group.properties ) {
			propTd.append( this.getPropertyDiv( group.properties[i] ) );
		}
		
		table.append( $( '<tr />' ).html( $( '<td />' ) ).append( propTd ) );
		
		var nameInput = $( '<input />' ).attr( {
			'type': 'text',
			'value': group.name,
			'size': 30
		} );
		var nameTd = $( '<td />' ).html( $( '<p />' ).text( mediaWiki.msg( 'swl-group-name' ) + ' ' ).append( nameInput ) );
		table.append( $( '<tr />' ).html( nameTd ) );
		
		var conditionNameInput = $( '<input />' ).attr( {
			'type': 'text',
			'value': group.name,
			'size': 30
		} );
		var conditionTd = $( '<td />' ).html( $( '<p />' ).text( mediaWiki.msg( 'swl-group-page-selection' ) + ' ' ).append( conditionNameInput ) );
		table.append( $( '<tr />' ).html( conditionTd ) );
		
		this.append( table );
		
		this.append(
			$( '<input />' ).attr( {
				'type': 'button',
				'value': mediaWiki.msg( 'save' )
			} ).click( function() {
				this.disabled = true;
				self.doSave( function() { this.disabled = false; } );
			} )
		);		
	}
	
	this.getPropertyDiv = function( property ) {
		var propDiv = $( '<div />' ).attr( 'class', 'propid' );
		
		var propInput = $( '<input />' ).attr( {
			'type': 'text',
			'value': property,
			'size': 30
		} );
		
		var removeButton = $( '<input />' ).attr( {
			'type': 'button',
			value: mediaWiki.msg( 'swl-group-remove-property' )
		} );
		
		removeButton.click( function() {
			propDiv.remove();
		} );
		
		return propDiv.html( propInput ).append( removeButton );
	}
	
	this.doSave = function( callback ) {
		
	}
	
	this.buildHtml();
	
	return this;
	
}; })( jQuery );