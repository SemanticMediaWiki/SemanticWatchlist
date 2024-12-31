# Semantic Watchlist

[![Build Status](https://img.shields.io/github/actions/workflow/status/SemanticMediaWiki/SemanticWatchlist/ci.yml?branch=master)](https://github.com/SemanticMediaWiki/SemanticWatchlist/actions?query=workflow%3ACI)
[![Code Coverage](https://codecov.io/gh/SemanticMediaWiki/SemanticWatchlist/branch/master/graph/badge.svg)](https://codecov.io/gh/SemanticMediaWiki/SemanticWatchlist)
[![Latest Stable Version](https://poser.pugx.org/mediawiki/semantic-watchlist/v/stable)](https://packagist.org/packages/mediawiki/semantic-watchlist)
[![Packagist download count](https://poser.pugx.org/mediawiki/semantic-watchlist/downloads)](https://packagist.org/packages/mediawiki/semantic-watchlist)

Semantic Watchlist is an extension to [Semantic MediaWiki][smw] that enables users to
watch [semantic properties][smw-property] by adding a new watchlist page (Special:SemanticWatchlist)
that lists changes to these properties.

## Requirements

Semantic Watchlist 1.3:

- PHP 7.3 or above
- MediaWiki 1.35 or above
- [Semantic MediaWiki][smw] 3.0 - 4.0
- MySQL 5+ or SQLite 3

Semantic Watchlist 1.2:

- PHP 5.6 - 7.2
- MediaWiki 1.27 - 1.29
- [Semantic MediaWiki][smw] 2.0 - 3.0
- MySQL 5+ or SQLite 3

Semantic Watchlist 1.1:

- PHP 5.3+, including PHP 7 and HHVM
- MediaWiki 1.19 - 1.26
- [Semantic MediaWiki][smw] 2.x (and 1.9.x)
- MySQL 5+ or SQLite 3

## Installation

The recommended way to install Semantic Watchlist is by using [Composer][composer] with an entry in MediaWiki's `composer.json`.

```json
{
	"require": {
		"mediawiki/semantic-watchlist": "~1.0"
	}
}
```
1. From your MediaWiki installation directory, execute
   `composer require mediawiki/semantic-watchlist:~1.0`
2. Run `php maintenance/update.php` from your MediaWiki installation directory
   to create the required database tables.
3. Navigate to _Special:Version_ on your wiki and verify that the package
   have been successfully installed.

For configuration, see the [configuration documentation on MediaWiki.org](https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist).

## Usage

Users can choose to follow one or more watchlist groups, which are administrator defined, and cover
a set of properties and a set of pages (category, namespace, or SMW concept). Notification of changes
to watched properties is also possible via email.

### Features

* A watchlist page (Special:SemanticWatchlist) listing changes to properties watched by the user.
* Per-user optional email notification per edit that changes properties.
* Integration with user preferences to allow users to specify which watchlist
  groups they want to follow, and if they want to receive emails on changes.
* Special:WatchListConditions as administration interface for watchlist groups.
* API module to query property changes grouped by edit for a single user.
* API modules to add, modify and delete the watchlist groups.

Find more detailed [usage documentation on MediaWiki.org](https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist). Recent changes can be found in the [release notes](RELEASE-NOTES.md).

## Contribution and support

If you have remarks, questions, or suggestions, please send them to semediawiki-users@lists.sourceforge.net.
You can subscribe to this list [here](https://sourceforge.net/p/semediawiki/mailman/semediawiki-user/).

If you want to contribute work to the project please subscribe to the
developers mailing list and have a look at the [contribution guildline](/CONTRIBUTING.md).
A list of people who have made contributions in the past can be found [here][contributors].

* [File an issue](https://github.com/SemanticMediaWiki/SemanticWatchlist/issues)
* [Submit a pull request](https://github.com/SemanticMediaWiki/SemanticWatchlist/pulls)
* Ask a question on [the mailing list](https://www.semantic-mediawiki.org/wiki/Mailing_list)
* Ask a question on the #semantic-mediawiki IRC channel on Freenode.

## Extending Semantic Watchlist

Semantic Watchlist is in part a workflow extension, which makes it important for other SMW/MW extensions
and tools to interact with it. This is possible via the hooks and API modules Semantic Watchlist provides:

### API modules

* `addswlgroup` an API module to add semantic watchlist groups.
* `deleteswlgroup` an API module to delete semantic watchlist groups.
* `editswlgroup` an API module to modify semantic watchlist groups.
* `semanticwatchlist` returns a list of modified properties per page for a persons semantic watchlist.

### Hooks

* `SWLBeforeEmailNotify`
* `SWLBeforeEditInsert`
* `SWLAfterEditInsert`
* `SWLBeforeChangeSetInsert`
* `SWLAfterChangeSetInsert`

## Tests

This extension provides unit and integration tests that are run by a [continues integration platform][travis]
but can also be executed using `composer phpunit` from the extension base directory.

## License

[GNU General Public License 3.0 or later][licence]

[mw]: https://www.mediawiki.org/
[smw]: https://github.com/SemanticMediaWiki/SemanticMediaWiki
[mw-swl]: https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
[composer]: https://getcomposer.org/
[contributors]: https://github.com/SemanticMediaWiki/SemanticWatchlist/graphs/contributors
[licence]: https://www.gnu.org/copyleft/gpl.html
[travis]: https://travis-ci.org/SemanticMediaWiki/SemanticWatchlist
[smw-property]: https://www.semantic-mediawiki.org/wiki/Property
