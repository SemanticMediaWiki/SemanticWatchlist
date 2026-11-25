<?php

namespace SWL\Tests;

use MediaWiki\Context\RequestContext;
use MediaWikiIntegrationTestCase;
use SWL\Group;
use SWL\Special\Conditions;
use SWL\Special\Watchlist;

require_once dirname( __DIR__, 3 ) . '/src/Group.php';
require_once dirname( __DIR__, 3 ) . '/src/CustomTexts.php';
require_once dirname( __DIR__, 3 ) . '/src/Emailer.php';
require_once dirname( __DIR__, 3 ) . '/src/Special/Conditions.php';
require_once dirname( __DIR__, 3 ) . '/src/Special/Watchlist.php';

/**
 * The special pages call MediaWiki\Html\Html and MediaWiki\Request\FauxRequest.
 * MediaWiki 1.44 and later have no global class aliases for those names, so
 * these tests fail with "Class Html not found" or "Class FauxRequest not found"
 * when the files still import the old names.
 *
 * The real constructors pass a restriction into SpecialPage, which MediaWiki 1.47
 * rejects. The probes below skip that constructor. The Html and FauxRequest calls
 * still run in the extension classes.
 *
 * @group semantic-watchlist
 * @covers \SWL\Emailer
 * @covers \SWL\Special\Conditions
 * @covers \SWL\Special\Watchlist
 */
class NamespacedCoreClassesTest extends MediaWikiIntegrationTestCase {

	public static function setUpBeforeClass(): void {
		parent::setUpBeforeClass();
		spl_autoload_register( static function ( $class ) {
			$prefix = 'SWL\\';
			if ( strncmp( $class, $prefix, strlen( $prefix ) ) !== 0 ) {
				return;
			}
			$relative = str_replace( '\\', '/', substr( $class, strlen( $prefix ) ) );
			$file = dirname( __DIR__, 3 ) . '/src/' . $relative . '.php';
			if ( is_file( $file ) ) {
				require_once $file;
			}
		} );
	}

	public function testConditionsRendersAGroupWithNamespacedHtml() {
		$page = new ConditionsHtmlProbe();
		$page->setContext( RequestContext::getMain() );
		$this->setMwGlobals( 'wgLang', RequestContext::getMain()->getLanguage() );

		$html = $page->renderGroup( new Group( 7, 'Cities', [], [ NS_TALK ], [], [], [] ) );

		$this->assertStringContainsString( 'id="swl_group_7"', $html );
		$this->assertStringContainsString( 'namespaces="Talk"', $html );
		$this->assertStringContainsString( '<fieldset', $html );
		$this->assertStringContainsString( '<legend', $html );
	}

	public function testWatchlistPagingControlRendersWithNamespacedHtml() {
		$page = new WatchlistHtmlProbe();
		$page->setContext( RequestContext::getMain() );
		$this->setUserLang( 'qqx' );

		$html = $page->renderPaging( 20, '', '', false, 0 );

		$this->assertStringContainsString( '<p>', $html );
		$this->assertStringContainsString( 'limit=20', $html );
		$this->assertStringContainsString( 'limit=50', $html );
	}

	public function testWatchlistChangeSetQueryBuildsAFauxRequest() {
		$page = new WatchlistHtmlProbe();
		$page->setContext( RequestContext::getMain() );

		try {
			$result = $page->renderChangeSets( 1, '' );
		} catch ( \Exception $e ) {
			// Class "FauxRequest" not found is an Error, so it is not caught here.
			// A later failure, such as the test database being disabled, still
			// means the namespaced class was constructed.
			$this->assertStringNotContainsString( 'FauxRequest', $e->getMessage() );
			return;
		}

		$this->assertIsArray( $result );
	}

	public function testEmailerRendersPropertyHtmlWithNamespacedHtml() {
		$property = $this->newProperty( 'Foo' );
		$texts = new \SWL\CustomTexts( new Group( 1, 'G', [], [], [], [], [] ) );
		$method = new \ReflectionMethod( \SWL\Emailer::class, 'getPropertyHTML' );

		$html = $method->invoke( null, $property, [], $texts );

		$this->assertStringContainsString( '<b', $html );
		$this->assertStringContainsString( 'Foo', $html );
		$this->assertStringContainsString( 'swl-prop-div', $html );
	}

	/**
	 * @return object
	 */
	private function newProperty( $label ) {
		if ( !class_exists( \SMW\DIProperty::class ) ) {
			eval( 'namespace SMW; class DIProperty { public function getLabel() { return "Foo"; } }' );
			return new \SMW\DIProperty();
		}

		$property = $this->createMock( \SMW\DIProperty::class );
		$property->method( 'getLabel' )->willReturn( $label );
		return $property;
	}
}

/**
 * Skips SpecialPage::__construct(), which on MediaWiki 1.47 accepts only the page name.
 */
class ConditionsHtmlProbe extends Conditions {

	public function __construct() {
		$property = new \ReflectionProperty( Conditions::class, 'nsInfo' );
		$property->setValue( $this, \MediaWiki\MediaWikiServices::getInstance()->getNamespaceInfo() );
	}

	public function renderGroup( Group $group ) {
		return $this->getGroupHtml( $group );
	}
}

/**
 * Skips SpecialPage::__construct(), which on MediaWiki 1.47 accepts only the page name.
 */
class WatchlistHtmlProbe extends Watchlist {

	public function __construct() {
		$this->mName = 'Watchlist';
	}

	public function renderPaging( $limit, $currentContinue, $subPage, $newContinue, $offset ) {
		return $this->getPagingControlHTML( $limit, $currentContinue, $subPage, $newContinue, $offset );
	}

	public function renderChangeSets( $limit, $continue ) {
		return $this->getChangeSetsData( $limit, $continue );
	}
}
