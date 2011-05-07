<?php

/**
 * 
 * 
 * @since 0.1
 * 
 * @file SWL_ChangeSet.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SWLChangeSet implements Iterator {
	
	protected $pos = 0;
	protected $currentRow = null;
	
	protected $changes;
	
	public static function newFromSemanticData( SMWSemanticData $old, SMWSemanticData $new ) {
		$changes = array();
		
		// TODO: real diff
		
		$changes = new Change( 'awesomeness', 9000, 9001 );
		$changes = new Change( 'foo', 'bar', 'baz' );
		
		return new SWLChangeSet( $changes );
	}
	
	public function __construct( $changes = array() ) {
		$this->changes = $changes;
	}
	
	function rewind() {
		$this->pos = 0;
		$this->currentRow = null;
	}

	function current() {
		if ( is_null( $this->currentRow ) ) {
			$this->next();
		}
		return $this->currentRow;
	}

	function key() {
		return $this->pos;
	}

	function next() {
		$this->pos++;
		$this->currentRow = array_key_exists( $this->pos, $this->changes ) ? $this->changes[$this->pos] : false;
		return $this->currentRow;
	}

	function valid() {
		return $this->current() !== false;
	}	
	
}
