<?php

namespace SWL\Database;

use DatabaseBase;

/**
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class DatabaseUpdater {

	protected $dbConnection;

	/**
	 * @since 1.0
	 *
	 * @param DatabaseBase $dbConnection
	 */
	public function __construct( DatabaseBase $dbConnection ) {
		$this->dbConnection = $dbConnection;
	}

	/**
	 * @since 1.0
	 *
	 * @param $userId
	 * @param array $groupIds
	 */
	public function updateUsersPerGroupWithGroupIds( $userId, array $groupIds ) {

		$this->dbConnection->begin();

		$this->dbConnection->delete(
			'swl_users_per_group',
			array(
				'upg_user_id' => $userId
			)
		);

		foreach ( $groupIds as $groupId ) {
			$this->dbConnection->insert(
				'swl_users_per_group',
				array(
					'upg_user_id'  => $userId,
					'upg_group_id' => $groupId
				)
			);
		}

		$this->dbConnection->commit();

		return true;
	}

}
