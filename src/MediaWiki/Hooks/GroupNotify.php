<?php

namespace SWL\MediaWiki\Hooks;

use SWL\MediaWiki\HookInterface;
use SWL\ObservableReporter;

use SWLEmailer;
use User;
use Sanitizer;

/**
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class GroupNotify implements HookInterface {

	protected $group;
	protected $changes;
	protected $user;
	protected $userIds;

	protected $configuration;

	/**
	 * @since 1.0
	 *
	 * @param SWLGroup $group
	 * @param SWLChangeSet $changes
	 * @param array $userIds
	 */
	public function __construct( \SWLGroup $group, \SWLChangeSet $changes, array $userIds ) {
		$this->group = $group;
		$this->changes = $changes;
		$this->userIds = $userIds;
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
		$reporter->reportStatus( 'SWL::GroupNotify', true );
	}

	/**
	 * @since 1.0
	 *
	 * @param User $user
	 */
	public function setAnonymousUser( User $user ) {
		$this->user = $user;
	}

	/**
	 * @since 1.0
	 *
	 * @return boolean
	 */
	public function execute() {
		return $this->canNotify() ? $this->createNotifications() : true;
	}

	protected function canNotify() {

		if ( isset( $this->configuration['egSWLEnableEmailNotify'] ) && $this->configuration['egSWLEnableEmailNotify'] ) {
			return true;
		}

		return false;
	}

	protected function createNotifications() {

		$swlMailPerChange = $this->configuration['egSWLMailPerChange'];
		$swlMaxMails = $this->configuration['egSWLMaxMails'];
		$swlEnableSelfNotify = $this->configuration['egSWLEnableSelfNotify'];

		foreach ( $this->userIds as $userId ) {
			$user = $this->makeUserFromId( $userId );

			if ( $user->getOption( 'swl_email', false ) ) {
				if ( $user->getName() != $this->changes->getEdit()->getUser()->getName() || $swlEnableSelfNotify ) {

					if ( $this->isValidEmail( $user->getEmail() ) ) {

						$lastNotify = $user->getOption( 'swl_last_notify' );
						$lastWatch = $user->getOption( 'swl_last_watch' );

						if ( is_null( $lastNotify ) || is_null( $lastWatch ) || $lastNotify < $lastWatch ) {
							$mailCount = $user->getOption( 'swl_mail_count', 0 );

							if ( $swlMailPerChange || $mailCount < $swlMaxMails ) {
								$this->notifyUser( $user, $swlMailPerChange );
								$user->setOption( 'swl_last_notify', wfTimestampNow() );
								$user->setOption( 'swl_mail_count', $mailCount + 1 );
								$user->saveSettings();
							}
						}
					}
				}
			}
		}

		return true;
	}

	protected function makeUserFromId( $id ) {
		return $this->user->newFromId( $id );
	}

	protected function notifyUser( $user, $mailPerChange ) {
		return SWLEmailer::notifyUser( $this->group, $user, $this->changes, $mailPerChange );
	}

	protected function isValidEmail( $email = null ) {
		return !method_exists( 'Sanitizer', 'validateEmail' ) || Sanitizer::validateEmail( $email );
	}

}
