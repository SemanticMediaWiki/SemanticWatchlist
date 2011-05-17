<?php

class SWLChangeSet {
	
	/**
	 * Base object to which calls to unknown methods get routed via __call.
	 * This is to emulate SWLChangSet deriving from SMWChangeSet, but at the
	 * same time makes it possible to go from the SMW version to the SWL version
	 * by passing the former to the constructor of the later.
	 * 
	 * @var SMWChangeSet
	 */
	protected $changeSet;
	
	/**
	 * The user that made the changes.
	 * 
	 * @var User
	 */
	protected $user;
	
	/**
	 * The time on which the changes where made.
	 * 
	 * @var integer
	 */
	protected $time;
	
	/**
	 * DB ID of the change set (swl_sets.set_id).
	 * 
	 * @var integer
	 */
	protected $id;
	
	/**
	 * The title of the page the changeset holds changes for.
	 * The title will be constructed from the subject of the SMWChangeSet
	 * the first time getTitle is called, so it should be accessed via this
	 * method.
	 * 
	 * @var Title or false
	 */
	protected $title = false;
	
	/**
	 * Creates and returns a new SWLChangeSet instance from a database result
	 * obtained by doing a select on swl_sets. 
	 * 
	 * @since 0.1
	 * 
	 * @param $set
	 * 
	 * @return SWLChangeSet
	 */
	public static function newFromDBResult( $set ) {		
		$changeSet = new SMWChangeSet(
			SMWDIWikiPage::newFromTitle( Title::newFromID( $set->set_page_id ) )
		);
		
		$dbr = wfGetDb( DB_SLAVE );
		
		$changes = $dbr->select(
			'swl_changes',
			array(
				'change_id',
				'change_property',
				'change_old_value',
				'change_new_value'
			),
			array(
				'change_set_id' => $set->set_id
			)
		);
		
		foreach ( $changes as $change ) {
			$property = SMWDIProperty::doUnserialize( $change->change_property, '__pro' );
			
			$changeSet->addChange(
				$property,
				SMWPropertyChange::newFromSerialization( $property, $change->change_old_value, $change->change_new_value )
			);
		}	
		
		$changeSet = new SWLChangeSet(
			$changeSet,
			User::newFromName( $set->set_user_name, false ),
			$set->set_time,
			$set->set_id
		);
		
		return $changeSet;
	}
	
	/**
	 * Creates and returns a new SWLChangeSet instance from a database result
	 * obtained by doing a select on swl_sets. 
	 * 
	 * @since 0.1
	 * 
	 * @param array $changeSetArray
	 * 
	 * @return SWLChangeSet
	 */
	public static function newFromArray( array $changeSetArray ) {
		$changeSet = new SMWChangeSet(
			SMWDIWikiPage::newFromTitle( Title::newFromID( $changeSetArray['page_id'] ) )
		);
		
		foreach ( $changeSetArray['changes'] as $propName => $changes ) {
			$property = SMWDIProperty::doUnserialize( $propName, '__pro' );

			foreach ( $changes as $change ) {
				$changeSet->addChange(
					$property,
					SMWPropertyChange::newFromSerialization(
						$property,
						array_key_exists( 'old', $change ) ? $change['old'] : null,
						array_key_exists( 'new', $change ) ? $change['new'] : null
					)
				);					
			}
		}
		
		$changeSet = new SWLChangeSet(
			$changeSet,
			User::newFromName( $changeSetArray['user_name'], false ),
			$changeSetArray['time'],
			$changeSetArray['id']
		);		

		return $changeSet;
	}
	
	/**
	 * Constructor.
	 * 
	 * @since 0.1
	 * 
	 * @param SMWChangeSet $changeSet
	 * @param User $user
	 * @param integer $time
	 * @param integer $id
	 */
	public function __construct( SMWChangeSet $changeSet, /* User */ $user = null, $time = null, $id = null ) {
		$this->changeSet = $changeSet;
		$this->time = $time;
		$this->user = is_null( $user ) ? $GLOBALS['wgUser'] : $user;
		$this->id = $id;
	}
	
	/**
	 * SMW thinks this class is a SMWResultPrinter, and calls methods that should
	 * be forewarded to $this->queryPrinter on it.
	 * 
	 * @since 0.1
	 * 
	 * @param string $name
	 * @param array $arguments
	 */
	public function __call( $name, array $arguments ) {
		return call_user_func_array( array( $this->changeSet, $name ), $arguments );
	}
	
