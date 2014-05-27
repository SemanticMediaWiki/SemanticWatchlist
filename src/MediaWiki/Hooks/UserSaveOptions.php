<?php

namespace SWL\MediaWiki\Hooks;

use SWL\Database\DatabaseUpdater;

use User;

/**
 * Called just before saving user preferences/options in order to find the
 * watchlist groups the user watches, and update the swl_users_per_group table.
 *
 * https://www.mediawiki.org/wiki/Manual:Hooks/UserSaveOptions
 *
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class UserSaveOptions {

	/* DatabaseUpdater*/
	protected $databaseUpdater;

	/* User*/
	protected $user;

	protected $options;
	protected $configuration;

	/**
	 * @since 1.0
	 *
	 * @param DatabaseUpdater $databaseUpdater
	 * @param User $user
	 * @param array &$options
	 */
	public function __construct( DatabaseUpdater $databaseUpdater, User $user, array &$options ) {
		$this->databaseUpdater = $databaseUpdater;
		$this->user = $user;
		$this->options =& $options;
	}

	/**
	 * @since 1.0
	 *
	 * @param array $configuration
	 */
	public function setConfiguration( array $configuration ) {
		$this->configuration = $configuration;
	}

	/**
	 * @since 1.0
	 *
	 * @return boolean
	 */
	public function execute() {

		$groupIds = array();

		foreach ( $this->options as $name => $value ) {
			if ( strpos( $name, 'swl_watchgroup_' ) === 0 && $value ) {
				$groupIds[] = (int)substr( $name, strrpos( $name, '_' ) + 1 );
			}
		}

		return $this->performUpdate( $groupIds );
	}

	protected function performUpdate( array $groupIds ) {
		return $this->databaseUpdater->updateUsersPerGroupWithGroupIds(
			$this->user->getId(),
			$groupIds
		);
	}

}
