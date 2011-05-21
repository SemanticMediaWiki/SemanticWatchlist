<?php

/**
 * Wrapper around SMWChangeSet that holds extra info such as user and time,
 * and has methods for (un)serialization and database interaction. 
 * 
 * @since 0.1
 * 
 * @file SWL_ChangeSet.php
 * @ingroup SemanticWatchlist
 * 
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class SWLChangeSet {
	
	/**
	 * The subject the changes apply to.
	 * 
	 * @var SMWDIWikiPage
	 */
	protected $subject;
	
	/**
	 * Object holding semantic data that got inserted.
	 * 
	 * @var SMWSemanticData
	 */
	protected $insertions;
	
	/**
	 * Object holding semantic data that got deleted.
	 * 
	 * @var SMWSemanticData
	 */	
	protected $deletions;
	
	/**
	 * List of all changes(, not including insertions and deletions).
	 * 
	 * @var SWLPropertyChanges
	 */
	protected $changes;
	
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
				SWLPropertyChange::newFromSerialization( $property, $change->change_old_value, $change->change_new_value )
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
					SWLPropertyChange::newFromSerialization(
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
	 * Creates and returns a new SMWChangeSet from 2 SMWSemanticData objects.
	 * 
	 * @param SMWSemanticData $old
	 * @param SMWSemanticData $new
	 * 
	 * @return SMWChangeSet
	 */
	public static function newFromSemanticData( SMWSemanticData $old, SMWSemanticData $new ) {
		$subject = $old->getSubject();
		
		if ( $subject != $new->getSubject() ) {
			return new self( $subject );
		}
		
		$changes = new SWLPropertyChanges();
		$insertions = new SMWSemanticData( $subject );
		$deletions = new SMWSemanticData( $subject );
		
		$oldProperties = $old->getProperties();
		$newProperties = $new->getProperties();
		
		// Find the deletions.
		self::findSingleDirectionChanges( $deletions, $oldProperties, $old, $newProperties );
		
		// Find the insertions.
		self::findSingleDirectionChanges( $insertions, $newProperties, $new, $oldProperties );
		
		foreach ( $oldProperties as $propertyKey => /* SMWDIProperty */ $diProperty ) {
			$oldDataItems = array();
			$newDataItems = array();
			
			// Populate the data item arrays using keys that are their hash, so matches can be found.
			// Note: this code assumes there are no duplicates.
			foreach ( $old->getPropertyValues( $diProperty ) as /* SMWDataItem */ $dataItem ) {
				$oldDataItems[$dataItem->getHash()] = $dataItem;
			}
			foreach ( $new->getPropertyValues( $diProperty ) as /* SMWDataItem */ $dataItem ) {
				$newDataItems[$dataItem->getHash()] = $dataItem;
			}			
			
			$foundMatches = array();
			
			// Find values that are both in the old and new version.
			foreach ( array_keys( $oldDataItems ) as $hash ) {
				if ( array_key_exists( $hash, $newDataItems ) ) {
					$foundMatches[] = $hash;
				}
			}
			
			// Remove the values occuring in both sets, so only changes remain.
			foreach ( $foundMatches as $foundMatch ) {
				unset( $oldDataItems[$foundMatch] );
				unset( $newDataItems[$foundMatch] );
			}
			
			// Find which group is biggest, so it's easy to loop over all values of the smallest.
			$oldIsBigger = count( $oldDataItems ) > count ( $newDataItems );
			$bigGroup = $oldIsBigger ? $oldDataItems : $newDataItems;
			$smallGroup = $oldIsBigger ? $newDataItems : $oldDataItems;
			
			// Add all one-to-one changes.
			while ( $dataItem = array_shift( $smallGroup ) ) {
				$changes->addPropertyObjectChange( $diProperty, new SWLPropertyChange( $dataItem, array_shift( $bigGroup ) ) );
			}
			
			// If the bigger group is not-equal to the smaller one, items will be left,
			// that are either insertions or deletions, depending on the group.
			if ( count( $bigGroup > 0 ) ) {
				$semanticData = $oldIsBigger ? $deletions : $insertions;
				
				foreach ( $bigGroup as /* SMWDataItem */ $dataItem ) {
					$semanticData->addPropertyObjectValue( $diProperty, $dataItem );
				}				
			}
		}
		
		return new self( $subject, $changes, $insertions, $deletions );
	}
	
	/**
	 * Finds the inserts or deletions and adds them to the passed SMWSemanticData object.
	 * These values will also be removed from the first list of properties and their values,
	 * so it can be used for one-to-one change finding later on.  
	 * 
	 * @param SMWSemanticData $changeSet
	 * @param array $oldProperties
	 * @param SMWSemanticData $oldData
	 * @param array $newProperties
	 */
	protected static function findSingleDirectionChanges( SMWSemanticData &$changeSet,
		array &$oldProperties, SMWSemanticData $oldData, array $newProperties ) {
			
		$deletionKeys = array();
		
		foreach ( $oldProperties as $propertyKey => /* SMWDIProperty */ $diProperty ) {
			if ( !array_key_exists( $propertyKey, $newProperties ) ) {
				foreach ( $oldData->getPropertyValues( $diProperty ) as /* SMWDataItem */ $dataItem ) {
					$changeSet->addPropertyObjectValue( $diProperty, $dataItem );
				}
				$deletionKeys[] = $propertyKey;
			}
		}
		
		foreach ( $deletionKeys as $key ) {
			unset( $oldProperties[$propertyKey] );
		}
	}
	
	/**
	 * Create a new instance of a change set.
	 * 
	 * @param SMWDIWikiPage $subject
	 * @param SWLPropertyChanges $changes Can be null
	 * @param SMWSemanticData $insertions Can be null
	 * @param SMWSemanticData $deletions Can be null
	 */
	public function __construct( SMWDIWikiPage $subject, /* SWLPropertyChanges */ $changes = null,
		/* SMWSemanticData */ $insertions = null, /* SMWSemanticData */ $deletions = null,
		/* User */ $user = null, $time = null, $id = null ) {
	
		$this->subject = $subject;
		$this->changes = is_null( $changes ) ? new SWLPropertyChanges() : $changes;
		$this->insertions = is_null( $insertions ) ? new SMWSemanticData( $subject ): $insertions;
		$this->deletions = is_null( $deletions ) ? new SMWSemanticData( $subject ): $deletions;
		
		$this->time = is_null( $time ) ? wfTimestampNow() : $time;
		$this->user = is_null( $user ) ? $GLOBALS['wgUser'] : $user;
		$this->id = $id;
	}
	
	/**
	 * Returns whether the set contains any changes.
	 * 
	 * @param boolean $refresh
	 * 
	 * @return boolean
	 */
	public function hasChanges( $refresh = false ) {
		return $this->changes->hasChanges()
			|| $this->insertions->hasVisibleProperties( $refresh )
			|| $this->deletions->hasVisibleProperties( $refresh );
	}
	
	/**
	 * Returns a SMWSemanticData object holding all inserted SMWDataItem objects.
	 * 
	 * @return SMWSemanticData
	 */
	public function getInsertions() {
		return $this->insertions;
	}
	
	/**
	 * Returns a SMWSemanticData object holding all deleted SMWDataItem objects.
	 * 
	 * @return SMWSemanticData
	 */
	public function getDeletions() {
		return $this->deletions;
	}
	
	/**
	 * Returns a SWLPropertyChanges object holding all SWLPropertyChange objects.
	 * 
	 * @return SWLPropertyChanges
	 */	
	public function getChanges() {
		return $this->changes;
	}
	
	/**
	 * Returns the subject these changes apply to.
	 * 
	 * @return SMWDIWikiPage
	 */
	public function getSubject() {
		return $this->subject;		
	}
	
	/**
	 * Adds a SWLPropertyChange to the set for the specified SMWDIProperty.
	 * 
	 * @param SMWDIProperty $property
	 * @param SWLPropertyChange $change
	 */
	public function addChange( SMWDIProperty $property, SWLPropertyChange $change ) {
		switch ( $change->getType() ) {
			case SWLPropertyChange::TYPE_UPDATE:
				$this->changes->addPropertyObjectChange( $property, $change );
				break;
			case SWLPropertyChange::TYPE_INSERT:
				$this->insertions->addPropertyObjectValue( $property, $change->getNewValue() );
				break;
			case SWLPropertyChange::TYPE_DELETE:
				$this->deletions->addPropertyObjectValue( $property, $change->getOldValue() );
				break;
		}
	}
	
	/**
	 * Returns a list of all properties.
	 * 
	 * @return array of SMWDIProperty
	 */
	public function getAllProperties() {
		return array_merge(
			$this->getChanges()->getProperties(),
			$this->getInsertions()->getProperties(),
			$this->getDeletions()->getProperties()
		);
	}
	
	/**
	 * Removes all changes for a certian property.
	 * 
	 * @param SMWDIProperty $property
	 */
	public function removeChangesForProperty( SMWDIProperty $property ) {
		$this->getChanges()->removeChangesForProperty( $property );
		$this->getInsertions()->removeDataForProperty( $property );
		$this->getDeletions()->removeDataForProperty( $property );
	}
	
	/**
	 * Returns a list of ALL changes, including isertions and deletions.
	 * 
	 * @param SMWDIProperty $proprety
	 * 
	 * @return array of SWLPropertyChange
	 */
	public function getAllPropertyChanges( SMWDIProperty $property ) {
		$changes = array();
		
		foreach ( $this->changes->getPropertyChanges( $property ) as /* SWLPropertyChange */ $change ) {
			$changes[] = $change;
		}
		
		foreach ( $this->insertions->getPropertyValues( $property ) as /* SMWDataItem */ $dataItem ) {
			$changes[] = new SWLPropertyChange( null, $dataItem );
		}

		foreach ( $this->deletions->getPropertyValues( $property ) as /* SMWDataItem */ $dataItem ) {
			$changes[] = new SWLPropertyChange( $dataItem, null );
		}			
		
		return $changes;
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
		
		foreach ( $this->getAllProperties() as /* SMWDIProperty */ $property ) {
			$propChanges = array();
			
			foreach ( $this->getAllPropertyChanges( $property ) as /* SWLPropertyChange */ $change ) {
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
			
				foreach ( $this->getChanges()->getPropertyChanges( $property ) as /* SWLPropertyChange */ $change ) {
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
	
	/**
	 * Remove changes to properties not in the porvided list.
	 * 
	 * @since 0.1
	 * 
	 * @param array $properties List of property names
	 */
	public function filterOnProperties( array $properties ) {
		// TODO
		foreach ( $this->getAllProperties() as /* SMWDIProperty */ $property ) {
			if ( !in_array( $property->getSerialization(), $properties ) ) {
				//$this->changeSet->removeChangesForProperty( $property );
			}
		}
	}
	
}