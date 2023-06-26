<?php

namespace SWL\MediaWiki\Hooks;

use Language;
use NamespaceInfo;
use SWL\Group;
use SWL\Groups;
use User;

/**
 * Adds the preferences relevant to Semantic Watchlist
 * https://www.mediawiki.org/wiki/Manual:Hooks/GetPreferences
 *
 * @ingroup SWL
 *
 * @licence GNU GPL v2+
 * @since 1.0
 *
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 * @author mwjames
 */
class GetPreferences {

	protected $user;
	protected $language;
	protected $preferences;
	protected $configuration;
	protected $namespaceInfo;

	/**
	 * @since 1.0
	 *
	 * @param User $user
	 * @param Language $language
	 * @param array &$preferences
	 * @param NamespaceInfo $namespaceInfo
	 */
	public function __construct(
		User $user,
		Language $language,
		array &$preferences,
		NamespaceInfo $namespaceInfo
	) {
		$this->user = $user;
		$this->language = $language;
		$this->preferences =& $preferences;
		$this->namespaceInfo = $namespaceInfo;
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

		$groups = $this->getAllSwlGroups();

		if ( $this->configuration['egSWLEnableEmailNotify'] ) {
			$this->preferences['swl_email'] = $this->addEmailNotificationPreference();
		}

		if ( $this->configuration['egSWLEnableTopLink'] ) {
			$this->preferences['swl_watchlisttoplink'] = $this->addTopLinkPreference();
		}

		// Used by Watchlist, register them
		$this->preferences['swl_last_view'] = [ 'type' => 'api' ];
		$this->preferences['swl_mail_count'] = [ 'type' => 'api' ];

		foreach ( $groups as /* SWLGroup */ $group ) {
			$this->handleGroup( $group );
		}

		return true;
	}

	private function handleGroup( Group $group ) {
		$properties = $group->getProperties();

		if ( empty( $properties ) ) {
			return;
		}

		switch ( true ) {
			case count( $group->getCategories() ) > 0 :
				$type = 'category';
				$name = $group->getCategories();
				$name = $name[0];
				break;
			case count( $group->getNamespaces() ) > 0 :
				$type = 'namespace';
				$name = $group->getNamespaces();
				$name = $name[0] == 0
							? wfMessage( 'main' )->text()
							: $this->namespaceInfo->getCanonicalName( $name[0] );
				break;
			case count( $group->getConcepts() ) > 0 :
				$type = 'concept';
				$name = $group->getConcepts();
				$name = $name[0];
				break;
			default:
				return;
		}

		foreach ( $properties as &$property ) {
			$property = "''" . wfEscapeWikiText( $property ) . "''";
		}

		$this->preferences['swl_watchgroup_' . $group->getId()] = $this->addGroupPreference(
			$type,
			$group->getName(),
			$name,
			$properties
		);
	}

	protected function getAllSwlGroups() {
		return Groups::getAll();
	}

	protected function addEmailNotificationPreference() {
		return array(
			'type' => 'toggle',
			'label-message' => 'swl-prefs-emailnofity',
			'section' => 'swl/swlglobal',
		);
	}

	protected function addTopLinkPreference() {
		return array(
			'type' => 'toggle',
			'label-message' => 'swl-prefs-watchlisttoplink',
			'section' => 'swl/swlglobal',
		);
	}

	/**
	 * @search swl-prefs-category-label, swl-prefs-namespace-label,
	 * swl-prefs-concept-label
	 */
	protected function addGroupPreference( $type, $group, $name, $properties ) {
		return  array(
			'type' => 'toggle',
			'label-message' => wfMessage(
				"swl-prefs-$type-label",
				wfEscapeWikiText( $group ),
				count( $properties ),
				$this->language->listToText( $properties ),
				wfEscapeWikiText( $name )
			),
			'section' => 'swl/swlgroup',
		);
	}

}
