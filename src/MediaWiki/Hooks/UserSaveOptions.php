<?php

namespace SWL\MediaWiki\Hooks;

use SWL\tableUpdater;

use MediaWiki\User\UserIdentity;

/**
 * Called just before saving user preferences/options in order to find the
 * watchlist groups the user watches, and update the swl_users_per_group table.
 *
 * https://www.mediawiki.org/wiki/Manual:Hooks/SaveUserOptions
 *
 * TODO rename file and class to match actual hook (SaveUserOptions)
 *
 * @ingroup SWL
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class UserSaveOptions {

	/**
	 * @var TableUpdater
	 */
	private $tableUpdater;

	/**
	 * @var UserIdentity
	 */
	private $user;

	/**
	 * @var array
	 */
	private $modifications;

	/** @var array */
	private $originalOptions;

	/**
	 * @since 1.0
	 *
	 * @param TableUpdater $tableUpdater
	 * @param UserIdentity $user
	 * @param array &$modifications
	 * @param array $originalOptions
	 */
	public function __construct(
		TableUpdater $tableUpdater,
		UserIdentity $user,
		array &$modifications,
		array $originalOptions
	) {
		$this->tableUpdater = $tableUpdater;
		$this->user = $user;
		$this->modifications =& $modifications;
		$this->originalOptions = $originalOptions;
	}

	/**
	 * @since 1.0
	 *
	 * @return boolean
	 */
	public function execute() {
		// Need to account for both groups that were watched before and haven't
		// changed, as well as groups not watched before that are changed.
		// Just get them all, mapping group name => value, and then filter to
		// those enabled after the changes

		$groups = [];
		foreach ( $this->originalOptions as $name => $value ) {
			if ( strpos( $name, 'swl_watchgroup_' ) === 0 ) {
				$groups[$name] = $value;
			}
		}
		foreach ( $this->modifications as $name => $value ) {
			if ( strpos( $name, 'swl_watchgroup_' ) === 0 ) {
				$groups[$name] = $value;
			}
		}
		$groupIds = [];
		foreach ( $groups as $name => $value ) {
			if ( $value ) {
				$groupIds[] = (int)substr( $name, strrpos( $name, '_' ) + 1 );
			}
		}

		return $this->performUpdate( $groupIds );
	}

	protected function performUpdate( array $groupIds ) {
		return $this->tableUpdater->updateGroupIdsForUser(
			$this->user->getId(),
			$groupIds
		);
	}

}
