# Semantic Watchlist

## 1.2.0

Not a release yet

* Dropped support for MediaWiki 1.22 and lower
* #66 Fixed breakage for database transactions in MediaWiki 1.27 and higher


## 1.1.0

Released on April 4, 2016.

* The extension has now been tested with PHP 7, MediaWiki up to 1.27 and SMW up to 2.3
* Fixed a number of bugs (by MWJames)
* Added and improved translations (by TranslateWiki.net)
* Improved documentation (by Karsten Hoffmeyer)
* Improved internal structure (by MWJames, Karsten Hoffmeyer, Geoffrey Mon, Aaron Schulz and umherirrender)


## 1.0.0

Released on January 31, 2015.

### New features

* Semantic Watchlist is now installable via Composer
* Added support with Semantic MediaWiki 2.x
* Added support with MediaWiki 1.22, 1.23 and 1.24
* Added support with PHP 5.5, PHP 5.6 and HHVM
* Added support for SQLite

### Bug fixes

* #5 Fixed call to a member function getCount() on a non-object
* #10 Migrated depreciated wfMsg* functions to wfMessage()
* #11 Fixed undefined variable `egSWLEnableSelfNotify`
* #11 Fixed uncaught ReferenceError `wgScriptPath` is not defined

### Internal enhancements

* #12 Enabled unit testing
* Added support for TravisCI and ScrutinizerCI


## 0.2.2

Released on December 10, 2013.

* Fix for Special:AdminLinks when using SMW 1.9+.


## 0.2.1

Released on September 26, 2013.

* 'swladmins' group removed.


## 0.2

Released on November 15, 2012.

* Special:WatchlistConditions UI improved.
* Custom text can be sent in emails.
* Custom text can be set using Special:WatchlistConditions.
* No email sent to a page's own editor, by default.
* Fixed deleting of groups, which was not working.


## 0.1

Initial release released on July 30, 2011 with these features:

* Special:SemanticWatchlist showing changes to properties watched by the user.
* Per-user optional email notification per edit that changes properties.  
* Integration with user preferences to allow users to specify which watchlist
  groups they want to follow, and if they want to receive emails on changes.
* Special:WatchlistConditions as administration interface for watchlist groups.
* API module to query property changes grouped by edit for a single user.
* API modules to add, modify and delete the watchlist groups.
