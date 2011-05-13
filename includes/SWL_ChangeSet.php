<?php

class SWLChangeSet {
	
	/**
	 * 
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
	 * DB ID of the change set (swl_change_groups.cg_id).
	 * 
	 * @var integer
	 */
	protected $id;
	
	/**
	 * The title of the page the changeset holds changes for.
	 * 
	 * @var Title or false
	 */
	protected $title = false;
	
	/**
	 * 
	 * 
	 * @param $set
	 * 
	 * @return SWLChangeSet
	 */
	public static function newFromDBResult( $set ) {		
		$changeSet = new SMWChangeSet(
			SMWDIWikiPage::newFromTitle( Title::newFromID( $set->cg_page_id ) )
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
				'change_group_id' => $set->cg_id 
			)
		);
		
		foreach ( $changes as $change ) {
			$changeSet->addChange( $change->change_property, SMWPropertyChange( $change->change_old_value, $change->change_new_value ) );
		}	
		
		$changeSet = new SWLChangeSet( // swl_change_groups
			$changeSet,
			User::newFromName( $set->cg_user_name ),
			$set->cg_time,
			$set->cg_id
		);
		
		return $changeSet;
	}
	
	/**
	 * Constructor.
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
	 * Save the 
	 * 
	 * @since 0.1
	 * 
	 * @return boolean Success indicator
	 */
	public function writeToStore() {
		$dbw = wfGetDB( DB_MASTER );
		
		$dbw->insert(
			'swl_change_groups',
			array(
				'cg_user_name' => $this->getUser()->getName(),
				'cg_page_id' => $this->getTitle()->getArticleID(),
				'cg_time' => is_null( $this->getTime() ) ? $dbw->timestamp() : $this->getTime() 
			)
		);
		
		$id = $dbw->insertId();
		
		$changes = array();
		
		foreach ( $this->getChanges()->getProperties() as /* SMWDIProperty */ $proprety ) {
			$propName = $proprety->getLabel();
			
			foreach ( $this->getChanges()->getPropertyChanges( $proprety ) as /* SMWPropertyChange */ $change ) {
				$changes[] = array(
					'property' => $propName,
					'old' => $change->getOldValue()->getSerialization(),
					'new' => $change->getNewValue()->getSerialization()
				);
			}
		}
		
		foreach ( $this->getInsertions()->getProperties() as /* SMWDIProperty */ $proprety ) {
			$propName = $proprety->getLabel();
			
			foreach ( $this->getInsertions()->getPropertyValues( $proprety ) as /* SMWDataItem */ $dataItem ) {
				$changes[] = array(
					'property' => $propName,
					'old' => null,
					'new' => $dataItem->getSerialization()
				);
			}
		}

		foreach ( $this->getDeletions()->getProperties() as /* SMWDIProperty */ $proprety ) {
			$propName = $proprety->getLabel();
			
			foreach ( $this->getDeletions()->getPropertyValues( $proprety ) as /* SMWDataItem */ $dataItem ) {
				$changes[] = array(
					'property' => $propName,
					'old' => $dataItem->getSerialization(),
					'new' => null
				);
			}
		}		
		
		foreach ( $changes as $change ) {
			$dbw->insert(
				'swl_changes',
				array(
					'change_group_id' => $id,
					'change_property' => $change['property'],
					'change_old_value' => $change['old'],
					'change_new_value' => $change['new']
				)
			);			
		}
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