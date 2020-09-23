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

if (!defined('WARS_ADMIN') or !preg_match("/admin_old\.php\?DelAllComments/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}
				
$result = e107::getDb()->delete("clan_wars_comments");

if($result){
	echo '1';
}

	
?>