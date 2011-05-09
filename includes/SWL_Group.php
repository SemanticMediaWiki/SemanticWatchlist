<?php

/**
 * Static class with functions interact with watchlist groups.
 * 
 * @since 0.1
 * 
 * @file SWL_Groups.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SWLGroup {

	protected $id;
	
	protected $categories;
	
	protected $namespaces;
	
	protected $properties;
	
	public static function newFromDBResult( $group ) {
		return new SWLGroup(
			$group->group_id,
			$group->group_categories == '' ? array() : array_map( 'intval', explode( '|', $group->group_categories ) ),
			$group->group_namespaces == '' ? array() : array_map( 'intval', explode( '|', $group->group_namespaces ) ),
			$group->group_properties == '' ? array() : explode( '|', $group->group_properties )
		);
	}
	
	public function __construct( $id, array $categories, array $namespaces, array $properties ) {
		$this->id = $id;
		$this->categories = $categories;
		$this->namespaces = $namespaces;
		$this->properties = $properties;		
	}
	
	/**
	 * Returns the categories specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[integer]
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**
	 * Returns the namespaces specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[integer]
	 */
	public function getNamespaces() {
		return $this->namespaces;
	}

	/**
	 * Returns the properties specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[string]
	 */
	public function getProperties() {
		return $this->properties;
	}
	
	/**
	 * Returns the group database id.
	 * 
	 * @since 0.1
	 * 
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
}
	