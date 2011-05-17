-- MySQL version of the database schema for the Semantic Watchlist extension.
-- Licence: GNU GPL v3+
-- Author: Jeroen De Dauw < jeroendedauw@gmail.com >

-- Watchlist groups
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_groups (
  group_id                 SMALLINT unsigned   NOT NULL auto_increment PRIMARY KEY,
  group_name               VARCHAR(255)        NOT NULL,
  -- No need to have this stuff relational, so keep it simple.
  -- These fields keep multiple values, | separated.
  group_categories         BLOB                NOT NULL, -- Category names
  group_namespaces         BLOB                NOT NULL, -- Namespace IDs
  group_properties         BLOB                NOT NULL, -- Property names
  group_concepts           BLOB                NOT NULL -- Concept names
) /*$wgDBTableOptions*/;

--INSERT INTO mw_swl_groups (group_name,group_categories,group_namespaces,group_properties,group_concepts) VALUES ('foo', 'Locations|People', '', 'Has coordinates|Has age|Has occupation', '');
--INSERT INTO mw_swl_groups (group_name,group_categories,group_namespaces,group_properties,group_concepts) VALUES ('bar', '', 102, '', '');
--INSERT INTO mw_swl_groups (group_name,group_categories,group_namespaces,group_properties,group_concepts) VALUES ('baz', 'Customers', 102, 'Has contract status', '');
--INSERT INTO mw_swl_users_per_group (upg_group_id,upg_user_id) VALUES(1,1);
--INSERT INTO mw_swl_sets (set_user_name,set_page_id,set_time) VALUES('jeroen',1,20110517171422);
--INSERT INTO mw_swl_changes (change_set_id,change_property,change_old_value,change_new_value) VALUES(1,'has foobar','baz','bar');

-- List of all changes made to properties.
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_changes (
  change_id                INT(10) unsigned    NOT NULL auto_increment PRIMARY KEY,
  change_set_id            INT(10) unsigned    NOT NULL, -- Foreign key: swl_sets.set_id
  change_property          VARCHAR(255)        NOT NULL, -- Name of the property of which a value was changed
  change_old_value         BLOB                NULL, -- The old value of the property (null for an adittion)
  change_new_value         BLOB                NULL -- The new value of the property (null for a deletion)
) /*$wgDBTableOptions*/;

-- Sets of changes, as in the set you get when editing a page.
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_sets (
  set_id                   SMALLINT unsigned   NOT NULL auto_increment PRIMARY KEY,
  set_user_name            VARCHAR(255)        NOT NULL, -- The person that made the modification (account name or ip)
  set_page_id              INT(10) unsigned    NOT NULL, -- The id of the page the modification was on  
  set_time                 CHAR(14) binary     NOT NULL default '' -- The time the chages where made  
) /*$wgDBTableOptions*/;

-- Links change sets to watchlist groups.
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_sets_per_group (
  spg_group_id             SMALLINT unsigned   NOT NULL, -- Foreign key: swl_groups.group_id
  spg_set_id               INT(10) unsigned    NOT NULL, -- Foreign key: swl_sets.set_id
  PRIMARY KEY  (spg_group_id,spg_set_id)
) /*$wgDBTableOptions*/;

-- Links users to watchlist groups.
CREATE TABLE IF NOT EXISTS /*$wgDBprefix*/swl_users_per_group (
  upg_group_id             SMALLINT unsigned   NOT NULL, -- Foreign key: swl_groups.group_id
  upg_user_id              INT(10) unsigned    NOT NULL, -- Foreign key: user.user_id
  PRIMARY KEY  (upg_group_id,upg_user_id)
) /*$wgDBTableOptions*/;