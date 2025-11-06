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
namespace SWL;

use Hooks;
use MediaWiki\MediaWikiServices;
use SMW\DIWikiPage;
use SMW\Query\QueryResult;
use SMW\Query\Language\ConceptDescription;
use SMW\Query\Language\Conjunction;
use SMW\Query\Language\ValueDescription;
use SMW\DIProperty;
use SMWQuery;
use Title;
use User;

class Group {

	/**
	 * The ID of the group; the group_id field in swl_groups.
	 * When creating a new group, this will be null, and
	 * automatically set after writing the group to the DB.
	 *
	 * @since 0.1
	 *
	 * @var integer or null
	 */
	private $id;

	/**
	 * Name of the group.
	 *
	 * @since 0.1
	 *
	 * @var string
	 */
	private $name;

	/**
	 * List of categories this group covers.
	 *
	 * @since 0.1
	 *
	 * @var array of string
	 */
	private $categories;

	/**
	 * List of namespaces IDs of namespaces this group covers.
	 *
	 * @since 0.1
	 *
	 * @var array of integer
	 */
	private $namespaces = array();

	/**
	 * List of SMW properties this group covers.
	 *
	 * @since 0.1
	 *
	 * @var array of string
	 */
	private $properties;

	/**
	 * List of custom texts this group covers.
	 *
	 * @var array
	 */
	private $customTexts;

	/**
	 * List of SMW concepts this group covers.
	 *
	 * @since 0.1
	 *
	 * @var array of string
	 */
	private $concepts;

	/**
	 * Cached list of IDs of users that are watching this group,
	 * or false if this data has not been obtained yet.
	 *
	 * @since 0.1
	 *
	 * @var array of integer or false
	 */
	private $watchingUsers = false;

	/**
	 * Creates a new instance of Group from a DB result.
	 *
	 * @since 0.1
	 *
	 * @param $group
	 *
	 * @return Group
	 */
	public static function newFromDBResult( $group ) {
		return new Group(
			$group->group_id,
			$group->group_name,
			$group->group_categories == '' ? array() : explode( '|', $group->group_categories ),
			$group->group_namespaces == '' ? array() : explode( '|', $group->group_namespaces ),
			$group->group_properties == '' ? array() : explode( '|', $group->group_properties ),
			$group->group_concepts == '' ? array() : explode( '|', $group->group_concepts ),
			$group->group_custom_texts == '' ? array() : self::unserializedCustomTexts( explode( '|', $group->group_custom_texts ) )
		);
	}

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 *
	 * @param integer $id Set to null when creating a new group.
	 * @param string $name
	 * @param array $categories List of category names
	 * @param array $namespaces List of namespace names or IDs
	 * @param array $properties List of property names
	 * @param array $concepts List of concept names
	 * @param array $customTexts List of custom texts
	 */
	public function __construct( $id, $name, array $categories, array $namespaces, array $properties, array $concepts, array $customTexts ) {
		$this->id = $id;
		$this->name = $name;
		$this->categories = $categories;
		$this->properties = $properties;
		$this->concepts = $concepts;
		$this->customTexts = $customTexts;

		foreach ( $namespaces as $ns ) {
			if ( preg_match( "/^-?([0-9])+$/", $ns ) ) {
				$this->namespaces[] = $ns;
			}
			elseif ( $ns == '' || strtolower( $ns ) == 'main' ) {
				$this->namespaces[] = 0;
			}
			else {
				$nsInfo = MediaWikiServices::getInstance()->getNamespaceInfo();
				$ns = $nsInfo->getCanonicalIndex( strtolower( $ns ) );

				if ( !is_null( $ns ) ) {
					$this->namespaces[] = $ns;
				}
			}
		}
	}

	/**
	 * Writes the group to the database, either updating it
	 * when it already exists, or inserting it when it doesn't.
	 *
	 * @since 0.1
	 *
	 * @return boolean Success indicator
	 */
	public function writeToDB() {
		if ( is_null( $this->id ) ) {
			return $this->insertIntoDB();
		}
		else {
			return  $this->updateInDB();
		}
	}

	/**
	 * Updates the group in the database.
	 *
	 * @since 0.1
	 *
	 * @return boolean Success indicator
	 */
	private function updateInDB() {
		$dbw = MediaWikiServices::getInstance()
			->getDBLoadBalancer()
			->getConnection( DB_PRIMARY );

		return  $dbw->update(
			'swl_groups',
			array(
				'group_name' => $this->name,
				'group_properties' => implode( '|', $this->properties ),
				'group_categories' => implode( '|', $this->categories ),
				'group_namespaces' => implode( '|', $this->namespaces ),
				'group_concepts' => implode( '|', $this->concepts ),
				'group_custom_texts' => implode( '|', $this->getSerializedCustomTexts() ),
			),
			array( 'group_id' => $this->id ),
			__METHOD__
		);
	}

