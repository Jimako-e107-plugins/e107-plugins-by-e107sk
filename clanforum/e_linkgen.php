<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/forum/e_linkgen.php $
|     $Revision: 11678 $
|     $Id: e_linkgen.php 11678 2010-08-22 00:43:45Z e107coders $
|     $Author: e107coders $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

// Usage: sublink_type[x]['title'].
//  x should be the same as the plugin folder.

include_lan(CLAN_FORUM_LANGUAGE."lan_forum_admin.php");

	$sublink_type[CLAN_FORUM_FOLDER]['title'] = FORLAN_155; // "News Categories";
	$sublink_type[CLAN_FORUM_FOLDER]['table'] = CLAN_FORUM_TABLE_NOPREFIX;
	$sublink_type[CLAN_FORUM_FOLDER]['query'] = "forum_parent !='0' ORDER BY forum_order ASC";
  $sublink_type[CLAN_FORUM_FOLDER]['url']   =   "{e_PLUGIN}clanforum/forum_viewforum.php?#";
	$sublink_type[CLAN_FORUM_FOLDER]['fieldid'] = "forum_id";
	$sublink_type[CLAN_FORUM_FOLDER]['fieldname'] = "forum_name";
	$sublink_type[CLAN_FORUM_FOLDER]['fielddiz'] = "forum_description";


?>