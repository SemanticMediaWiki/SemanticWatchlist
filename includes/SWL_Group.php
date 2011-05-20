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
	
	protected $name;
	
	protected $categories;
	
	protected $namespaces;
	
	protected $properties;
	
	protected $concepts;
	
	protected $watchingUsers = false;
	
	public static function newFromDBResult( $group ) {
		return new SWLGroup(
			$group->group_id,
			$group->group_name,
			$group->group_categories == '' ? array() : explode( '|', $group->group_categories ),
			$group->group_namespaces == '' ? array() : array_map( 'intval', explode( '|', $group->group_namespaces ) ),
			$group->group_properties == '' ? array() : explode( '|', $group->group_properties ),
			$group->group_concepts == '' ? array() : explode( '|', $group->group_group_concepts )
		);
	}
	
	public function __construct( $id, $name, array $categories, array $namespaces, array $properties, array $concepts ) {
		$this->id = $id;
		$this->name = $name;
		$this->categories = $categories;
		$this->namespaces = $namespaces;
		$this->properties = $properties;	
		$this->concepts = $concepts;	
	}
	
	public function writeToDB() {
		if ( is_null( $this->id ) ) {
			return $this->insertIntoDB();
		}
		else {
			return  $this->updateInDB();
		}
	}
	
	protected function updateInDB() {
		$dbr = wfGetDB( DB_MASTER );
		
		return  $dbr->update(
			'swl_groups',
			array(
				'group_name' => $this->name,
				'group_properties' => implode( '|', $this->properties ),
				'group_categories' => implode( '|', $this->categories ),
				'group_namespaces' => implode( '|', $this->namespaces ),
				'group_concepts' => implode( '|', $this->concepts ),
			),
			array( 'group_id' => $this->id )
		);
	}
	
	protected function insertIntoDB() {
		$dbr = wfGetDB( DB_MASTER );
		
		$result = $dbr->insert(
			'swl_groups',
			array(
				'group_name' => $this->name,
				'group_properties' => $this->properties,
				'group_categories' => $this->categories,
				'group_namespaces' => $this->namespaces,
				'group_concepts' => $this->concepts,
			)
		);
		
		$this->id = $dbr->insertId();
		
		return $result;
	}
	
	/**
	 * Returns the categories specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[string]
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
	 * Returns the concepts specified by the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array[string]
	 */
	public function getConcepts() {
		return $this->concepts;
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
	
	/**
	 * Returns the group name.
	 * 
	 * @since 0.1
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}	
	
	/**
	 * Returns whether the group contains the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */
	public function coversPage( Title $title ) {
		return $this->categoriesCoverPage( $title ) 
			&& $this->namespacesCoversPage( $title )
			&& $this->conceptsCoverPage( $title );
	}
	
	/**
	 * Returns whether the namespaces of the group cover the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */	
	public function namespacesCoversPage( Title $title ) {
		if ( count( $this->namespaces ) > 0 ) {
			if ( !in_array( $title->getNamespace(), $this->namespaces ) ) {
				return false;
			}
		}
		
		return true;		
	}
	
	/**
	 * Returns whether the catgeories of the group cover the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */		
	public function categoriesCoverPage( Title $title ) {
		if ( count( $this->categories ) == 0 ) {
			return true;
		}
		
		$foundMatch = false;

		$cats = array_keys( $title->getParentCategories() );
		
		if ( count( $cats ) == 0 ) {
			return false; 
		}
		
		global $wgContLang;
		$catPrefix = $wgContLang->getNSText( NS_CATEGORY ) . ':';
		
		foreach ( $this->categories as $groupCategory ) {
			$foundMatch = in_array( $catPrefix . $groupCategory, $cats );
			
			if ( $foundMatch ) {
				break;
			}
		}

		return $foundMatch;
	}
	
	/**
	 * Returns whether the concepts of the group cover the specified page.
	 * 
	 * @since 0.1
	 * 
	 * @param Title $title
	 * 
	 * @return boolean
	 */		
	public function conceptsCoverPage( Title $title ) {
		if ( count( $this->concepts ) == 0 ) {
			return true;
		}
		
		$foundMatch = false;
		
		foreach ( $this->concepts as $groupConcept ) {
			$queryDescription = new SMWConjunction();
			
			$conceptTitle = Title::newFromText( $groupConcept, SMW_NS_CONCEPT );
			$queryDescription->addDescription( new SMWConceptDescription( SMWDIWikiPage::newFromTitle( $conceptTitle ) ) );
			$queryDescription->addDescription( new SMWValueDescription( SMWDIWikiPage::newFromTitle( $title ) ) );
			
			$query = new SMWQuery( $queryDescription );
			$query->querymode = SMWQuery::MODE_COUNT;

			/* SMWQueryResult */ $result = smwfGetStore()->getQueryResult( $query );
			$foundMatch = $result->getCount() > 0;
			
			if ( $foundMatch ) {
				break;
			}
		}
		
		return $foundMatch;
	}
	
	/**
	 * Returns the IDs of the users watching the group.
	 * 
	 * @since 0.1
	 * 
	 * @return array of integer
	 */
	public function getWatchingUsers() {
		if ( $this->watchingUsers == false ) {
			$dbr = wfGetDB( DB_SLAVE );
			
			$users = $dbr->select(
				'swl_users_per_group',
				array(
					'upg_user_id'
				),
				array(
					'upg_group_id' => $this->getId()
				)
			);
			
			$userIds = array();
			
			foreach ( $users as $user ) {
				$userIds[] = $user->upg_user_id;
			}
			
			$this->watchingUsers = $userIds;			
		}
		
		return $this->watchingUsers;
	}
	
	/**
	 * Returns if the group is watched by the specified user or not.
	 * 
	 * @since 0.1
	 * 
	 * @param User $user 
	 * 
	 * @return boolean
	 */	
	public function isWatchedByUser( User $user ) {
		return in_array( $user->getId(), $this->getWatchingUsers() );
	}
	
	/**
	 * Gets all the watching users and passes them, together with the specified
	 * changes and the group object itself, to the SWLGroupNotify hook.
	 * 
	 * @since 0.1
	 * 
	 * @param SMWChangeSet $changes
	 */
	public function notifyWatchingUsers( SWLChangeSet $changes ) {
		$users = $this->getWatchingUsers();
		
		wfRunHooks( 'SWLGroupNotify', array( $this, $users, $changes ) );
	}
	
}
	