/**
 * JavaScript for Special:WatchlistConditions in the Semantic Watchlist extension.
 * @see http://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
 *
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 * @author Nischay Nahata
 */

(function($) { $( document ).ready( function() {

	function getSplitAttrValue( element, attribute, separator ) {
		if ( typeof element.attr( attribute ) == 'undefined'
			|| element.attr( attribute ) == '' ) {
			return [];
		}

		return element.attr( attribute ).split( separator );
	}

	function groupFromElement( element ) {
		var group = {
					name: element.attr( 'groupname' ),
					id: element.attr( 'groupid' ),
					categories: getSplitAttrValue( element, 'categories', '|' ),
					namespaces: getSplitAttrValue( element, 'namespaces', '|' ),
					properties: getSplitAttrValue( element, 'properties', '|' ),
					concepts: getSplitAttrValue( element, 'concepts', '|' ),
					customTexts: getSplitAttrValue( element, 'customTexts', '|' )
				};
		return group;
	}

	function initGroupElement( element ) {
		element.watchlistcondition(
			groupFromElement( element ),
			{}
		);
		element.buildHtml();
	}

	function saveGroupElement( element, button ) {
		element.watchlistcondition(
			groupFromElement( element ),
			{}
		);
		element.doSave(function( success ) {
			if ( success ) {
				$( button ).val( mw.msg( 'swl-group-saved' ) );
				setTimeout( function() {
					$( button ).val( mw.msg( 'swl-group-save' ) );
					button.disabled = false;
				}, 1000 );
			}
			else {
				alert( 'Could not update the watchlist group.' );
				button.disabled = false;
			}
		});
	}

	$( '.swl_group' ).each(function( index, domElement ) {
		initGroupElement( $( domElement ) );
	});

	$( '#swl-save-all' ).click( function() {
		this.disabled = true;
		var button = this;
		$( '.swl_group' ).each(function( index, domElement ) {
			saveGroupElement( $( domElement ), button );
		});
	} );

	function addGroupToDB( groupName, callback ) {
		$.getJSON(
			wgScriptPath + '/api.php',
			{
				'action': 'addswlgroup',
				'format': 'json',
				'name': groupName,
				'properties': ''
			},
			function( data ) {
				callback( data.success, data.group );
			}
		);
	}

	function addGroupToGUI( groupName, groupId ) {
		var newGroup = $( '<fieldset />' ).attr( {
			'id': 'swl_group_' + groupId,
			'groupid': groupId,
			'class': 'swl_group',
			'groupname': groupName,
			'categories': '',
			'namespaces': '',
			'properties': '',
			'concepts': '',
			'customTexts': ''
		} )
		.html( $( '<legend />' ).text( groupName ) );

		$( '#swl-groups' ).append( newGroup );

		initGroupElement( newGroup );
	}

	$( '#swl-add-group-button' ).click( function() {
		var button = this;

		button.disabled = true;
		addGroupToGUI( '', '' );
		button.disabled = false;
	} );

} ); })(jQuery);