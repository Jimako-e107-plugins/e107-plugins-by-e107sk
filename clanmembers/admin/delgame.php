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

$gid = intval($_GET['gid']);
$result = e107::getDb()->delete("clan_games", "gid='$gid'");
e107::getDb()->delete("clan_members_gamelink", "gid='$gid'");
if($result){
	print '1';
}
?>