	/**
	 * Serializes the object as an associative array, which can be passed
	 * to newFromArray to create a new instance.
	 * 
	 * @since 0.1
	 * 
	 * @return array
	 */
	public function toArray() {
 		$changeSet = array(
			'id' => $this->id,
			'user_name' => $this->user->getName(),
			'page_id' => $this->getTitle()->getArticleID(),
			'time' => $this->time,
 			'changes' => array()
		);
		
		foreach ( $this->changeSet->getAllProperties() as /* SMWDIProperty */ $property ) {
			$propChanges = array();
			
			foreach ( $this->changeSet->getAllPropertyChanges( $property ) as /* SMWPropertyChange */ $change ) {
				$propChange = array();
				
				if ( is_object( $change->getOldValue() ) ) {
					$propChange['old'] = $change->getOldValue()->getSerialization();
				}
				
				if ( is_object( $change->getNewValue() ) ) {
					$propChange['new'] = $change->getNewValue()->getSerialization();
				}

				$propChanges[] = $propChange;
			}
			
			$changeSet['changes'][$property->getSerialization()] = $propChanges;
		}
		
		return $changeSet;
	}
	
	/**
	 * Save the change set to the database.
	 * 
	 * @since 0.1
	 * 
	 * @param array of SWLGroup
	 * 
	 * @return integer ID of the inserted row (0 if nothing was inserted).
	 */
	public function writeToStore( array $groupsToAssociate ) {
		$properties = array();
		
		foreach ( $this->getAllProperties() as /* SMWDIProperty */ $property ) {
			if ( $property->isUserDefined() ) {
				$properties[] = $property;
			}
		}
		
		// If there are no changed user properties, don't insert a new entry. 
		if ( count( $properties ) == 0 ) {
			return 0;
		}
		
		$dbw = wfGetDB( DB_MASTER );
		
		$dbw->insert(
			'swl_sets',
			array(
				'set_user_name' => $this->getUser()->getName(),
				'set_page_id' => $this->getTitle()->getArticleID(),
				'set_time' => is_null( $this->getTime() ) ? $dbw->timestamp() : $this->getTime() 
			)
		);
		
		$id = $dbw->insertId();
		
		$changes = array();
		
		foreach ( $properties as /* SMWDIProperty */ $property ) {
			if ( $property->isUserDefined() ) {
				$propSerialization = $property->getSerialization();
			
				foreach ( $this->getChanges()->getPropertyChanges( $property ) as /* SMWPropertyChange */ $change ) {
					$changes[] = array(
						'property' => $propSerialization,
						'old' => $change->getOldValue()->getSerialization(),
						'new' => $change->getNewValue()->getSerialization()
					);
				}

				foreach ( $this->getInsertions()->getPropertyValues( $property ) as /* SMWDataItem */ $dataItem ) {
					$changes[] = array(
						'property' => $propSerialization,
						'old' => null,
						'new' => $dataItem->getSerialization()
					);
				}

				foreach ( $this->getDeletions()->getPropertyValues( $property ) as /* SMWDataItem */ $dataItem ) {
					$changes[] = array(
						'property' => $propSerialization,
						'old' => $dataItem->getSerialization(),
						'new' => null
					);
				}				
			}
		}
		
		foreach ( $changes as $change ) {
			if ( $change['property'] == '' ) {
				// When removing the last value for a property of a page,
				// for some reason it gets inserted for a property without
				// name, so skip that. Better to fix higher up though.
				continue;
			}
			
			$dbw->insert(
				'swl_changes',
				array(
					'change_set_id' => $id,
					'change_property' => $change['property'],
					'change_old_value' => $change['old'],
					'change_new_value' => $change['new']
				)
			);			
		}
		
		foreach ( $groupsToAssociate as /* SWLGroup */ $group ) {
			$dbw->insert(
				'swl_sets_per_group',
				array(
					'spg_group_id' => $group->getId(),
					'spg_set_id' => $id
				)
			);
		}
		
		return $id;
	}
	
	/**
	 * Gets the title of the page these changes belong to.
	 * 
	 * @return Title
	 */
	public function getTitle() {
		if ( $this->title === false ) {
			$this->title = Title::makeTitle( $this->getSubject()->getNamespace(), $this->getSubject()->getDBkey() );
		}
		
		return $this->title;
	}
	
	/**
	 * Sets the user that made the changes.
	 * 
	 * @param User $user
	 */
	public function setUser( User $user ) {
		$this->user = $user;
	}
	
	/**
	 * Gets the user that made the changes.
	 * 
	 * @return User
	 */
	public function getUser() {
		return $this->user;
	}
	
	/**
	 * Sets the time on which the changes where made.
	 * 
	 * @param integer $time
	 */
	public function setTime( $time ) {
		$this->time = $time;
	}
	
	/**
	 * Gets the time on which the changes where made.
	 * 
	 * @return integer
	 */
	public function getTime() {
		return $this->time;
	}
	
}