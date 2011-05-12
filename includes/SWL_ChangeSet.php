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
	 * The title of the page the changeset holds changes for.
	 * 
	 * @var Title or false
	 */
	protected $title = false;
	
	/**
	 * Constructor.
	 * 
	 * @param User $user
	 * @param integer $time
	 */
	public function __construct( SMWChangeSet $changeSet, /* User */ $user = null, $time = null ) {
		$this->changeSet = $changeSet;
		$this->time = $time;
		$this->user = is_null( $user ) ? $GLOBALS['wgUser'] : $user;
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
		$dbr = wfGetDB( DB_MASTER );
		
		$dbr->insert(
			'swl_change_groups',
			array(
				'cg_user_name' => $this->getUser(),
				'cg_page_id' => $this->getTitle(),
				'cg_time' => is_null( $this->getTime() ) ? $dbw->timestamp() : $this->getTime() 
			)
		);
	}
	
	public function getTitle() {
		if ( $this->title === false ) {
			$this->title = Title::makeTitle( $this->getSubject()->getNamespace(), $this->getSubject()->getDBkey() );
		}
		
		return $this->title;
	}
	
	public function setUser() {
		
	}
	
	public function getUser() {
		
	}
	
	public function setTime() {
		
	}
	
	public function getTime() {
		
	}
	
}