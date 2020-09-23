<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_ADMIN') or !preg_match("/admin_old\.php\?DelComment/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}

$cid = intval($_GET['cid']);

$result = e107::getDb()->delete("clan_wars_comments", "cid='$cid'");
if($result){
	print '1';
}
		
?>