<?php

namespace SWL\MediaWiki\Hooks;

use MediaWiki\User\UserOptionsManager;
use Title;
use User;

/**
 * Called after the navigation links have been set up, before they are shown.
 * https://www.mediawiki.org/wiki/Manual:Hooks/SkinTemplateNavigation::Universal
 *
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class SkinTemplateNavigationUniversal {

	protected $personalUrls;
	protected $title;
	protected $user;
	protected $userOptionsManager;

	/**
	 * @since 1.0
	 *
	 * @param array|null &$personalUrls
	 * @param Title &$title
	 * @param User $user
	 * @param UserOptionsManager $userOptionsManager
	 */
	public function __construct(
		?array &$personalUrls,
		Title $title,
		User $user,
		UserOptionsManager $userOptionsManager
	) {
		$this->personalUrls =& $personalUrls ?? [];
		$this->title = $title;
		$this->user = $user;
		$this->userOptionsManager = $userOptionsManager;
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
		return $this->isEnabledForTopLink() && $this->isEnabledForUser() ? $this->addSwlTopLinkUrl(): true;
	}

	protected function isEnabledForTopLink() {
		return isset( $this->configuration['egSWLEnableTopLink'] ) && $this->configuration['egSWLEnableTopLink'];
	}

	protected function isEnabledForUser() {
		return $this->user->isRegistered() &&
			$this->userOptionsManager->getOption( $this->user, 'swl_watchlisttoplink' );
	}

	protected function addSwlTopLinkUrl() {

		$url = \SpecialPage::getTitleFor( 'SemanticWatchlist' )->getLinkUrl();

		$semanticWatchlist = array(
			'text' => wfMessage( 'prefs-swl' )->inLanguage( $this->title->getPageLanguage() )->text(),
			'href' => $url,
			'active' => ( $url == $this->title->getLinkUrl() )
		);

		$keys = array_keys( $this->personalUrls );

		array_splice(
			$this->personalUrls,
			$this->getWatchListLocation( $keys ),
			1,
			array( $this->getWatchListItem( $keys ), $semanticWatchlist )
		);

		return true;
	}

	protected function getWatchListLocation( $keys ) {
		return array_search( 'watchlist', $keys );
	}

	protected function getWatchListItem( $keys ) {
		return $this->personalUrls[ $keys [ $this->getWatchListLocation( $keys ) ] ];
	}

}
