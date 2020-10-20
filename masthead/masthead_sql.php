CREATE TABLE masthead (
  element_id int(10) unsigned NOT NULL auto_increment,
  element_preview varchar(255) NOT NULL,
  element_mode varchar(80) NOT NULL default '',
  element_title varchar(80) NOT NULL default '',
  element_visibility int(10) unsigned NOT NULL default '0',
  element_image varchar(255) NOT NULL,
  element_template varchar(50) NOT NULL,
  element_options text NOT NULL,
  PRIMARY KEY  ( element_id),
  KEY element_mode (element_mode)
) ENGINE=MyISAM;
 