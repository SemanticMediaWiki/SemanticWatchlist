<?php

namespace SWL\Tests;

use MediaWiki\Context\RequestContext;
use MediaWiki\Exception\PermissionsError;
use MediaWiki\Tests\Specials\SpecialPageExecutor;
use MediaWiki\Tests\Unit\HtmlAssertionHelperTrait;
use MediaWikiIntegrationTestCase;
use SMW\DIProperty;
use SWL\CustomTexts;
use SWL\Emailer;
use SWL\Group;
use SWL\Special\Conditions;
use SWL\Special\Watchlist;
use Wikimedia\TestingAccessWrapper;

/**
 * The pages call MediaWiki\Html\Html and MediaWiki\Request\FauxRequest.
 * Those names have no global alias since MediaWiki 1.44.
 *
 * @covers \SWL\Emailer
 * @covers \SWL\Special\Conditions
 * @covers \SWL\Special\Watchlist
 * @group semantic-watchlist
 * @group Database
 */
class NamespacedCoreClassesTest extends MediaWikiIntegrationTestCase {
	use HtmlAssertionHelperTrait;

	public function testConditionsRefusesAUserWithoutTheRight() {
		$user = $this->getTestUser()->getUser();
		$this->overrideUserPermissions( $user, [ 'read' ] );

		$this->expectException( PermissionsError::class );
		( new SpecialPageExecutor() )->executeSpecialPage(
			$this->newConditionsPage(),
			'',
			null,
			'qqx',
			$user
		);
	}

	public function testWatchlistRefusesAUserWithoutTheRight() {
		$user = $this->getTestUser()->getUser();
		$this->overrideUserPermissions( $user, [ 'read' ] );

		$this->expectException( PermissionsError::class );
		( new SpecialPageExecutor() )->executeSpecialPage(
			$this->newWatchlistPage(),
			'',
			null,
			'qqx',
			$user
		);
	}

	public function testConditionsAllowsAUserWithTheRight() {
		$page = $this->newConditionsPage();
		$user = $this->getTestUser()->getUser();
		$this->overrideUserPermissions( $user, [ 'read', 'semanticwatchgroups' ] );

		$this->assertSame( 'semanticwatchgroups', $page->getRestriction() );
		$this->assertTrue( $page->userCanExecute( $user ) );
	}

	public function testWatchlistAllowsAUserWithTheRight() {
		$page = $this->newWatchlistPage();
		$user = $this->getTestUser()->getUser();
		$this->overrideUserPermissions( $user, [ 'read', 'semanticwatch' ] );

		$this->assertSame( 'semanticwatch', $page->getRestriction() );
		$this->assertTrue( $page->userCanExecute( $user ) );
	}

	public function testConditionsRendersAGroupWithNamespacedHtml() {
		$this->setUserLang( 'qqx' );
		$page = $this->newConditionsPage();
		$page->setContext( RequestContext::getMain() );

		$html = TestingAccessWrapper::newFromObject( $page )->getGroupHtml(
			new Group( 7, 'Cities', [], [ NS_TALK ], [], [], [] )
		);

		$element = $this->assertSelectorMatchesOneElement( $html, '#swl_group_7' );
		$this->assertStringContainsString( 'namespaces="Talk"', $element );
		$this->assertStringContainsString( '<legend', $element );
	}

	public function testWatchlistPagingControlRendersWithNamespacedHtml() {
		$this->setUserLang( 'qqx' );
		$page = $this->newWatchlistPage();
		$page->setContext( RequestContext::getMain() );

		$html = TestingAccessWrapper::newFromObject( $page )->getPagingControlHTML(
			20,
			'',
			'',
			false,
			0
		);

		$element = $this->assertSelectorMatchesOneElement( $html, 'p' );
		$this->assertStringContainsString( 'limit=20', $element );
		$this->assertStringContainsString( 'limit=50', $element );
	}

	public function testWatchlistChangeSetQueryBuildsAFauxRequest() {
		$this->ensureChangeSetTables();
		$page = $this->newWatchlistPage();
		$page->setContext( RequestContext::getMain() );

		$result = TestingAccessWrapper::newFromObject( $page )->getChangeSetsData( 1, '' );

		$this->assertIsArray( $result );
		$this->assertSame( [], $result['sets'] );
	}

	/**
	 * sql/swl-table-schema.sql is MySQL. A database that could not import it
	 * has none of these tables, so the test creates the columns the query reads.
	 */
	private function ensureChangeSetTables(): void {
		$db = $this->db;
		if ( $db->tableExists( 'swl_edits', __METHOD__ ) ) {
			return;
		}

		$definitions = [
			'swl_edits' => 'edit_id INT NOT NULL PRIMARY KEY, '
				. 'edit_user_name VARCHAR(255) NOT NULL, '
				. 'edit_page_id INT NOT NULL, '
				. 'edit_time CHAR(14) NOT NULL DEFAULT \'\'',
			'swl_sets_per_edit' => 'spe_set_id INT NOT NULL, spe_edit_id INT NOT NULL, '
				. 'PRIMARY KEY (spe_set_id, spe_edit_id)',
			'swl_sets_per_group' => 'spg_group_id INT NOT NULL, spg_set_id INT NOT NULL, '
				. 'PRIMARY KEY (spg_group_id, spg_set_id)',
			'swl_users_per_group' => 'upg_group_id INT NOT NULL, upg_user_id INT NOT NULL, '
				. 'PRIMARY KEY (upg_group_id, upg_user_id)',
		];
		foreach ( $definitions as $table => $sql ) {
			$db->query(
				'CREATE TEMPORARY TABLE ' . $db->tableName( $table ) . " ($sql)",
				__METHOD__
			);
		}
	}

	public function testEmailerRendersPropertyHtmlWithNamespacedHtml() {
		if ( !class_exists( DIProperty::class ) ) {
			$this->markTestSkipped( 'SemanticMediaWiki is not loaded' );
		}

		$property = $this->createMock( DIProperty::class );
		$property->method( 'getLabel' )->willReturn( 'Foo' );
		$texts = new CustomTexts( new Group( 1, 'G', [], [], [], [], [] ) );

		$html = TestingAccessWrapper::newFromClass( Emailer::class )
			->getPropertyHTML( $property, [], $texts );

		$element = $this->assertSelectorMatchesOneElement( $html, 'div.swl-prop-div' );
		$this->assertStringContainsString( 'Foo', $html );
		$this->assertStringContainsString( '<b', $html );
		$this->assertStringContainsString( 'swl-prop-div', $element );
	}

	private function newConditionsPage(): Conditions {
		$page = $this->getServiceContainer()->getSpecialPageFactory()->getPage( 'WatchlistConditions' );
		$this->assertInstanceOf( Conditions::class, $page );
		return $page;
	}

	private function newWatchlistPage(): Watchlist {
		$page = $this->getServiceContainer()->getSpecialPageFactory()->getPage( 'SemanticWatchlist' );
		$this->assertInstanceOf( Watchlist::class, $page );
		return $page;
	}
}
