<?php

/**
 * Represents a change to a semantic property.
 * 
 * @since 0.1
 * 
 * @file SWL_Change.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SWLChange {

	const TYPE_INSERT = 0;
	const TYPE_UPDATE = 1;
	const TYPE_DELETE = 2;
	
	protected $propertyName;
	
	protected $oldValue;
	
	protected $newValue;
	
	public function __construct( $propertyName, $oldValue, $newValue ) {
		$this->propertyName = $propertyName;
		$this->oldValue = $oldValue;
		$this->newValue = $newValue;
	}
	
	public function getPropertyName() {
		return $this->propertyName;
	}	
	
	public function getOldValue() {
		return $this->oldValue;
	}
	
	public function getNewValue() {
		return $this->newValue;
	}
	
	public function getType() {
		if ( is_null( $this->oldValue ) ) {
			return self::TYPE_INSERT;
		}
		else if ( is_null( $this->newValue ) ) {
			return self::TYPE_DELETE;
		}
		else {
			return self::TYPE_UPDATE;
		}
	}
	
}
	