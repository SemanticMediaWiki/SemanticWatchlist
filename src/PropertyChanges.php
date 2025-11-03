<?php

/**
 * A collection of semantic properties and changes changes made to them.
 * This class is based on SMWSemanticData and can be seen as a simplified
 * version with PropertyChange objects, each holding 2 SMWDataItem objects,
 * instead of SMWDataItem objects.
 * 
 * @since 0.1
 * 
 * @file SWL_PropertyChange.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
namespace SWL;

use Iterator;
use SMW\DIProperty;
use SMW\DataValues\PropertyValue;

class PropertyChanges implements Iterator {

	private $pos = 0;
	private $currentRow = null;	
	
	/**
	 * Cache for the localized version of the namespace prefix "Property:".
	 *
	 * @var string
	 */
	static private $propertyPrefix = '';	
	
	/**
	 * Array mapping property keys (string) to arrays of PropertyChange.
	 * 
	 * @var array of PropertyChange
	 */
	private $changes = array();
	
	/**
	 * Array mapping property keys (string) to DIProperty objects.
	 *
	 * @var array of DIProperty
	 */
	private $properties = array();
	
	/**
	 * Indicates if there are changes in the list.
	 * 
	 * @var boolean
	 */
	private $hasChanges = false;
	
	/**
	 * Get the array of all properties that have changes.
	 *
	 * @return array of DIProperty
	 */
	public function getProperties() {
		return $this->properties;
	}
	
	/**
	 * Returns if the list contains any changes.
	 * This info is cached, so the call is cheaper then doing a count.
	 * 
	 * @return boolean
	 */
	public function hasChanges() {
		return $this->hasChanges;
	}
	
	/**
	 * Get the array of all stored values for some property.
	 *
	 * @param $property DIProperty
	 * 
	 * @return array of PropertyChange
	 */
	public function getPropertyChanges( DIProperty $property ) {
		if ( array_key_exists( $property->getKey(), $this->changes ) ) {
			return $this->changes[$property->getKey()];
		} else {
			return array();
		}  
	}
	
	/**
	 * Store a value for a property identified by its SMWDataItem object.
	 *
	 * @note There is no check whether the type of the given data item
	 * agrees with the type of the property. Since property types can
	 * change, all parts of SMW are prepared to handle mismatched data item
	 * types anyway.
	 *
	 * @param DIProperty $property
	 * @param PropertyChange $change
	 */
	public function addPropertyObjectChange( DIProperty $property, PropertyChange $change ) {
		if ( $property->isInverse() ) { // inverse properties cannot be used for annotation
			return;
		}

		if ( !array_key_exists( $property->getKey(), $this->changes ) ) {
			$this->changes[$property->getKey()] = array();
			$this->properties[$property->getKey()] = $property;
		}

		$this->changes[$property->getKey()][] = $change;
		
		$this->hasChanges = true;
	}

	/**
	 * Store a value for a given property identified by its text label
	 * (without namespace prefix).
	 *
	 * @param string $propertyName
	 * @param PropertyChange $change
	 */
	public function addPropertyChange( $propertyName, PropertyChange $change ) {
		$propertyKey = smwfNormalTitleDBKey( $propertyName );

		if ( array_key_exists( $propertyKey, $this->properties ) ) {
			$property = $this->properties[$propertyKey];
		} else {
			if ( self::$propertyPrefix == '' ) {
				global $wgContLang;
				self::$propertyPrefix = $wgContLang->getNsText( SMW_NS_PROPERTY ) . ':';
			} // explicitly use prefix to cope with things like [[Property:User:Stupid::somevalue]]

			$propertyDV = PropertyValue::makeUserProperty( self::$propertyPrefix . $propertyName );

			if ( !$propertyDV->isValid() ) { // error, maybe illegal title text
				return;
			}
			
			$property = $propertyDV->getDataItem();
		}

		$this->addPropertyObjectChange( $property, $change );
	}
	
	/**
	 * Removes all changes for a certian property.
	 * 
	 * @param DIProperty $property
	 */
	public function removeChangesForProperty( DIProperty $property ) {
		if ( array_key_exists( $property->getKey(), $this->changes ) ) {
			unset( $this->changes[$property->getKey()] );
			unset( $this->properties[$property->getKey()] );
		}
	}
	
	function rewind(): void {
		$this->pos = 0;
		$this->currentRow = null;
	}

	function current(): mixed {
		if ( is_null( $this->currentRow ) ) {
			$this->next();
		}
		return $this->currentRow;
	}

	function key(): mixed {
		return $this->pos;
	}

	#[\ReturnTypeWillChange]
	function next() {
		$this->pos++;
		$this->currentRow = array_key_exists( $this->pos, $this->changes ) ? $this->changes[$this->pos] : false;
		// TODO this doesn't match the iterator interface
		return $this->currentRow;
	}

	function valid(): bool {
		return $this->current() !== false;
	}
	
}
