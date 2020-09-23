 CREATE TABLE IF NOT EXISTS `clan_members_awardlink` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `award` int(11) NOT NULL,
  `awardtime` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `clan_members_awards` (
	`rid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `clan_members_config` (
  `version` varchar(10) NOT NULL,
  `gamesorteams` varchar(5) NOT NULL ,
  `cmtitle` varchar(100) NOT NULL,
  `show_opened` tinyint(1) NOT NULL DEFAULT '1',
  `show_gname` tinyint(1) NOT NULL DEFAULT '0',
  `rank_per_game` tinyint(1) NOT NULL DEFAULT '0',
  `memberorder` varchar(50) NOT NULL,
  `style` tinyint(1) NOT NULL DEFAULT '1',
  `allowchangeinfo` tinyint(1) NOT NULL DEFAULT '1',
  `allowupimage` tinyint(1) NOT NULL DEFAULT '1',
  `maxwidth` int(3) NOT NULL DEFAULT '100',
  `maxheight` int(3) NOT NULL DEFAULT '150',
  `titlealign` varchar(10) NOT NULL DEFAULT 'center',
  `padding` int(2) NOT NULL DEFAULT '0',
  `maxfilesize` int(5) NOT NULL DEFAULT '0',
  `membersperrow` int(2) NOT NULL DEFAULT '2',
  `joinformat` varchar(25) NOT NULL DEFAULT 'j M Y',
  `birthformat` varchar(25) NOT NULL DEFAULT 'j M Y',
  `enableprofile` tinyint(1) NOT NULL DEFAULT '1',
  `enablehardware` tinyint(1) NOT NULL DEFAULT '1',
  `enablegallery` tinyint(1) NOT NULL DEFAULT '1',
  `showawards` tinyint(1) NOT NULL DEFAULT '1',
  `maximages` int(5) NOT NULL DEFAULT '6',
  `galfilesize` int(10) NOT NULL DEFAULT '512',
  `thumbwidth` int(4) NOT NULL DEFAULT '200',
  `showuserimage` tinyint(1) NOT NULL DEFAULT '1',
  `profileimgwidth` int(3) NOT NULL DEFAULT '200',
  `profileimgheight` int(3) NOT NULL DEFAULT '200',
  `listwidth` varchar(4) NOT NULL DEFAULT '500',
  `profiletoguests` tinyint(1) NOT NULL DEFAULT '1',
  `changeatdot` tinyint(1) NOT NULL DEFAULT '1',
  `guestviewcontactinfo` tinyint(1) NOT NULL DEFAULT '0',
  `showview` tinyint(1) NOT NULL DEFAULT '0',
  `showcontactlist` tinyint(1) NOT NULL DEFAULT '0',
  `profilealign` varchar(10) NOT NULL DEFAULT 'left',
  `leftsidewidth` int(3) NOT NULL DEFAULT '150',
  `inactiveafter` int(3) NOT NULL DEFAULT '0',
  `lastclean` int(15) NOT NULL DEFAULT '0',
  `listorder` text,
  `profileorder` text,
  `userimgsrc` tinyint(1) NOT NULL DEFAULT '0',
  `commentsclass` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `clan_members_gallery` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `clan_members_gamelink` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `rank` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `clan_members_info` (
  `userid` int(11) NOT NULL,
  `rank` varchar(100) DEFAULT NULL,
  `birthday` bigint(20) NOT NULL DEFAULT '1',
  `gender` varchar(6) DEFAULT NULL,
  `xfire` varchar(100) DEFAULT NULL,
  `steam` varchar(50) DEFAULT NULL,
  `rankorder` int(2) NOT NULL DEFAULT '0',
  `avatar` varchar(100) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `tryout` tinyint(1) NOT NULL DEFAULT 0,
  `votedate` int(11) NOT NULL,  
  `realname` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `country` varchar(50) NOT NULL DEFAULT 'Unknown',
  `joindate` bigint(20) NOT NULL DEFAULT '1',
  `manufacturer` varchar(50) DEFAULT NULL,
  `cpu` varchar(50) DEFAULT NULL,
  `memory` varchar(50) DEFAULT NULL,
  `hdd` varchar(50) DEFAULT NULL,
  `vga` varchar(50) DEFAULT NULL,
  `monitor` varchar(50) DEFAULT NULL,
  `sound` varchar(50) DEFAULT NULL,
  `speakers` varchar(50) DEFAULT NULL,
  `keyboard` varchar(50) DEFAULT NULL,
  `mouse` varchar(50) DEFAULT NULL,
  `surface` varchar(50) DEFAULT NULL,
  `os` varchar(50) DEFAULT NULL,
  `mainboard` varchar(50) DEFAULT NULL,
  `pccase` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `clan_members_ranks` (
	`rid` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(100) NOT NULL DEFAULT '',
  `rimage` varchar(255) NOT NULL DEFAULT '',
  `rankorder` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM ;

CREATE TABLE IF NOT EXISTS `clan_members_teamlink` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `rank` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM ;


CREATE TABLE IF NOT EXISTS `clan_games` (
	  gid int(11) NOT NULL AUTO_INCREMENT,
	  abbr VARCHAR(20) DEFAULT NULL,
	  gname VARCHAR(50) NOT NULL,
	  banner VARCHAR(50) DEFAULT NULL,
	  icon VARCHAR(50) DEFAULT NULL,
	  inmembers tinyint(1) NOT NULL DEFAULT '1',
	  inwars tinyint(1) NOT NULL DEFAULT '1',
	  position int(3) NOT NULL,
	  PRIMARY KEY (gid) 
) ENGINE=MyISAM;
 

CREATE TABLE IF NOT EXISTS `clan_teams` (
	  tid int(11) NOT NULL AUTO_INCREMENT,
	  team_tag varchar(25) NOT NULL,
	  team_name varchar(100) NOT NULL,
	  team_country varchar(50) NOT NULL DEFAULT 'Unknown',
	  banner VARCHAR(255) DEFAULT NULL,
	  icon VARCHAR(255) DEFAULT NULL,
	  inmembers tinyint(1) NOT NULL DEFAULT '1',
	  inwars tinyint(1) NOT NULL DEFAULT '1',
	  position int(3) NOT NULL,
	  PRIMARY KEY (tid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 