	/**
	 * Inserts the group into the database.
	 *
	 * @since 0.1
	 *
	 * @return boolean Success indicator
	 */
	private function insertIntoDB() {
		$dbw = MediaWikiServices::getInstance()
			->getDBLoadBalancer()
			->getConnection( DB_PRIMARY );

		$result = $dbw->insert(
			'swl_groups',
			array(
				'group_name' => $this->name,
				'group_properties' => implode( '|', $this->properties ),
				'group_categories' => implode( '|', $this->categories ),
				'group_namespaces' => implode( '|', $this->namespaces ),
				'group_concepts' => implode( '|', $this->concepts ),
				'group_custom_texts' => implode( '|', $this->getSerializedCustomTexts() ),
			),
			__METHOD__
		);

		$this->id = $dbw->insertId();

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
	 * Returns the properties specified by the group as strings (serializations of DIProperty).
	 *
	 * @since 0.1
	 *
	 * @return array[string]
	 */
	public function getProperties() {
		return $this->properties;
	}

	/**
	 * Returns the properties specified by the group as DIProperty objects.
	 *
	 * @since 0.1
	 *
	 * @return array[DIProperty]
	 */
	public function getPropertyObjects() {
		$properties = array();

		foreach ( $this->properties as $property ) {
			$properties[] = DIProperty::newFromSerialization( $property );
		}

		return $properties;
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
	 * Returns the custom Texts specified for this group.
	 *
	 * @since 0.2
	 *
	 * @return array
	 */
	public function getCustomTexts() {
		return $this->customTexts;
	}

	/**
	 * Returns the serialized version of custom Texts specified for this group.
	 *
	 * @since 0.2
	 *
	 * @return array
	 */
	public function getSerializedCustomTexts() {
		$serializedCustomTexts = array();
		foreach( $this->customTexts as $customText ) {
			$serializedCustomTexts[] = implode( '~', array_values( $customText ) );
		}
		return $serializedCustomTexts;
	}

	/**
	 * Returns the unserialized version of custom Texts specified for this group.
	 *
	 * @return array
	 */
	public static function unserializedCustomTexts( $customTexts ) {
		$unSerializedCustomTexts = array();
		foreach( $customTexts as $customText ) {
			$unSerializedCustomTexts[] = explode( '~', $customText );
		}
		return $unSerializedCustomTexts;
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
		$covers = $this->categoriesCoverPage( $title )
			|| $this->namespacesCoversPage( $title )
			|| $this->conceptsCoverPage( $title );
		wfDebugLog(
			'SemanticWatchlist',
			'Group #{groupId} ({groupName}) covers {title}: {covers}',
			'all',
			[
				'groupId' => $this->id,
				'groupName' => $this->name,
				'title' => $title->getPrefixedText(),
				'covers' => $covers ? 'yes' : 'no',
			]
		);
		return $covers;
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
			if ( in_array( $title->getNamespace(), $this->namespaces ) ) {
				return true;
			}
		}

		return false;
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
			return false;
		}

		$foundMatch = false;

		$cats = array_keys( $title->getParentCategories() );

		if ( count( $cats ) == 0 ) {
			return false;
		}

		$contentLang = MediaWikiServices::getInstance()->getContentLanguage();
		$catPrefix = $contentLang->getNsText( NS_CATEGORY ) . ':';

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
			return false;
		}

		$foundMatch = false;

		foreach ( $this->concepts as $groupConcept ) {
			$queryDescription = new Conjunction();

			$conceptTitle = Title::newFromText( $groupConcept, SMW_NS_CONCEPT );
			if ( !$conceptTitle->exists() ) continue;

			$queryDescription->addDescription( new ConceptDescription( DIWikiPage::newFromTitle( $conceptTitle ) ) );
			$queryDescription->addDescription( new ValueDescription( DIWikiPage::newFromTitle( $title ) ) );

			$query = new SMWQuery( $queryDescription );
			// TODO when this is set, the query doesn't work anymore, why?
			// $query->querymode = SMWQuery::MODE_COUNT;

			/* QueryResult */ $result = smwfGetStore()->getQueryResult( $query );
			$foundMatch = $result instanceof QueryResult ? $result->getCount() > 0 : $result > 0;

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
			$dbr = MediaWikiServices::getInstance()
				->getDBLoadBalancer()
				->getConnection( DB_REPLICA );

			$users = $dbr->select(
				'swl_users_per_group',
				array(
					'upg_user_id'
				),
				array(
					'upg_group_id' => $this->getId()
				),
				__METHOD__
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
	 * changes and the group object itself, to the GroupNotify hook.
	 *
	 * @since 0.1
	 *
	 * @param SMWChangeSet $changes
	 */
	public function notifyWatchingUsers( ChangeSet $changes ) {
		$users = $this->getWatchingUsers();

		if ( $changes->hasChanges( true ) ) {
			MediaWikiServices::getInstance()->getHookContainer()
				->run( 'SWLGroupNotify', array( $this, $users, $changes ) );
		}
	}

}
