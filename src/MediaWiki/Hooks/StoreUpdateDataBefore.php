<?php

namespace SWL\MediaWiki\Hooks;

use SWL\MediaWiki\HookInterface;
use SWL\ObservableReporter;

use SMW\SemanticData;
use SMW\Store;

use Title;
use User;

/**
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class StoreUpdateDataBefore implements HookInterface {

	protected $store;
	protected $semanticData;
	protected $user;

	protected $configuration;

	/**
	 * @since 1.0
	 *
	 * @param Store $store
	 * @param SemanticData $semanticData
	 * @param User $user
	 */
	public function __construct( Store $store, SemanticData $semanticData, User $user ) {
		$this->store = $store;
		$this->semanticData = $semanticData;
		$this->user = $user;
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
	 * @param ObservableReporter $status
	 */
	public function setReporter( ObservableReporter $reporter ) {
		$reporter->reportStatus( 'SMWStore::updateDataBefore', true );
	}

	/**
	 * @since 1.0
	 *
	 * @return boolean
	 */
	public function execute() {

		$subject = $this->semanticData->getSubject();
		$oldData = $this->store->getSemanticData( $subject );
		$title = Title::makeTitle( $subject->getNamespace(), $subject->getDBkey() );

		$groups = \SWLGroups::getMatchingWatchGroups( $title );

		$edit = false;

		foreach ( $groups as /* SWLGroup */ $group ) {

			$changeSet = \SWLChangeSet::newFromSemanticData(
				$oldData,
				$this->semanticData,
				$group->getProperties()
			);

			if ( $changeSet->hasUserDefinedProperties() ) {
				if ( $edit === false ) {
					$edit = new \SWLEdit(
						$title->getArticleID(),
						$this->user->getName(),
						wfTimestampNow()
					);

					$edit->writeToDB();
				}

				$changeSet->setEdit( $edit );
				$setId = $changeSet->writeToStore( $groups, $edit->getId() );

				if ( $setId != 0 ) {
					$group->notifyWatchingUsers( $changeSet );
				}
			}
		}

		return true;
	}

}
