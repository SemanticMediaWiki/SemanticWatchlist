<?php

namespace SWL;

use DatabaseBase;

/**
 * @ingroup semantic-watchlist
 *
 * @license GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class TableUpdater {

	/**
	 * @var LazyDBConnectionProvider
	 */
	private $connectionProvider;

	/**
	 * @since 1.0
	 *
	 * @param LazyDBConnectionProvider $connectionProvider
	 */
	public function __construct( LazyDBConnectionProvider $connectionProvider ) {
		$this->connectionProvider = $connectionProvider;
	}

	/**
	 * @since 1.0
	 *
	 * @param $userId
	 * @param array $groupIds
	 */
	public function updateGroupIdsForUser( $userId, array $groupIds ) {

		$connection = $this->connectionProvider->getConnection();
		$connection->startAtomic( __METHOD__ );

		$connection->delete(
			'swl_users_per_group',
			array(
				'upg_user_id' => $userId
			)
		);

		foreach ( $groupIds as $groupId ) {
			$connection->insert(
				'swl_users_per_group',
				array(
					'upg_user_id'  => $userId,
					'upg_group_id' => $groupId
				)
			);
		}

		$connection->endAtomic( __METHOD__ );

		return true;
	}

}
