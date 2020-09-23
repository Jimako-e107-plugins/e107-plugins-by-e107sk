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

$rid = intval($_GET['rid']);

/******  REPLACE OLD GLOBALS  *************************************************/
$sql = e107::getDB();
/******  REPLACE OLD GLOBALS END  *********************************************/

$sql->delete("clan_members_ranks", "rid='$rid'");

?>