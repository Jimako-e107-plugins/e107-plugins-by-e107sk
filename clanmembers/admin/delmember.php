<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}
	$memberid = intval($_GET['memberid']);
	e107::getDb()->delete("clan_members_info", "userid='$memberid'");
	e107::getDb()->delete("clan_members_gamelink", "userid='$memberid'");
	e107::getDb()->delete("clan_members_teamlink", "userid='$memberid'");
	e107::getDb()->delete("clan_members_awardlink", "userid='$memberid'");
	e107::getDb()->delete("clan_members_gallery", "userid='$memberid'");

?>