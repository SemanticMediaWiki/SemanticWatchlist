-- MySQL version of the database schema for the Semantic Watchlist extension.
-- Licence: GNU GPL v3+
-- Author: Jeroen De Dauw < jeroendedauw@gmail.com >

-- Watch groups
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_groups (
  group_id                INT(10) unsigned    NOT NULL auto_increment PRIMARY KEY,
  group_categories        BLOB                NOT NULL, -- No need to have this stuff relational, so keep it simple
  group_namespaces        BLOB                NOT NULL, -- No need to have this stuff relational, so keep it simple
  group_properties        BLOB                NOT NULL, -- No need to have this stuff relational, so keep it simple
) /*$wgDBTableOptions*/;

-- Watchlists
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_watchlists (
  list _id                INT(10) unsigned    NOT NULL auto_increment PRIMARY KEY,
  list_user_id            INT(10) unsigned    NOT NULL UNIQUE, -- TODO
  -- TODO
) /*$wgDBTableOptions*/;