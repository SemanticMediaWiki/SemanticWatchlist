<?php

namespace SWL\MediaWiki\Hooks;

use SWL\MediaWiki\HookInterface;
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
class UserSaveOptions implements HookInterface {

	protected $user;
	protected $options;
	protected $configuration;

	/**
	 * @since 1.0
	 *
	 * @param User $user
	 * @param array &$options
	 */
	public function __construct( User $user, array &$options ) {
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
		$updater = new DatabaseUpdater( wfGetDB( DB_MASTER ) );

		return $updater->updateUsersPerGroupWithGroupIds(
			$this->user->getId(),
			$groupIds
		);
	}

}
