<?php

/**
 * API module to delete semantic watchlist groups.
 *
 * @since 0.1
 *
 * @file ApiDeleteWatchlistGroup.php
 * @ingroup SemanticWatchlist
 * @ingroup API
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 *
 * TODO: delete changes
 */
namespace SWL\Api;

use ApiBase;

class DeleteWatchlistGroup extends ApiBase {

	public function __construct( $main, $action ) {
		parent::__construct( $main, $action );
	}

	public function execute() {
		$user = $this->getUser();
		
		if ( !$user->isAllowed( 'semanticwatchgroups' ) ) {
			$this->dieWithError( [
				'apierror-permissiondenied',
				$this->msg( 'action-semanticwatchgroups' )
			] );
		}
		$block = $user->getBlock();
		if ( $block ) {
			$this->dieBlocked( $block );
		}

		$params = $this->extractRequestParams();

		$everythingOk = true;

		foreach ( $params['ids'] as $id ) {
			$everythingOk = $this->deleteGroup( $id ) && $everythingOk;
		}
		$res = [ 'success' => $everythingOk ];

		$this->getResult()->addValue(
			null,
			$this->getModuleName(),
			$res
		);
	}

	/**
	 * Delete the group with specified ID, and
	 * all linked data not used by other groups.
	 *
	 * @since 0.1
	 *
	 * @param integer $groupId
	 *
	 * @return boolean Success indicator
	 */
	protected function deleteGroup( $groupId ) {
		$everythingOk = true;

		$dbr = wfGetDB( DB_REPLICA );

		// Verify if the group even exists
		$groupRow = $dbr->selectRow(
			'swl_groups',
			'*',
			[ 'group_id' => $groupId ],
			__METHOD__
		);
		if ( $groupRow === false ) {
			return false;
		}


		$setsForGroup = $dbr->select(
			'swl_sets_per_group',
			array( 'spg_set_id' ),
			array(
				'spg_group_id' => $groupId,
			)
		);

		foreach ( $setsForGroup as $set ) {
			$changes = $dbr->select(
				'swl_changes',
				array( 'change_id' ),
				array( 'change_set_id' => $set->spg_set_id )
			);

			foreach ( $changes as $change ) {
				$dbr->select(
					'swl_changes',
					array( 'change_id' ),
					array( 'change_set_id' => $set->spg_set_id )
				);
			}
		}

		// Find all edits linked to this group.
		$editsForGroup = $dbr->select(
			array( 'swl_sets_per_group', 'swl_sets_per_edit' ),
			array( 'spe_edit_id' ),
			array(
				'spg_group_id' => $groupId,
			),
			'',
			array(),
			array(
				'swl_sets_per_edit' => array( 'INNER JOIN', array( 'spe_set_id=spg_set_id' ) ),
			)
		);

		$editsToDelete = array();

		// For each linked edit, find all linked groups, and save those with only one (this one).
		foreach ( $editsForGroup as $edit ) {
			$groupsForEdit = $dbr->select(
				array( 'swl_sets_per_edit', 'swl_sets_per_group', 'swl_groups' ),
				array( 'spg_group_id' ),
				array(
					'spe_edit_id' => $edit->spe_edit_id,
				),
				'',
				array(),
				array(
					'swl_sets_per_group' => array( 'INNER JOIN', array( 'spg_set_id=spe_set_id' ) ),
					'swl_groups' => array( 'INNER JOIN', array( 'group_id=spg_group_id' ) ),
				)
			);

			if ( $dbr->numRows( $groupsForEdit ) < 2 ) {
				$editsToDelete[] = $edit->spe_edit_id;
			}
		}

		$dbw = wfGetDB( DB_PRIMARY );
		$dbw->startAtomic( __METHOD__ );

		// Delete all edits and sets per edits only linked to this group.
		foreach ( $editsToDelete as $editId ) {
			$dbw->delete(
				'swl_edits',
				array( 'edit_id' => $editId )
			);

			$dbw->delete(
				'swl_sets_per_edit',
				array( 'spe_edit_id' => $editId )
			);
		}

		foreach ( $setsForGroup as $set ) {
			$dbw->delete(
				'swl_sets',
				array( 'set_id' => $set->spg_set_id )
			);
		}

		// Delete sets per group links for this group.
		$result = $dbw->delete(
			'swl_sets_per_group',
			array( 'spg_group_id' => $groupId )
		);

		if ( $result === false ) {
			$everythingOk = false;
		}

		// Delete users per group links for this group.
		$result = $dbw->delete(
			'swl_users_per_group',
			array( 'upg_group_id' => $groupId )
		);

		if ( $result === false ) {
			$everythingOk = false;
		}

		// Delete the actual group.
		$result = $dbw->delete(
			'swl_groups',
			array( 'group_id' => $groupId )
		);

		if ( $result === false ) {
			$everythingOk = false;
		}

		$dbw->endAtomic( __METHOD__ );

		return $everythingOk;
	}

	public function getAllowedParams() {
		return array(
			'ids' => array(
				ApiBase::PARAM_TYPE => 'integer',
				ApiBase::PARAM_REQUIRED => true,
				ApiBase::PARAM_ISMULTI => true,
			),
		);
	}

	public function getParamDescription() {
		return array(
			'ids' => 'The IDs of the watchlist groups to delete'
		);
	}

	public function getDescription() {
		return array(
			'API module to delete semantic watchlist groups.'
		);
	}

	protected function getExamples() {
		return array(
			'api.php?action=deleteswlgroup&ids=42|34',
		);
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}

}
