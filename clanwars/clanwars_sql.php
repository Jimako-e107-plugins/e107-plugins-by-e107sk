CREATE TABLE IF NOT EXISTS clan_wars (
	  wid int(11) NOT NULL AUTO_INCREMENT,
	  status int(1) NOT NULL DEFAULT '1',
	  game int(3) DEFAULT NULL,
	  wardate int(15) NOT NULL,
	  team int(11) NOT NULL DEFAULT '1',
	  opp_tag varchar(25) NOT NULL DEFAULT '',
	  opp_name varchar(50) DEFAULT '',
	  opp_url varchar(100) DEFAULT NULL,
	  opp_country varchar(50) DEFAULT NULL,
	  style varchar(20) DEFAULT NULL,
	  players int(2) DEFAULT NULL,
	  our_score int(4) DEFAULT '0',
	  opp_score int(4) DEFAULT '0',
	  serverip varchar(25) DEFAULT NULL,
	  serverpass varchar(25) DEFAULT NULL,
	  report text,
	  report_url varchar(100) DEFAULT NULL,
	  wholineup tinyint(1) NOT NULL DEFAULT '0',
	  active tinyint(1) NOT NULL DEFAULT '0',
	  lastupdate int(15) NOT NULL DEFAULT '0',
	  addedby varchar(25) NOT NULL,
	  PRIMARY KEY (wid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS clan_wars_comments (
	  cid int(11) NOT NULL AUTO_INCREMENT,
	  wid varchar(11) NOT NULL,
	  poster int(11) NOT NULL,
	  comment text NOT NULL,
	  postdate int(15) NOT NULL,
	  PRIMARY KEY (cid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS clan_wars_config (
	  version varchar(10) NOT NULL,
	  lastclean int(15) NOT NULL,
	  rowsperpage int(3) NOT NULL DEFAULT '30',
	  dateformat varchar(10) NOT NULL DEFAULT 'dd/mm/yyyy',
	  formatlist varchar(20) NOT NULL DEFAULT 'j M Y',
	  formatdetails varchar(20) NOT NULL DEFAULT 'j M Y H:i',
	  formatblock varchar(20) NOT NULL DEFAULT 'j/m',
	  enablecomments tinyint(1) NOT NULL DEFAULT '1',
	  guestcomments tinyint(1) NOT NULL DEFAULT '1',
	  screensperrow tinyint(2) NOT NULL DEFAULT '2',
	  screenmaxsize int(15) NOT NULL DEFAULT '512000',
	  resizescreens tinyint(1) NOT NULL DEFAULT '1',
	  createthumbs tinyint(1) NOT NULL DEFAULT '1',
	  resizedwidth int(4) NOT NULL DEFAULT '1024',
	  thumbwidth int(3) NOT NULL DEFAULT '165',
	  enablelineup tinyint(1) NOT NULL DEFAULT '1',
	  guestlineup tinyint(1) NOT NULL DEFAULT '1',
	  tablename varchar(100) NOT NULL DEFAULT 'user',
	  fieldname varchar(100) NOT NULL DEFAULT 'user_name',
	  colorbox tinyint(1) NOT NULL DEFAULT '1',
	  usesubs tinyint(1) NOT NULL DEFAULT '0',
	  sendmail tinyint(1) NOT NULL DEFAULT '0',
	  enablemail tinyint(1) NOT NULL DEFAULT '0',
	  allowsubscr tinyint(1) NOT NULL DEFAULT '1',
	  emailact tinyint(1) NOT NULL DEFAULT '1',
	  seperate tinyint(1) NOT NULL DEFAULT '0',
	  showip tinyint(1) NOT NULL DEFAULT '0',
	  stateserver tinyint(1) NOT NULL DEFAULT '1',
	  statereport tinyint(1) NOT NULL DEFAULT '1',
	  statemaps tinyint(1) NOT NULL DEFAULT '1',
	  statelineup tinyint(1) NOT NULL DEFAULT '1',
	  statescreens tinyint(1) NOT NULL DEFAULT '1',
	  statecomments tinyint(1) NOT NULL DEFAULT '0',
	  showteamflag tinyint(1) NOT NULL DEFAULT '0',
	  warssummary tinyint(1) NOT NULL DEFAULT '1',
	  addwarlist text NOT NULL,
	  caneditwar tinyint(1) NOT NULL DEFAULT '0',
	  requireapproval TINYINT (1) NOT NULL DEFAULT '1',
	  arrowcolor varchar(5) NOT NULL DEFAULT 'Black',
	  mapmustmatch TINYINT (1) NOT NULL DEFAULT '0',
	  scorepermap TINYINT (1) NOT NULL DEFAULT '0',
	  autocalcscore TINYINT (1) NOT NULL DEFAULT '0',
	  mapsperrow TINYINT (1) NOT NULL DEFAULT '2',
	  mapwidth INT (3) NOT NULL DEFAULT '180',
	  PRIMARY KEY (version)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS clan_wars_lineup (
	  pid int(11) NOT NULL AUTO_INCREMENT,
	  member varchar(50) NOT NULL,
	  wid int(11) NOT NULL DEFAULT '0',
	  available int(1) NOT NULL DEFAULT '1',
	  PRIMARY KEY (pid),
    KEY `available` (`available`,`wid`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS clan_wars_mail (
	  mid int(11) NOT NULL AUTO_INCREMENT,
	  member varchar(25) NOT NULL,
	  email varchar(100) NOT NULL,
	  active tinyint(1) NOT NULL DEFAULT '0',
	  code varchar(25) DEFAULT NULL,
	  subscrtime int(15) NOT NULL DEFAULT '0',
	  PRIMARY KEY (mid),
	  UNIQUE KEY email (email),
	  UNIQUE KEY member (member)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS clan_wars_maps (
	  mid INT (11) NOT NULL AUTO_INCREMENT,
	  gid INT (11) NOT NULL DEFAULT '0',
	  name VARCHAR(30) DEFAULT NULL,
	  image VARCHAR(50) DEFAULT NULL,
	  PRIMARY KEY (mid) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS clan_wars_screens (
	  sid int(11) NOT NULL AUTO_INCREMENT,
	  url varchar(125) NOT NULL,
	  wid varchar(5) NOT NULL,
	  PRIMARY KEY (sid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS clan_wars_maplink (
	  lid int(11) NOT NULL AUTO_INCREMENT,
	  wid int(11) NOT NULL DEFAULT '0',
	  mapname varchar(25) NOT NULL,
	  gametype varchar(25) DEFAULT NULL,
	  our_score INT (5) NOT NULL DEFAULT '0',
	  opp_score INT (5) NOT NULL DEFAULT '0',
	  PRIMARY KEY (lid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;