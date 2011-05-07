-- MySQL version of the database schema for the Semantic Watchlist extension.
-- Licence: GNU GPL v3+
-- Author: Jeroen De Dauw < jeroendedauw@gmail.com >

-- Watch groups
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_groups (
  group_id                 INT(10) unsigned    NOT NULL auto_increment PRIMARY KEY,
  group_categories         BLOB                NOT NULL, -- No need to have this stuff relational, so keep it simple
  group_namespaces         BLOB                NOT NULL, -- No need to have this stuff relational, so keep it simple
  group_properties         BLOB                NOT NULL -- No need to have this stuff relational, so keep it simple
) /*$wgDBTableOptions*/;

-- List of all changes made to properties.
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_changes (
  change_id                INT(10) unsigned    NOT NULL auto_increment PRIMARY KEY,
  change_user_id           INT(10) unsigned    NOT NULL,
  change_page_id           INT(10) unsigned    NOT NULL,
  change_property          VARCHAR(255)        NOT NULL,
  change_old_value         BLOB                NULL,
  change_new_value         BLOB                NULL,
  change_type              INT(1) unsigned     NOT NULL
) /*$wgDBTableOptions*/;

-- Watchlists
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_changes_per_group (
  cpg_group_id             INT(10) unsigned    NOT NULL,
  cpg_change_id            INT(10) unsigned    NOT NULL,
  PRIMARY KEY  (cpg_group_id,cpg_change_id)
) /*$wgDBTableOptions*/;