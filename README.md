# Semantic Watchlist

Semantic Watchlist (a.k.a. SWL) is an extension to [Semantic MediaWiki][smw] that enables users to watch [semantic properties][smw-property] by adding a new watchlist page (Special:SemanticWatchlist) that lists changes to these properties.

Users can choose to follow one or more watchlist groups, which are administrator defined, and cover a set of properties and a set of pages (category, namespace, or SMW concept). Notification of changes to watched properties is also possible via email.

### Feature overview

* A watchlist page (Special:SemanticWatchlist) listing changes to properties watched by the user.
* Per-user optional email notification per edit that changes properties.
* Integration with user preferences to allow users to specify which watchlist
  groups they want to follow, and if they want to receive emails on changes.
* Special:WatchListConditions as administration interface for watchlist groups.
* API module to query property changes grouped by edit for a single user.
* API modules to add, modify and delete the watchlist groups.

## Requirements

- PHP 5.3 or later
- MediaWiki 1.19 or later
- Semantic MediaWiki 1.9 or later
- MySQL 5 or later

## Installation

The recommended way to install this extension is by using [Composer][composer]. Just add the following to the MediaWiki `composer.json` file and run the `php composer.phar install/update` command.

```json
{
	"require": {
		"mediawiki/semantic-watchlist": "~1.0*"
	}
}
```
## Contribution and support

If you have remarks, questions, or suggestions, please send them to semediawiki-users@lists.sourceforge.net. You can subscribe to this list [here](http://sourceforge.net/mailarchive/forum.php?forum_name=semediawiki-user).

If you want to contribute work to the project please subscribe to the
developers mailing list and have a look at the [contribution guildline](/CONTRIBUTING.md). A list of people who have made contributions in the past can be found [here][contributors].

* [File an issue](https://github.com/SemanticMediaWiki/SemanticWatchlist/issues)
* [Submit a pull request](https://github.com/SemanticMediaWiki/SemanticWatchlist/pulls)
* Ask a question on [the mailing list](https://semantic-mediawiki.org/wiki/Mailing_list)
* Ask a question on the #semantic-mediawiki IRC channel on Freenode.

### Tests

The library provides unit tests that covers the core-functionality normally run by the [continues integration platform][travis]. Tests can also be executed manually using the PHPUnit configuration file found in the root directory.

## License

[GNU General Public License 2.0 or later][licence]

[mw]: https://www.mediawiki.org/
[smw]: https://github.com/SemanticMediaWiki/SemanticMediaWiki
[mw-swl]: https://www.mediawiki.org/wiki/Extension:Semantic_Watchlist
[composer]: https://getcomposer.org/
[contributors]: https://github.com/SemanticMediaWiki/SemanticWatchlist/graphs/contributors
[licence]: https://www.gnu.org/copyleft/gpl.html
[travis]: https://travis-ci.org/SemanticMediaWiki/SemanticWatchlist
[smw-property]: https://semantic-mediawiki.org/wiki/Property