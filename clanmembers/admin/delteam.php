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

$tid = intval($_GET['tid']);
$result = e107::getDb()->delete("clan_teams", "tid='$tid'");
e107::getDb()->delete("clan_members_teamlink", "tid='$tid'");
if($result){
	print '1';
}
?>